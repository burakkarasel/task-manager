@extends("layouts.app")
@section("title", $task->title)
@section("content")
    <p>{{$task->description}}</p>
    @isset($task->longDescription)
        <p>{{$task->longDescription}}</p>
    @endisset
    <p>{{$task->completed ? "Completed" : "Ongoing"}}</p>
    <p>{{$task->created_at}}</p>
    <p>{{$task->updated_at}}</p>
    <div>
        <a href="{{route('tasks.edit', ['task' => $task->id])}}">Edit</a>
    </div>
    <div>
        <form action="{{route('tasks.toggle', ['task' => $task->id])}}" method="post">
            @csrf
            @method("PATCH")
            <button type="submit">
                Mark as {{$task->completed ? "Ongoing" : "Completed"}}
            </button>
        </form>
    </div>
    <div>
        <form action="{{route('tasks.destroy', ['task' => $task->id])}}" method="POST">
            @csrf
            @method("DELETE")
            <button type="submit">Delete</button>
        </form>
    </div>
@endsection
