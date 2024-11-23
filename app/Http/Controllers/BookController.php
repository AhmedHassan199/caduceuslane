<?php

namespace App\Http\Controllers;

use App\Exports\AuthorBooksExport;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Services\BookService;
use App\Helpers\ApiResponseHelper;
use App\Imports\BooksImport;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function create(CreateBookRequest $request)
    {
        $data = $request->validated();
        $book = $this->bookService->create($data);
        return ApiResponseHelper::success(new BookResource($book), 'Book created successfully', 201);
    }

    public function index()
    {
        $search = request()->query('search');
        $books = $this->bookService->getAll($search);
        return ApiResponseHelper::success(BookResource::collection($books), 'Books fetched successfully');
    }
    public function export()
    {
        return Excel::download(new AuthorBooksExport, 'author_books.xlsx');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:10240',
        ]);

        try {
            Excel::import(new BooksImport, $request->file('file'));
            return ApiResponseHelper::success(null, 'Books imported successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Error during import: ' . $e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        $book = $this->bookService->getById($id);
        if (!$book) {
            return ApiResponseHelper::error('Book not found', 404);
        }
        return ApiResponseHelper::success(new BookResource($book), 'Book fetched successfully');
    }

    public function update(UpdateBookRequest $request, $id)
    {
        $data = $request->validated();
        $book = $this->bookService->getById($id);

        $this->authorize('update', $book);

        $updatedBook = $this->bookService->update($book, $data);
        return ApiResponseHelper::success(new BookResource($updatedBook), 'Book updated successfully');
    }

    public function destroy($id)
    {
        $book = $this->bookService->getById($id);

        $this->authorize('delete', $book);

        $this->bookService->delete($book);
        return ApiResponseHelper::success([], 'Book deleted successfully');
    }
}
