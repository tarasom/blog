@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="form-horizontal offset-md-2 col-md-8"
              method="POST"
              action="{{ route('categories.update', $category) }}">
            @csrf
            @method('PUT')

            <fieldset>

                <!-- Form Name -->
                <legend>
                    {{ __('categories.pages.edit.title') }}
                </legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="name">
                        {{ __('categories.fields.name') }}
                    </label>
                    <div class="">
                        <input id="name"
                               name="name"
                               value="{{ old('name', $category->getName()) }}"
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

                <!-- Textarea -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="description">
                        {{ __('categories.fields.description') }}
                    </label>
                    <div class="">
                        <textarea class="form-control"
                                  id="description"
                                  name="description"
                                  rows="5">{{ old('description', $category->getDescription()) }}</textarea>
                        @if($errors->has('description'))
                            <span class="text-danger">
                                {{ $errors->first('description') }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Submit button -->

                <div class="form-group">
                    <div class="pull-right">
                        <input type="submit" id="submit" class="btn btn-primary"
                               value="{{ __('categories.pages.edit.buttons.update') }}"/>
                    </div>
                </div>

            </fieldset>
        </form>

    </div>
@endsection
