<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use App\ImageUtility;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'category' => ['sometimes', 'numeric', Rule::in(Category::all()->pluck('id')->toArray())],
            'search' => 'sometimes|string'
        ]);
        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        $posts = Post::searchCategory($request->category)->content($request->search)->paginate(10);
        return jsonResponse(1, 'success', $posts);
    }
    public function favouritePosts()
    {
        $client = auth()->guard('client_api')->user();
        $posts = $client->favouritePosts()->paginate(10);
        return jsonResponse(1, 'success', $posts);
    }
    public function toggleFavouritePosts(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'post' => [Rule::in(Post::all()->pluck('id')->toArray())]
        ]);
        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        $client = $request->user();
        $client->favouritePosts()->toggle($request->post);
        return jsonResponse(1, 'تم التحديث بنجاح');
    }
    public function store(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'category_id' => ['required', Rule::in(Category::all()->pluck('id')->toArray())],
            'title' => 'required|string',
            'content' => 'required|string',
            'photo' => 'required|image|max:10240'
        ]);

        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        $image = $request->file('photo');
        $imageStr = ImageUtility::storeImage($image, '/storage/posts/', 200, 300);
        // dd($imageStr);
        $data = $request->except('photo');
        $data['photo'] =  $imageStr;
        $post = Post::create($data);
        return jsonResponse(1, 'تمت الاضافة', $post);
    }
    public function show(Post $post)
    {
        $isFavourite = auth()->guard('client_api')->user()->favouritePosts->contains($post);
        return jsonResponse(1, 'success', ['post' => $post, 'favourite' => $isFavourite]);
    }
    public function update(Request $request, Post $post)
    {
        $validator = validator()->make($request->all(), [
            'category_id' => ['sometimes', Rule::in(Category::all()->pluck('id')->toArray())],
            'title' => 'sometimes|string',
            'content' => 'sometimes|string',
            'photo' => 'sometimes|image|max:10240'
        ]);

        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        $data = $request->except('photo');
        if ($request->has('photo')) {
            ImageUtility::deleteImage($post->photo);
            $image = $request->file('photo');
            $imageStr = ImageUtility::storeImage($image, '/storage/posts/', 200, 300);
            $data['photo'] = $imageStr;
        }
        $post->update($data);
        return jsonResponse(1, 'تم التحديث', $post);
    }
    public function destroy(Post $post)
    {
        ImageUtility::deleteImage($post->photo);
        $post->delete();
        return jsonResponse(1, 'تم الحذف');
    }
}
