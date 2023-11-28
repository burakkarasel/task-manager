@extends("layouts.app")
@section("title", "This is the tasks page")
@section("content")
    <div>
        <a href="{{route('tasks.create')}}">
            Add Task
        </a>
    </div>
    @forelse($tasks as $task)
        <a href="{{route('tasks.single', ['task' => $task->id])}}"> {{$task->title}}</a><br>
    @empty
        There are no tasks!
    @endforelse
    @if($tasks->count())
        <nav>
            {{$tasks->links()}}
        </nav>
    @endif 
@endsection
