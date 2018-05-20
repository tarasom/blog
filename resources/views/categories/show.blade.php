@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-right">
                    <h4>
                        {{ __('categories.fields.name') }}
                    </h4>
                </div>
                <div class="col-md-6">
                    {{ $category->getName() }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-right">
                    <h4>
                        {{ __('categories.fields.description') }}
                    </h4>
                </div>
                <div class="col-md-6">
                    {{ $category->getDescription() }}
                </div>
            </div>
            <div class="col-md-4 pull-right">
                <div class="btn-group float-left text-right pull-right">
                    @can('update', $category)
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-dark">
                            {{ __('categories.pages.show.buttons.edit') }}
                        </a>
                    @endcan
                    @can('update', $category)
                        <a href="{{ route('categories.destroy', $category) }}" class="btn btn-danger">
                            {{ __('categories.pages.show.buttons.destroy') }}
                        </a>
                    @endcan
                </div>
            </div>
            <div class="clearfix"></div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="comments-tab" data-toggle="tab" href="#comments" role="tab"
                       aria-controls="comments" aria-selected="true">
                        {{ __('comments.text.comments') }}
                        <span class="badge-info badge-pill">
                            {{ $category->comments->count() }}
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="posts-tab" data-toggle="tab" href="#posts" role="tab"
                       aria-controls="posts" aria-selected="false">
                        {{ __('posts.text.posts') }}
                        <span class="badge-info badge-pill">
                            {{ $posts->count() }}
                        </span>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="comments" role="tabpanel" aria-labelledby="comments-tab">
                    <div class="col-md-12">
                        <div class="row">
                            @include('forms.create_comment', [
                            'commentableType' => 'category',
                            'commentableId' => $category->getKey(),
                            ])
                        </div>
                        @foreach($category->comments as $comment)
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="thumbnail">
                                        <img class="img-responsive user-photo w-50"
                                             src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <strong>
                                                {{ $comment->getAuthor() }}
                                            </strong>
                                            <span class="text-muted">commented 5 days ago</span>
                                        </div>
                                        <div class="panel-body">
                                            {{ $comment->getContent() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                    <ul class="list-group">
                        @foreach($posts as $post)
                            <li class="list-group-item">
                                <a href="{{ route('posts.show', array_get($post, 'id')) }}">
                                    {{ array_get($post, 'name') }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
