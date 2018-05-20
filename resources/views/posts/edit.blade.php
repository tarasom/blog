@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="form-horizontal offset-md-2 col-md-8"
              method="POST"
              action="{{ route('posts.update', $post) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <fieldset>
                <!-- Form Name -->
                <legend>
                    {{ __('posts.pages.edit.title') }}
                </legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="name">
                        {{ __('posts.fields.name') }}
                    </label>
                    <div class="">
                        <input id="name"
                               name="name"
                               value="{{ old('name', $post->getName()) }}"
                               type="text"
                               placeholder=""
                               class="form-control input-md"
                               required=""/>
                        @if($errors->has('name'))
                            <span class="text-danger">
                                {{ $errors->first('name') }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- File Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="file">
                        {{ __('posts.fields.file') }}
                    </label>
                    <div class="col-md-8">
                        <input id="file"
                               name="file"
                               class="input-file"
                               type="file">
                        @if($errors->has('file'))
                            <span class="text-danger">
                                {{ $errors->first('file') }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="content">
                        {{ __('posts.fields.content') }}
                    </label>
                    <div class="">
                        <textarea class="form-control"
                                  id="content"
                                  name="content"
                                  rows="5">{{ old('content', $post->getContent()) }}</textarea>
                        @if($errors->has('content'))
                            <span class="text-danger">
                                {{ $errors->first('content') }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Categories-->

                <h3>
                    {{ __('categories.text.categories') }}
                </h3>
                <div class="row">
                    @foreach($categories as $categoryId => $categoryName)
                        <div class="form-check float-left">
                            <label>
                                <input type="checkbox" name="categories[{{$categoryId}}]"
                                        {{ $post->categories->contains('id', $categoryId) ? 'checked' : '' }}>
                                <span class="label-text">
                                    {{ $categoryName }}
                                </span>
                            </label>
                        </div>
                    @endforeach
                </div>

                <!-- Submit button -->

                <div class="form-group">
                    <div class="col-md-4 pull-right">
                        <input type="submit" id="submit" class="btn btn-primary"
                               value="{{ __('posts.pages.edit.buttons.update') }}"/>
                    </div>
                </div>

            </fieldset>
        </form>

    </div>
@endsection
