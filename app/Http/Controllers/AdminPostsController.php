<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostEditRequest;
use App\Http\Requests\PostRequest;
use App\Photo;
use App\Post;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Log;


class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Category::all();
        return view('admin.posts.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        try {
            DB::transaction(
                function () use ($request) {
                    $user = Auth::user();
                    $input = $request->all();
                    $input['user_id'] = $user->id;

                    if ($request->hasFile('photo_id')) {
                        $file = $request->file('photo_id');
                        $name = time() . $file->getClientOriginalName();
                        $file->move('images', $name);
                        $photo = Photo::create(['file' => $name]);
                        $input['photo_id'] = $photo->id;
                    }

                    Post::create($input);
                }
            );
        } catch (\Throwable $t) {
            Log::error($t);
        }

        return redirect(url('admin/posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $cats = Category::all();

        return view('admin.posts.edit', compact('post', 'cats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostEditRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $input = $request->all();

        if ($request->hasFile('photo_id')) {
            $file = $request->file('photo_id');
            $name = time() . $file->getClientOriginalName();
            if (empty($post->photo)) {
                $photo = Photo::create(['file' => $name]);
                $input['photo_id'] = $photo->id;
            } else {
                unlink(public_path($post->photo->file));
                $post->photo->update(['file' => $name]);
                unset($input['photo_id']); //remove photo_id from update array, to keep the id as it is
            }
            $file->move('images', $name);
        }

        $input['updated_at'] = Carbon::now()->toDateTimeString();
        $post->update($input);
        return redirect(url('admin/posts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $photo = Photo::findOrFail($post->photo_id);

        unlink(public_path() . $post->photo->file);

        $post->delete();
        $photo->delete();

        return redirect(url('admin/posts'));
    }
}
