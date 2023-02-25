const express = require("express");
const {
  getAllTasks,
  createTask,
  getTaskById,
  updateTaskById,
  deleteTaskById,
} = require("../controllers/tasks");

const router = express.Router();

router.route("/").get(getAllTasks);
router.route("/").post(createTask);
router.route("/:id").get(getTaskById);
router.route("/:id").patch(updateTaskById);
router.route("/:id").delete(deleteTaskById);

module.exports = router;
