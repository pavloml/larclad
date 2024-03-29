<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complain;
use Illuminate\Http\Request;

class AdminComplainController extends Controller
{
    public function countUnreviewedComplains(Request $request)
    {
        return response(['count' => Complain::where('is_reviewed', false)->count()]);
    }
}
