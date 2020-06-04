<?php

namespace App\Http\Controllers\FRONT\Employee;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /** Functions
     * index()
     * create()
     * store()
     * destroy()
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $services = Service::all();
        $postCount = $user->posts->count();
        $slideIndex = array();
        $slideId = array();
        for($index=0;$index<$postCount;$index++){
            $slideIndex[$index] = 1 ;
            $slideId[$index] = "mySlides".$index;
        }
        return view('front.employee.post.index', compact(['user', 'services', 'slideIndex', 'slideId','postCount']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $user = Auth::user();
        return view('front.employee.post.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $post = new Post();
        $request->validate([
            'title' => 'required|min:3',
            'body' => 'required|min:15',
            'images' => 'required',
            'tags' => 'required'
        ]);
        $requestImages = $request->file('images');
        $images = array();
        foreach ($requestImages as $image) {
            $name = 'post_' . time() . Str::random(16). '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('posts')) {
                Storage::disk('public')->makeDirectory('posts');
            }
            if (Storage::disk('public')->putFileAs('posts', $image, $name)) {
                $element = 'posts/' . $name;
                array_push($images, $element);
            }
        }
        $post->title = $request->title;
        $post->body = $request->body;
        $post->images = $images;
        $post->save();
        $post->users()->attach($user->id);
            foreach ($request->tags as $tagId) {
                try
                {
                    $service = Service::findOrFail($tagId);
                }
                catch(ModelNotFoundException $e)
                {
                    dd('later');
                }
                $post->tags()->attach($service);
            }
        return redirect(route('employee.post.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try
        {
            $post = Post::findorFail($id);
        }
        catch(ModelNotFoundException $e)
        {
            dd('later');
        }
        $post->delete();
        return redirect(route('employee.post.index'));
    }

}
