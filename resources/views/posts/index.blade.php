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
        <div class="row">
            <div class="col-md-4">
                <div class="">
                    <div class="list-group list-group">
                        @if(count($categories) > 0)
                            <h4 class="">
                                {{ __('messages.category') }}
                            </h4>
                        @endif
                        @foreach($categories as $category)
                            <a href="{{ route('categories.show', $category) }}"
                               class="text-uppercase text-muted list-group-item">
                                {{ $category->getName() }}
                                <span class="badge pull-right">
                                    {{ $category->posts_count }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row m-auto justify-content-center">
                    {{ $posts->links() }}
                </div>

                @foreach ($posts as $post)
                    <div class="row">
                        <div class="col-sm-4">
                            <a href="{{ route('posts.show', $post) }}" class="">
                                <img src="{{ $post->getImageUrl() }}"
                                     class="img-fluid">
                            </a>
                        </div>
                        <div class="col-sm-8">
                            <h3 class="title">
                                {{ $post->getName() }}
                            </h3>
                            <div class="text-muted col-md-6">
                                {{ __('messages.date') }}
                                <span class="glyphicon glyphicon-calendar">
                                {{ \Carbon\Carbon::parse($post->created_at) }}
                                </span>
                            </div>
                            <div class="text-muted col-md-6">
                                {{ __('messages.comments') }}
                                <span class="badge badge">
                                {{ $post->comments_count }}
                                </span>
                            </div>
                            <p class="text-justify">
                                {{ str_limit($post->getContent(), 300) }}
                            </p>
                            <a class="btn btn-link pull-right" href="{{ route('posts.show', $post) }}">
                                {{ __('posts.pages.index.buttons.read_more') }}
                            </a>
                        </div>
                    </div>
                    <hr>
                @endforeach
                <div class="row m-auto justify-content-center">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
