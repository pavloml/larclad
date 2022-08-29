<?php

namespace App\Http\Controllers\Api;

use App\Events\NewAbuseReport;
use App\Http\Controllers\Controller;
use App\Models\Complain;
use App\Models\Post;
use Illuminate\Http\Request;

class ComplainController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate(['postId' => 'required|integer', 'reason' => 'required|string|min:3|max:1000']);

        $post = Post::find($validated['postId']);

        if (!$post) {
            return response(['message' => 'Not Found'], 404);
        }

        $complain = new Complain;
        $complain->post_id = $post->id;
        $complain->reason = $validated['reason'];
        $complain->save();

        event(new NewAbuseReport($complain, $post));

        return response(['message' => __('Complain has been sent')], 200);

    }
}
