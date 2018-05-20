<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Repositories\Contracts\CommentRepository;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * @param CommentRepository $commentRepository
     * @param CommentRequest $request
     * @return JsonResponse
     */
    public function store(CommentRepository $commentRepository, CommentRequest $request): JsonResponse
    {
        $newComment = $commentRepository->create($request->all());

        return response()->json($newComment->toArray());
    }
}
