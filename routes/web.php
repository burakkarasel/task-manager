<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('index', [
        "name" => "John",
        "lastName" => "Doe"
    ]);
});*/


Route::get("/", function () {
   return redirect()->route("tasks.list");
});

Route::get("/tasks", function () {
    $tasks = Task::latest()->paginate(10);
    return view("tasks", [
       "tasks" => $tasks,
    ]);
})->name("tasks.list");

Route::view("/tasks/create", "create")->name("tasks.create");

Route::get("/tasks/{task}/edit", function(Task $task) {
    return view("edit", [
        "task" => $task,
    ]);
})->name("tasks.edit");

Route::get("/tasks/{task}", function (Task $task) {
    return view("task", [
        "task" => $task,
    ]);
})->name("tasks.single");

Route::post("/tasks", function(TaskRequest $request) {
    $data = $request->validated();
    $task = Task::create($data);
    return redirect()->route("tasks.single", ["task" => $task->id])->with("success", "Task created successfully!");
})->name("tasks.insert");

Route::put("/tasks/{task}", function(Task $task, TaskRequest $request) {
    $data = $request->validated();
    $task->updateOrFail($data);
    return redirect()->route("tasks.single", ["task" => $task->id])->with("success", "Task updated successfully!");
})->name("tasks.update");

Route::delete("/tasks/{task}", function(Task $task) {
    $task->deleteOrFail();
    return redirect()->route("tasks.list")->with("success", "Task deleted successfully");
})->name("tasks.destroy");

Route::patch("/tasks/{task}", function(Task $task) {
    $task->toggleCompleted();
    return redirect()->back()->with("success", "Task updated successfully");
})->name("tasks.toggle");
