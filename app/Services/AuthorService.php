<?php

namespace App\Services;

use App\Repositories\AuthorRepository;
use App\Models\User;

class AuthorService
{
    protected $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    // Create a new author
    public function create(array $data): User
    {
        return $this->authorRepository->create($data);
    }

    // Get all authors
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->authorRepository->getAll();
    }

    // Get a specific author
    public function getById(int $id): ?User
    {
        return $this->authorRepository->getById($id);
    }

    // Update an author
    public function update(User $author, array $data): User
    {
        return $this->authorRepository->update($author, $data);
    }

    // Delete an author
    public function delete(User $author): bool
    {
        return $this->authorRepository->delete($author);
    }
}
