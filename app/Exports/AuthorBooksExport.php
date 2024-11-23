<?php
// app/Exports/AuthorBooksExport.php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AuthorBooksExport implements FromCollection, WithHeadings, WithColumnFormatting
{
    /**
     * Return a collection of books for the logged-in author.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Get the logged-in author and fetch their books
        return Book::where('author_id', auth()->id())->get([
            'title',
            'description',
            'published_at',
            'bio',
            'cover'
        ]);
    }

    /**
     * Define the headings for the export file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Title',
            'Description',
            'Published At',
            'Bio',
            'Cover'
        ];
    }

    /**
     * Define column formatting (e.g., for date columns).
     *
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_DATE_YYYYMMDD, // Format the 'Published At' column as a date
        ];
    }
}
