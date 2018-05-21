@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="list-group">
            @foreach ($sessions as $browserData)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $browserData->browser_family }}
                    <span class="badge badge-primary badge-pill">
                        {{ $browserData->total }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
