@extends("layouts.app")

@section("title", "Add Task")

@section("style")
<style>
  .error-message{
    color: red;
    font-size: 0, 8rem;
  }
</style>
@endsection

@section("content")
<form action="{{ route('tasks.insert') }}" method="POST">
    @csrf
    <div>
        <div>
            <label for="title">
                Title:
            </label>
            <input type="text" name="title" id="title" value="{{old('title')}}">
            @error("title")
              <p class="error-message">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="description">
                Description:
            </label>
            <textarea name="description" id="description" rows="5">
              {{old("description")}}
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
              {{old("longDescription")}}
            </textarea>
            @error("longDescription")
              <p class="error-message">{{$message}}</p>
            @enderror
        </div>
        <div>
            <button type="submit">
                Add Task
            </button>
        </div>
    </div>
</form>
@endsection
