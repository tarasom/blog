@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <h1>
                    {{ $category->getName() }}
                </h1>
                <div class="row">
                    {{ $category->getDescription() }}
                </div>

                <div class="btn-group float-right">
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
        </div>
    </div>
    </div>
@endsection
