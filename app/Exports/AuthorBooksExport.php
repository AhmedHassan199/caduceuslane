<?php
namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AuthorBooksExport implements FromArray, WithHeadings, WithColumnFormatting
{
    /**
     * Return an array of books for the logged-in author.
     *
     * @return array
     */
    public function array(): array
    {
        $books = Book::where('author_id', 1)->get([
            'title',
            'description',
            'published_at',
            'bio',
            'cover'
        ]);

        return $books->toArray(); // Convert the collection to an array
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
