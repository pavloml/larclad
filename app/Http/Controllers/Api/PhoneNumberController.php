<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Response;

class PhoneNumberController extends Controller
{
    /**
     * Retrieves a contact phone number associated with the provided post
     * @param string $id Post id
     * @return Response
     */
    public function __invoke($id): Response
    {
        $user = Post::find($id)->user;

        if (empty($user)) {
            return response(['message' => 'Not Found'], 404);
        }

        return response(['phone' => $user->phone]);
    }
}
