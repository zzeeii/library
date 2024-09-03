<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
     /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = $this->userService->getAllUsers();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * Currently not implemented.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        $user = $this->userService->getUser($user);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $user = $this->userService->updateUser($user, $request->validated());
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);
        return response()->json(null, 204);
    }
}
