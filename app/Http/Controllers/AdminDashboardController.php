<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $weekNewPostsStats = DB::select(DB::raw('SELECT t.day::date, count(posts.id)'
            . 'FROM generate_series(current_date - interval \'6 days\' , current_date, interval  \'1 day\') AS t(day)'
            . 'LEFT JOIN posts ON t.day=posts.created_at::date GROUP BY t.day ORDER BY t.day'));

        $weekNewUsersStats = DB::select(DB::raw('SELECT t.day::date, count(users.id)'
            . 'FROM generate_series(current_date - interval \'6 days\' , current_date, interval  \'1 day\') AS t(day)'
            . 'LEFT JOIN users ON t.day=users.created_at::date GROUP BY t.day ORDER BY t.day'));


        return view('admin.dashboard.index', ['title' => config('app.name') . ' Dashboard',
            'newPostsToday' => Post::createdDate(now()->toDateString())->count(),
            'updatedPostsToday' => Post::updatedDate(now()->toDateString())->count(),
            'newUsersToday' => User::createdDate(now()->toDateString())->count(),
            'weekNewPostsStats' => json_encode($weekNewPostsStats),
            'weekNewUsersStats' => json_encode($weekNewUsersStats)]);
    }
}
