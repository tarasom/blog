<?php

require_once __DIR__ . '/public/index.php';

factory(\App\Entities\Category::class, 10)->create()->each(function ($category) {
    $categoryPostsCount = random_int(0, 10);

    while ($categoryPostsCount-- !== 0) {
        createPost($category);
    }

    $categoryCommentsCount = random_int(0, 3);

    while ($categoryCommentsCount-- !== 0) {
        createComment($category);
    }
});

function createPost(\App\Entities\Category $category)
{
    /**
     * @var \App\Entities\Post $post
     */
    $post = factory(\App\Entities\Post::class)->create();

    $post->categories()->attach($category);

    $commentsPostsCount = random_int(1, 5);

    while ($commentsPostsCount-- !== 0) {
        createComment($post);
    }
}

function createComment(\Illuminate\Database\Eloquent\Model $model)
{
    $generator         = app(\Faker\Generator::class);
    $commentRepository = app(\App\Repositories\Contracts\CommentRepository::class);

    $mapping = \Illuminate\Database\Eloquent\Relations\Relation::$morphMap;

    $commentableType = array_search(get_class($model), $mapping);

    $commentData = [
        'author'           => implode(' ', array_map('ucfirst', $generator->words(2))),
        'content'          => $generator->sentences(2, true),
        'commentable_id'   => $model->getKey(),
        'commentable_type' => $commentableType,
    ];

    $commentRepository->create($commentData);
}

