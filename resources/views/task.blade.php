@extends("layouts.app")
@section("title", $task->title)
@section("content")
    <nav class="mb-4">
        <a href="{{route('tasks.list')}}" class="link">
            ← Back to Task List
        </a>
    </nav>
    <p class="mb-4 text-slate-700">{{$task->description}}</p>
    @isset($task->longDescription)
        <p class="mb-4 text-slate-700">{{$task->longDescription}}</p>
    @endisset
    <p class="mb-4">
        @if ($task->completed)
            <span class="font-medium text-green-500">Completed</span>
        @else
            <span class="font-medium text-red-500">Ongoing</span>
        @endif
    </p>
    <p class="mb-4 text-sm text-slate-500">Created {{$task->created_at->diffForHumans()}} ∙ Updated {{$task->updated_at->diffForHumans()}}</p>
    <div class="flex justify-between">
        <a href="{{route('tasks.edit', ['task' => $task->id])}}" class="btn">Edit</a>
        <form action="{{route('tasks.toggle', ['task' => $task->id])}}" method="post">
            @csrf
            @method("PATCH")
            <button type="submit" class="btn">
                Mark as {{$task->completed ? "Ongoing" : "Completed"}}
            </button>
        </form>
        <form action="{{route('tasks.destroy', ['task' => $task->id])}}" method="POST">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn">Delete</button>
        </form>
    </div>
@endsection
