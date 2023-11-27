@extends("layouts.app")

@section("title", "Update Task")

@section("style")
<style>
  .error-message{
    color: red;
    font-size: 0, 8rem;
  }
</style>
@endsection

@section("content")
<form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST">
    @csrf
    <!-- here we specify PUT so it will make a put request instead of POST -->
    @method("PUT")
    <div>
        <div>
            <label for="title">
                Title:
            </label>
            <input type="text" name="title" id="title" value="{{$task->title}}">
            @error("title")
              <p class="error-message">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="description">
                Description:
            </label>
            <textarea name="description" id="description" rows="5">
              {{$task->description}}
            </textarea>
            @error("description")
              <p class="error-message">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="longDescription">
                Long Description:
            </label>
            <textarea name="longDescription" id="longDescription" rows="10">
              {{$task->longDescription}}
            </textarea>
            @error("longDescription")
              <p class="error-message">{{$message}}</p>
            @enderror
        </div>
        <div>
            <button type="submit">
                Edit Task
            </button>
        </div>
    </div>
</form>
@endsection
