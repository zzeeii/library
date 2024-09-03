<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Models\Rating;
use App\Services\RatingService;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    protected $ratingService;

    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
       
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param RatingRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RatingRequest $request)
    {
        $rating = $this->ratingService->createRating($request->validated());
        return response()->json($rating, 201);
    }
 /**
     * Display the specified resource.
     * Currently not implemented.
     * @param Rating $rating
     */
    public function show(Rating $rating)
    {
        //
    }

     /**
     * Update the specified resource in storage.
     * @param RatingRequest $request
     * @param Rating $rating
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RatingRequest $request, Rating $rating)
    {
        $rating = $this->ratingService->updateRating($rating, $request->validated());
        return response()->json($rating, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param Rating $rating
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Rating $rating)
    {
        $this->ratingService->deleteRating($rating);
        return response()->json(null, 204);
    }
}
