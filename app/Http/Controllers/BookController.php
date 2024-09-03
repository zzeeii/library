<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class BookController extends BaseController
{
    use AuthorizesRequests;
    // Injecting the BookService dependency
    protected $bookService;

    /**
     * Constructor to initialize the BookService.
     *
     * @param  \App\Services\BookService  $bookService
     */
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
        
    }
 /**
     * Display a listing of the books, with optional filtering.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    { 
        $books = $this->bookService->filterBooks($request->all());
        return response()->json($books, 200);
     
    }

     /**
    * Store a newly created book in storage.
    *
    * @param  \App\Http\Requests\BookRequest  $request
    * @return \Illuminate\Http\JsonResponse
    */
    public function store(BookRequest  $request)
    {
       
        $book = $this->bookService->createBook($request->validated());
        return response()->json($book, 201);
    }

     /**
     * Display the specified book.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Book $book)
    {
        $book = $this->bookService->getBook($book);
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest  $request, Book $book)
    {
       
        $book = $this->bookService->updateBook($book, $request->validated());
        return response()->json($book, 200);
    }
    

    /**
     * Remove the specified book from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Book $book)
    {
        $this->bookService->deleteBook($book);
        return response()->json(null, 204);
    }
}
