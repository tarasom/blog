@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <div class="col-md-12">
                <h1>
                    {{ $post->getName() }}
                </h1>
                <div class="float-left m-md-5">
                    <img src="{{ $post->getImageUrl() }}"
                         alt=""
                         class="pull-left img-responsive img-thumbnail margin10">
                </div>
                <article>
                    {{ $post->getContent() }}
                </article>

                <div class="btn-group float-right">
                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-dark">
                            {{ __('posts.pages.show.buttons.edit') }}
                        </a>
                    @endcan
                    @can('update', $post)
                        <a href="{{ route('posts.destroy', $post) }}" class="btn btn-danger">
                            {{ __('posts.pages.show.buttons.destroy') }}
                        </a>
                    @endcan
                </div>

                <span>
                    {{ __('categories.text.categories') . ': '}}
                </span>
                <div class="row">
                    @foreach($post->categories as $category)
                        <a class="badge" href="{{ route('categories.show', $category) }}">
                            {{ $category->getName() }}
                        </a>
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
