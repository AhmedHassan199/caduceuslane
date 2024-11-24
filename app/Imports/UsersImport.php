<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        dd("SAd");

        return new User([
        ]);
    }
}


class BooksImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * Define the mapping of the excel file data to the Book model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        return new Book([
            'title' => $row['title'],
            'description' => $row['description'],
            'published_at' => $row['published_at'],
            'bio' => $row['bio'],
            'cover' => $this->handleCoverImage($row['cover']),
            'author_id' => Auth::id(),
        ]);

    }

    /**
     * Validation rules for the imported books.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:2|max:100',
            'description' => 'required|string|min:5|max:500',
            'published_at' => 'required|date',
            'bio' => 'required|string|min:5|max:500',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ];
    }

    /**
     * Handle cover image if provided in the Excel file.
     *
     * @param string|null $cover
     * @return string|null
     */
    protected function handleCoverImage($cover)
    {
        if ($cover && file_exists($cover)) {

            $path = $cover->store('public/books');
            return $path;
        }

        return null;
    }
}
