<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    private static function getID($collection)
    {

        $seq = \DB::getCollection('posts')->findOneAndUpdate(
            array('_id' => $collection),
            array('$inc' => array('seq' => 1)),
            array('new' => true, 'upsert' => true, 'returnDocument' => \MongoDB\Operation\FindOneAndUpdate::RETURN_DOCUMENT_AFTER)
        );
        return $seq->seq;
    }

    private function addPost(Request $request)
    {
        $post = new Post();
        $post->_id = self::getID(posts);

        $post->post_text = ['post_text'];
        $post->save();

        return response()->json(['status' => 'success', 'post' => $post]);
    }
}
