<?php
namespace App\Services;

use App\Models\Book;
use App\Models\Borrow_record;
use Illuminate\Support\Carbon;

class BorrowRecordService
{
    /**
     * Retrieve all borrow records from the database.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllBorrowRecords()
    {
        return Borrow_record::all();
    }
/**
     * Create a new borrow record and mark the associated book as unavailable.
     * @param array $data
     * @return Borrow_record
     */
    public function createBorrowRecord(array $data)
    { 
        $book=Book::where('id', $data['book_id'])->first();
        
       $book->update(['is_available' => false]);
        return Borrow_record::create($data);
    }
/**
     * Mark a borrowed book as returned and update its availability status.
     * @param Borrow_record $borrowRecord
     * @param array $data
     * @return Borrow_record
     */
    public function returnBook(Borrow_record $borrowRecord, array $data)
    {
        
        $borrowRecord->update(['returned_at' => Carbon::now()]);

        $borrowRecord->book->update(['is_available' => true]);

        return $borrowRecord;
    }
    /**
     * Retrieve a specific borrow record.
     * @param Borrow_record $borrow_record
     * @return Borrow_record
     */
    public function getBorrowRecord(Borrow_record $borrow_record)
    {
        
        return $borrow_record;
    }

    /**
     * Delete a specific borrow record from the database.
     * @param Borrow_record $borrow_record
     * @return bool
     */

    public function deleteBorrowRecord(Borrow_record $borrow_record)
    {
        return $borrow_record->delete();
    }
}
