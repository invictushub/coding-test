<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    public function users(): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('users.index');
    }

    public function usersStats(): JsonResponse
    {
        $users = User::query()
            ->withCount('tasks')
            ->withCount('currentMonthCompletedTasks')
            ->withCount('currentWeekCompletedTasks')
            ->get();

        return \response()->json($users, ResponseAlias::HTTP_OK);
    }
}
