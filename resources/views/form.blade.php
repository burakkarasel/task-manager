@extends("layouts.app")

@section("title", @isset($task) ? "Edit Task" : "Add Task")

@section("content")
<form action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.insert') }}" method="POST">
    @csrf
    @isset($task)
      @method("PUT")
    @endisset
    <div>
        <div class="mb-4">
            <label for="title">
                Title:
            </label>
            <input type="text" name="title" id="title" value="{{$task->title ?? old('title')}}" @class(["border-red-500" => $errors->has("title")])>
            @error("title")
              <p class="error-message">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description">
                Description:
            </label>
            <textarea name="description" id="description" rows="5" @class(["border-red-500" => $errors->has("description")])>
              {{$task->description ?? old("description")}}
            </textarea>
            @error("description")
              <p class="error-message">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="longDescription">
                Long Description:
            </label>
            <textarea name="longDescription" id="longDescription" rows="10" @class(["border-red-500" => $errors->has("longDescription")])>
              {{$task->longDescription ?? old("longDescription")}}
            </textarea>
            @error("longDescription")
              <p class="error-message">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-4 flex gap-2">
            <button type="submit" class="btn">
              @isset($task)
                Update Task
              @else
                Add Task
              @endisset
            </button>
            <a href="{{route('tasks.list')}}" class="btn">Cancel</a>
        </div>
    </div>
</form>
@endsection
