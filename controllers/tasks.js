const { default: mongoose } = require("mongoose");
const Task = require("../models/task");
const GenericResponse = require("../models/genericResponse");

// list the tasks
const getAllTasks = async (req, res) => {
  try {
    const tasks = await Task.find();
    return res.status(200).json(new GenericResponse(true, 200, null, tasks));
  } catch (err) {
    return res.status(500).json(new GenericResponse(false, 500, err, null));
  }
};

// create a new task
const createTask = async (req, res) => {
  try {
    const task = await Task.create(req.body);
    return res.status(201).json(new GenericResponse(true, 201, null, task));
  } catch (err) {
    if (err === mongoose.Error.ValidationError)
      return res.status(400).json(new GenericResponse(false, 400, err, null));
    return res.status(500).json(new GenericResponse(false, 500, err, null));
  }
};

// get one task by id
const getTaskById = async (req, res) => {
  const { id } = req.params;
  try {
    const task = await Task.findOne({ _id: id });
    if (task) {
      return res.status(200).json(new GenericResponse(true, 200, null, task));
    }
    return res
      .status(404)
      .json(new GenericResponse(false, 404, "Not found with given ID", null));
  } catch (err) {
    return res.status(500).json(new GenericResponse(false, 500, err, null));
  }
};

// update task by id
const updateTaskById = async (req, res) => {
  const { id } = req.params;
  try {
    const task = await Task.findOneAndUpdate({ _id: id }, req.body, {
      new: true,
      runValidators: true,
    });
    if (task) {
      return res.status(200).json(new GenericResponse(true, 200, null, task));
    }
    return res
      .status(404)
      .json(new GenericResponse(false, 404, "Not found with given ID", null));
  } catch (err) {
    return res.status(500).json(new GenericResponse(false, 500, err, null));
  }
};

// delete task by id
const deleteTaskById = async (req, res) => {
  const { id } = req.params;
  try {
    const task = await Task.findOneAndDelete({ _id: id });
    if (task) {
      return res
        .status(200)
        .json(
          new GenericResponse(true, 200, "Deleted task with given ID", task)
        );
    }
    return res
      .status(404)
      .json(new GenericResponse(false, 404, "Not found with given ID", null));
  } catch (err) {
    return res.status(500).json(new GenericResponse(false, 500, err, null));
  }
};

module.exports = {
  getAllTasks,
  createTask,
  getTaskById,
  updateTaskById,
  deleteTaskById,
};
