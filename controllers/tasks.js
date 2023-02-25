const { default: mongoose } = require("mongoose");
const Task = require("../models/task");
const GenericResponse = require("../models/genericResponse");

const getAllTasks = async (req, res) => {
  //   const { page, limit } = req.query;
  try {
    const tasks = await Task.find();
    return res.status(200).json(new GenericResponse(true, 200, null, tasks));
  } catch (err) {
    return res.status(500).json(new GenericResponse(false, 500, err, null));
  }
};

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

const updateTaskById = async (req, res) => {
  const { id } = req.params;
  const { name, completed } = req.body;
  try {
    const task = await Task.findOneAndUpdate(
      { _id: id },
      {
        name: name,
        completed: completed,
      }
    );
    if (task) {
      task.name = name;
      task.completed = completed;
      return res.status(200).json(new GenericResponse(true, 200, null, task));
    }
    return res
      .status(404)
      .json(new GenericResponse(false, 404, "Not found with given ID", null));
  } catch (err) {
    return res.status(500).json(new GenericResponse(false, 500, err, null));
  }
};

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
