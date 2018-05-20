@extends('layouts.app')

@section('content')
    <div class="container">
        <div role="button" class="add-resource"
             tabindex="0">
            <a href="{{ route('categories.create') }}" class="add-resource-plus">
                +
            </a>
        </div>
        <ul class="list-group">
            @foreach ($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('categories.show', $category) }}">
                        {{ $category->getName() }}
                    </a>
                    <span class="badge badge-primary badge-pill">
                        {{ $category->posts_count }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
