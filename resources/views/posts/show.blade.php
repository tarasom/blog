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
            <article class="text-justify">
                {{ $post->getContent() }}
            </article>
        </div>

        <div class="row">
            @can('update', $post)
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-dark">
                    {{ __('posts.pages.show.buttons.edit') }}
                </a>
            @endcan
            @can('delete', $post)
                <a href="{{ route('posts.destroy', $post) }}"
                   data-method="DELETE"
                   data-token="{{csrf_token()}}"
                   class="btn btn-danger">
                    {{ __('posts.pages.show.buttons.destroy') }}
                </a>
            @endcan
        </div>
        <br/>
        <div class="row">
            <p class="text-muted">
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
        <div class="comments col-md-8 offset-md-2">
            @foreach($post->comments as $comment)
                <div class="row">
                    <div class="col-sm-2">
                        <div class="thumbnail">
                            <img class="img-responsive user-photo" width="100px"
                                 src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                        </div>
                    </div>

                    <div class="col-sm-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>
                                    {{ $comment->getAuthor() }}
                                </strong>
                                <span class="text-muted">commented
                                    {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
                                </span>
                            </div>
                            <div class="panel-body text-justify">
                                {{ $comment->getContent() }}
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
    @parent

    <script src="{{ mix('js/laravel.js') }}" type="text/javascript"></script>
    <script src="{{ mix('js/comment.js') }}" type="text/javascript"></script>

@endsection
