const express = require("express");

const getAllTasks = (req, res) => {
  res.json({ message: "LISTING" });
};

const createTask = (req, res) => {
  res.json(req.body);
};

const getTaskById = (req, res) => {
  res.json({ message: `GET BY ID ${req.params.id}` });
};

const updateTaskById = (req, res) => {
  res.json({ message: `UPDATE BY ID ${req.params.id}`, task: req.body });
};

const deleteTaskById = (req, res) => {
  res.json({ message: `DELETE BY ID ${req.params.id}` });
};

module.exports = {
  getAllTasks,
  createTask,
  getTaskById,
  updateTaskById,
  deleteTaskById,
};
