<?php
namespace App\Services;

use App\Repositories\BookRepository;
use App\Models\Book;

class BookService
{
    protected $bookRepo;

    public function __construct(BookRepository $bookRepo)
    {
        $this->bookRepo = $bookRepo;
    }

    // Create a new book
    public function create(array $data)
{
    if (isset($data['cover'])) {
        $cover = $data['cover'];

        $coverPath = $cover->store('covers', 'public');

        $data['cover'] = $coverPath;
    }

    return $this->bookRepo->create($data);
}


    // Get all books with search
    public function getAll($search = null , $authorId = null)
    {
        return $this->bookRepo->getAll($search , $authorId);
    }

    // Get a specific book
    public function getById($id)
    {
        return $this->bookRepo->getById($id);
    }

    // Update a book
    public function update(Book $book, array $data)
    {
        return $this->bookRepo->update($book, $data);
    }

    // Delete a book
    public function delete(Book $book)
    {
        return $this->bookRepo->delete($book);
    }
}
