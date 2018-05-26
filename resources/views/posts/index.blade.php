@extends('layouts.app')

@section('content')
    <div class="container">
        @can('create', \App\Entities\Post::class)
        <div role="button" class="add-resource"
             tabindex="0">
            <a href="{{ route('posts.create') }}" class="add-resource-plus">
                +
            </a>
        </div>
        @endcan
        <div class="row m-auto">
            {{ $posts->links() }}
        </div>
        @foreach ($posts as $post)
            <div class="card">
                <div class="card-body">
                    <a class="" href="{{ route('posts.show', $post) }}">
                        <img class="card-img col-lg-4 col-md-6 col-sm-12 col-xs-12"
                             src="{{ $post->getImageUrl() }}">
                    </a>
                    <div class="card-title">
                        <h4 class="media-heading">
                            {{ $post->getName() }}
                        </h4>
                        {{ str_limit($post->getContent(), 10) }}
                        </p>
                        <a class="btn btn-link pull-right" href="{{ route('posts.show', $post) }}">
                            {{ __('posts.pages.index.buttons.read_more') }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row m-auto">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
