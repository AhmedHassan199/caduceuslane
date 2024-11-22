<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class AuthorRepository
{
    // Create a new author
    public function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 'author', // Set the role as author
        ]);
    }

    // Get all authors
    public function getAll(): Collection
    {
        return User::where('role', 'author')->get();
    }

    // Get single author
    public function getById(int $id): ?User
    {
        return User::where('role', 'author')->find($id);
    }

    // Update author details
    public function update(User $author, array $data): User
    {
        $author->update($data);
        return $author;
    }

    // Delete author
    public function delete(User $author): bool
    {
        return $author->delete();
    }
}
