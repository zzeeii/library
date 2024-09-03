<?php
namespace App\Services;

use App\Models\Book;
use Illuminate\Http\Request;

class BookService
{
    /**
     * Create a new book record in the database.
     * @param array $data
     * @return Book
     */


    public function createBook(array $data)
    {
        return Book::create($data);
    }
/**
     * Retrieve information about a specific book.
     * @param Book $book
     * @return array
     */
    public function getBook(Book $book)
    {
        return [
            $book,
            'is_available' => $book->is_available,
            'average_rating' => $book->averageRating(),
        ];
    }
/**
     * Update the specified book record in the database.
     * @param Book $book
     * @param array $data
     * @return Book
     */
    public function updateBook(Book $book, array $data)
    {
      
        $book->update($data);
        return $book;
    }
 /**
     * Delete the specified book record from the database.
     * @param Book $book
     * @return bool
     */
    public function deleteBook(Book $book)
    {
        return  $book->delete(); 
    }

    /**
     * Filter books based on provided criteria.
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function filterBooks(array $filters)
    {
        $query = Book::query();

        if (isset($filters['author'])) {
            $query->where('author', $filters['author']);
        }

        if (isset($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        if (isset($filters['available'])) {
            $query->where('is_available', $filters['available']);
        }

        return $query->get();
    }
}
