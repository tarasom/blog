@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
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
        </div>

        <div class="row">
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
        <div class="row">
            <p>
                {{ __('categories.text.categories') . ': '}}
            </p>
            <div class="form-group">

                @foreach($post->categories as $category)
                    <a class="badge" href="{{ route('categories.show', $category) }}">
                        {{ $category->getName() }}
                    </a>
                    </span>
                @endforeach
            </div>
        </div>
        <div class="row">
            @include('forms.create_comment', [
            'commentableType' => 'post',
            'commentableId' => $post->getKey(),
            ])
        </div>
    </div>
@endsection
@section('scripts')
    @parent

    <script src="{{ mix('js/comment.js') }}" type="text/javascript"></script>

@endsection
