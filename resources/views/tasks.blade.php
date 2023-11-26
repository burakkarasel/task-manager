@extends("layouts.app")
@section("title", "This is the tasks page")
@section("content")
    @forelse($tasks as $task)
        <a href="{{route("tasks.single", ["id" => $task->id])}}"> {{$task->title}}</a><br>
    @empty
        There are no tasks!
    @endforelse
@endsection