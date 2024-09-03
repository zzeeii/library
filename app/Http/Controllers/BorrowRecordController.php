<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowRecordRequest;
use App\Http\Requests\ReturnBookRequest;
use App\Http\Requests\ReturnRecordRequest;
use App\Models\Borrow_record;
use App\Services\BorrowRecordService;
use Illuminate\Http\Request;

class BorrowRecordController extends Controller
{  
    /**
     * Constructor to initialize the BorrowRecordService.
     *
     * @param  \App\Services\BorrowRecordService  $borrowRecordService
     */
    protected $borrowRecordService;

    public function __construct(BorrowRecordService $borrowRecordService)
    {
        $this->borrowRecordService = $borrowRecordService;
    }

    /**
     * Display a listing of all borrow records.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $borrowRecords = $this->borrowRecordService->getAllBorrowRecords();
        return response()->json($borrowRecords);    }

    /**
     * Store a newly created borrow record in storage.
     *
     * @param  \App\Http\Requests\BorrowRecordRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BorrowRecordRequest $request)
    {
        $borrowRecord = $this->borrowRecordService->createBorrowRecord($request->validated());
        return response()->json($borrowRecord, 201);
    }

    /**
     * Display the specified borrow record.
     *
     * @param  \App\Models\Borrow_record  $borrow_record
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Borrow_record $borrow_record)
    {
        $borrowRecord = $this->borrowRecordService->getBorrowRecord($borrow_record);
        return response()->json($borrowRecord);
    }

    /**
     * Update the specified borrow record to mark a book as returned.
     *
     * @param  \App\Http\Requests\ReturnBookRequest  $request
     * @param  \App\Models\Borrow_record  $borrow_record
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ReturnBookRequest $request, Borrow_record $borrow_record)
    {
        $borrowRecord = $this->borrowRecordService->returnBook($borrow_record, $request->validated());
        return response()->json($borrowRecord, 200);
    }

    /**
     * Remove the specified borrow record from storage.
     *
     * @param  \App\Models\Borrow_record  $borrow_record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Borrow_record $borrow_record)
    {
        $this->borrowRecordService->deleteBorrowRecord($borrow_record);
        return response()->json(null, 204);
    }
}
