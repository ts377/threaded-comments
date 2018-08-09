<?php

namespace App\Http\Controllers\Api;

use App\CommentLink;
use App\Http\Controllers\Controller;
use App\Post;
use App\Traits\ApiJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\CommentData;
use App\PostLink;
use SplDoublyLinkedList;
use App\PostData;
class CommentController extends Controller
{
    use ApiJsonResponse;
    public static $list;
    public static $searchnode;
    public static $postlink;
    public $user_id;
     public $post_id;
     public static $pdata;
     public static $flag=0;

    public function __construct()
    {
        self::$postlink=new PostLink();
        self::$searchnode=self::$postlink;
        self::$pdata = new PostData();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $post1=null;
                while (static::$postlink->getValid()) {
                    static::$searchnode = static::$postlink;
                    if ((static::$postlink->searchList(static::$searchnode, Input::get('post_id'))) != false)
                    {
                        $post1 = static::$postlink;
                        static::$flag=1;
                        $user_id= static::$postlink->getUserId($post1);
                        $post_id=static::$postlink->getPostId($post1);
                        break;
                    }
                    else
                        {
                        $next = static::$postlink->getNext();
                        static::$postlink = $next;
                    }
                }


            if( static::$flag=1) {
                $post = Post::where('id', '=', Input::get('post_id'))->first();
                $post->addComment([
                    'content' => $request->get('content'),
                    'parent_id' => $request->get('parent_id', null)
                ]);
            }
            return response()->json($this->successResponse($post->getThreadedComments(),''));
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}