<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;

class PostController extends Controller
{

    public function getPostId($id)
    {
        $post = Post::query()->find($id);

        return response()->json(['status' => 'success', 'post' => $post]);
    }

    public function addPost(Request $request)
    {
        $post = new Post();
        $post->post_text = $request->input('post_text');
        $post->user_id = Auth::user()->_id;
        $post->request_id = $request->input('request_id'); // it maye be null
        $post->save();

        return response()->json(['status' => 'success', 'post' => $post]);
    }
}
