@extends("layouts.app")
@section("title", $task->title)
@section("content")
    <p>{{$task->description}}</p>
    @isset($task->longDescription)
        <p>{{$task->longDescription}}</p>
    @endisset
    <p>{{$task->completed}}</p>
    <p>{{$task->created_at}}</p>
    <p>{{$task->updated_at}}</p>
    <div>
        <form action="{{route('tasks.destroy', ['task' => $task->id])}}" method="POST">
            @csrf
            @method("DELETE")
            <button type="submit">Delete</button>
        </form>
    </div>
@endsection
