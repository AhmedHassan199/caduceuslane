<?php
namespace App\Repositories;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookRepository
{
    // Create a new book
    public function create(array $data)
    {
        $data['author_id'] = Auth::id();
        return Book::create($data);
    }
    public function getAll($search = null , $authorId = null)
    {
        $query = Book::query();
        $query = Book::with('author');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
            });
        }

        if ($authorId) {
            $query->where('author_id', $authorId);
        }
        return $query->get();
    }

    // Get a specific book by ID
    public function getById($id)
    {
        return Book::find($id);
    }

    // Update a book
    public function update(Book $book, array $data)
    {
        $book->update($data);
        return $book;
    }

    // Delete a book
    public function delete(Book $book)
    {
        $book->delete();
    }
}
