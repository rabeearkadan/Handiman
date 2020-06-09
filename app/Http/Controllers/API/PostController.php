<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Integer;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function getPostById($id)
    {
        $post = Post::query()->find($id);

        return response()->json(['status' => 'success', 'post' => $post]);
    }

    public function employeePosts()
    {
        $posts = Auth::user()->posts()->get();
        return response()->json(['status' => 'success', 'posts' => $posts]);
    }

    public function getPosts()
    {
        $posts = Post::all();
        $post = $posts->map(function ($item) {
            $item->handyman = User::query()->find($item->user_ids[0])->SimplifiedArray();
            return $item;
        });
        $_posts = $post->map(function ($item) {
            $services = [];
            foreach ($item->service_ids as $service) {
                array_push($services, (Service::query()->find($service)->ServiceArray()));
            }
            $item->services = $services;
            return $item;
        });

        return response()->json(['status' => 'success', 'posts' => $_posts]);

    }

    public function deletePost($id)

    {
        Post::query()->find()->delete($id);

        $user = User::query()->find(Auth::id());
        $post = Post::query()->find($id);
        $post->users()->detach(Auth::id());
        $user->services()->detach($id);

        return response()->json(['status' => 'success']);
    }


    public function addPost(Request $request)
    {
        $params = $this->validate($request, [
            'title' => 'required',
            'body' => 'required']);

        $post = new Post();

        $post->title = $request->input('title');
        $post->body = $request->input('body');
//        dd($request->input('images'));
        if ($request->has('images')) {
            $imagesParam = $request->input('images');
            $images = [];
            foreach ($imagesParam as $image) {
                try {
                    $images[] = $this->uploadAny($image, 'posts', 'png');
                } catch (\Exception $e) {
                    return response()->json(['status' => 'error', 'message' => "error uploading image"]);
                }
            }
            $post->images = $images;
        }


        $post->save();
        if ($request->has('tags')) {
            $tags = $request->input('tags');
            foreach ($tags as $tag) {
                try {
                    $post->tags()->attach($tag);
                } catch (\Exception $e) {
                    return response()->json(['status' => 'error', 'message' => "error uploading image"]);
                }
            }
        }

        $post->users()->attach(Auth::id());
        return response()->json(['status' => 'success', 'post' => $post]);
    }

    public function editPost(Request $request, $id)
    {

        $post = Post::query()->find($id);

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        return response()->json(['status' => 'success']);

    }

    public function uploadAny($file, $folder, $ext = 'png')
    {
        $file = base64_decode($file);

        $file_name = Str::random(25) . '.' . $ext; //generating unique file name;
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
