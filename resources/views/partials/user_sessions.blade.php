<div class="container mb-5">
    <h3>
        {{ __('Unique visitors') }} 
    </h3>
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