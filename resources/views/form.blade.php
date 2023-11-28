@extends("layouts.app")

@section("title", @isset($task) ? "Edit Task" : "Add Task")

@section("style")
<style>
  .error-message{
    color: red;
    font-size: 0, 8rem;
  }
</style>
@endsection

@section("content")
<form action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.insert') }}" method="POST">
    @csrf
    @isset($task)
      @method("PUT")
    @endisset
    <div>
        <div>
            <label for="title">
                Title:
            </label>
            <input type="text" name="title" id="title" value="{{$task->title ?? old('title')}}">
            @error("title")
              <p class="error-message">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="description">
                Description:
            </label>
            <textarea name="description" id="description" rows="5">
              {{$task->description ?? old("description")}}
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
              {{$task->longDescription ?? old("longDescription")}}
            </textarea>
            @error("longDescription")
              <p class="error-message">{{$message}}</p>
            @enderror
        </div>
        <div>
            <button type="submit">
              @isset($task)
                Update Task
              @else
                Add Task
              @endisset
            </button>
        </div>
    </div>
</form>
@endsection
