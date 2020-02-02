<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Integer;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function getPostId($id)
    {
        $post = Post::query()->find($id);

        return response()->json(['status' => 'success', 'post' => $post]);
    }

    public function addPost(Request $request)
    {
        $params = $this->validate($request, [
            'post_picture' => 'required',
            'post_text' => 'required']);

        $post = new Post();
        $post->post_text = $request->input('post_text');
        $post->user_id = Auth::user()->_id;

        $file_name = $this->uploadAny($params['post_picture'], 'uploads');
        $post->post_picture = $file_name;

        $post->request_id = $request->input('request_id'); // it maye be null
        $post->save();

        return response()->json(['status' => 'success', 'post' => $post]);
    }

    public function editPost(Request $request, $id)
    {

        $post = Post::query()->find($id);
        $post->post_text = $request->input('post_text');

    }

    public function uploadAny($file, $folder)
    {
        /** @var TYPE_NAME $file */
        $file = base64_decode($file);
        /** @var TYPE_NAME $file_name */
        $file_name = str_random(25) . '.png'; //generating unique file name;
        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }
        $result = false;
        if ($file != "") { // storing image in storage/app/public Folder
            $result = Storage::disk('public')->put($folder . '/' . $file_name, $file);

        }
        if ($result)
            return $folder . '/' . $file_name;
        else
            return null;
    }
}
