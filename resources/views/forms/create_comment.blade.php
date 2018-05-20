<form id="leave-comment-form" class="form-horizontal col-md-8 offset-md-2"
      method="POST"
      action="{{ route('comments.store') }}">
    <fieldset>
    @csrf

    <!-- Form Name -->
        <legend>
            {{ __('comments.text.leave_comment') }}
        </legend>

        <!-- Hidden input-->
        <input type="hidden" name="commentable_type" value="{{$commentableType}}"/>

        <!-- Hidden input-->
        <input type="hidden" name="commentable_id" value="{{$commentableId}}"/>

        <!-- Text input-->
        <div class="form-group">
            <label class="control-label" for="textinput">
                {{ __('comments.fields.author') }}
            </label>
            <div class="">
                <input id="author"
                       name="author"
                       type="text"
                       placeholder=""
                       class="form-control input-md">
            </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
            <label class="control-label" for="content">
                {{ __('comments.fields.content') }}
            </label>
            <div class="">
                <textarea class="form-control"
                          id="content"
                          name="content"></textarea>
            </div>
        </div>

        <!-- Submit button -->

        <div class="form-group">
            <div class="pull-right">
                <input type="submit" id="submit" class="btn btn-primary"
                       value="{{ __('comments.text.leave_comment') }}"/>
            </div>
        </div>

    </fieldset>
</form>
