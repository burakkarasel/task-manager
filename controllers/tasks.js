const { default: mongoose } = require("mongoose");
const Task = require("../models/task");
const GenericResponse = require("../models/genericResponse");
const asyncWrapper = require("../middleware/async");
const { createCustomError, CustomAPIError } = require("../errors/custom-error");

// list the tasks
const getAllTasks = asyncWrapper(async (req, res) => {
  const tasks = await Task.find({});
  return res.status(200).json(new GenericResponse(true, 200, null, tasks));
});

// create a new task
const createTask = asyncWrapper(async (req, res) => {
  const task = await Task.create(req.body);
  return res.status(201).json(new GenericResponse(true, 201, null, task));
});

// get one task by id
const getTaskById = asyncWrapper(async (req, res, next) => {
  const { id } = req.params;
  const task = await Task.findOne({ _id: id });
  if (!task) {
    return next(createCustomError("Not found with given ID", 404));
  }
  return res.status(200).json(new GenericResponse(true, 200, null, task));
});

// update task by id
const updateTaskById = asyncWrapper(async (req, res, next) => {
  const { id } = req.params;

  const task = await Task.findOneAndUpdate({ _id: id }, req.body, {
    new: true,
    runValidators: true,
  });
  if (!task) {
    return next(createCustomError("Not found with given ID", 404));
  }

  return res.status(200).json(new GenericResponse(true, 200, null, task));
});

// delete task by id
const deleteTaskById = asyncWrapper(async (req, res, next) => {
  const { id } = req.params;
  const task = await Task.findOneAndDelete({ _id: id });
  if (!task) {
    return next(createCustomError("Not found with given ID", 404));
  }
  return res
    .status(200)
    .json(new GenericResponse(true, 200, "Deleted task with given ID", task));
});

module.exports = {
  getAllTasks,
  createTask,
  getTaskById,
  updateTaskById,
  deleteTaskById,
};
