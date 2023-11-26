<?php

use App\Models\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

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
    $tasks = Task::latest()
        ->get();
    return view("tasks", [
       "tasks" => $tasks,
    ]);
})->name("tasks.list");

Route::get("/tasks/{id}", function (string $id) {
    $task = Task::findOrFail($id);
    return view("task", [
        "task" => $task,
    ]);
})->name("tasks.single");
