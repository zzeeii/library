<?php
namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     * Retrieve all users along with their associated borrow records and book ratings.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllUsers()
    {
        $users = User::with(['borrowRecords.book', 'ratings.book'])->get();
        return   $users;
    }
 /**
     * Retrieve a specific user record.
     * @param User $user
     * @return User
     */
    public function getUser(User $user)
    {
        return $user;
    }
 /**
     * Update the details of a specific user record.
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateUser(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }
/**
     * Delete a specific user record from the database.
     * @param User $user
     * @return bool
     */
    public function deleteUser(User $user)
    {
        return $user->delete();
    }
}
