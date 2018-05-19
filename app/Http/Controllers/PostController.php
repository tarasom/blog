<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Entities\Post;
use App\Repositories\Contracts\PostRepository;
use App\Services\Contracts\PostImageService;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * @var PostRepository
     */
    public $postRepository;

    /**
     * @var PostImageService
     */
    public $postImageService;

    public function __construct(PostRepository $postRepository, PostImageService $postImageService)
    {
        $this->postRepository   = $postRepository;
        $this->postImageService = $postImageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postRepository->scopeQuery(function (Post $query) {
            return $query->latest();
        })->paginate();

        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(PostRequest $request)
    {
        $this->authorize('create', Post::class);

        $destinationPath = null;

        if ($request->hasFile('file')) {
            $destinationPath = $this->postImageService->store($request->file('file'));
        }

        $attributes = array_merge($request->all(), [
            'file_name' => pathinfo($destinationPath, PATHINFO_BASENAME),
        ]);

        $post = $this->postRepository->create($attributes);

        return redirect()->route('posts.show', $post)->withMessage('Ok');
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return mixed
     */
    public function show(Post $post)
    {
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit')->withPost($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $destinationPath = $post->getFileName();

        if ($request->hasFile('file')) {
            $destinationPath = $this->postImageService->store($request->file('file'));
        }

        $attributes = array_merge($request->all(), [
            'file_name' => pathinfo($destinationPath, PATHINFO_BASENAME),
        ]);

        $updatedPost = $this->postRepository->update($attributes, $post->getKey());

        return redirect()->route('posts.show', $updatedPost)->withMessage('Ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

    }
}
