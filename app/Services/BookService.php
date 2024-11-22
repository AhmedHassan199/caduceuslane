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
        return $this->bookRepo->create($data);
    }

    // Get all books with search
    public function getAll($search = null)
    {
        return $this->bookRepo->getAll($search);
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
