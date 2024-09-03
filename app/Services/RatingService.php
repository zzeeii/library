<?php
// app/Services/RatingService.php
namespace App\Services;

use App\Models\Rating;

class RatingService
{
    /**
     * Create a new rating record in the database.
     * @param array $data
     * @return Rating
     */
    public function createRating(array $data)
    {
        return Rating::create($data);
    }
/**
     * Update an existing rating record in the database.
     * @param Rating $rating
     * @param array $data
     * @return Rating
     */
    public function updateRating(Rating $rating, array $data)
    {
        $rating->update($data);
        return $rating;
    }
 /**
     * Delete a specific rating record from the database.
     * @param Rating $rating
     * @return bool
     */
    public function deleteRating(Rating $rating)
    {
        return $rating->delete();
    }
}
