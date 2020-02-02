<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;



use App\Events\NotificationSenderEvent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;

class PostController extends  Controller
{

    public static function getID($collection)
    {

        $seq = \DB::getCollection('posts')->findOneAndUpdate(
            array('_id' => $collection),
            array('$inc' => array('seq' => 1)),
            array('new' => true, 'upsert' => true, 'returnDocument' => \MongoDB\Operation\FindOneAndUpdate::RETURN_DOCUMENT_AFTER)
        );
        return $seq->seq;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function addPost(Request $request)
    {
        $post = new Post();
        $post->_id = self::getID(posts);

        $post->post_text = ['post_text'];
        $post->save();

        return response()->json(['status' => 'success', 'post' => $post]);
    }
}
