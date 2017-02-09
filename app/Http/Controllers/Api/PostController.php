<?php

namespace App\Http\Controllers\Api;

use App\Events\StatusWasUpdated;
use App\Http\Controllers\Controller;
use App\Post;
use App\Traits\ApiJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use ApiJsonResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $posts = Post::all();
            $posts->each(function($post) {
                $post['comments'] = $post->getThreadedComments();
            });
            return response()->json($this->successResponse($posts,''));
        }catch(\Exception $exception){
            return response()->json($exception->getMessage());
        }
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
        try{
            $validator = Validator::make($request->all(), [
                'content' => 'required|max:65535'
                ]);
            if($validator->fails()){
                return response()->json($this->errorResponse($validator->errors(),''));
            }else{
                $post = Post::create(['user_id' => $request->user()->id,'content' => $request->get('content')]);
                $post['comments'] = $post->getThreadedComments();
                event(new StatusWasUpdated($post));
                return response()->json($this->successResponse($post,''));
            }
        }catch(\Exception $exception){
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
