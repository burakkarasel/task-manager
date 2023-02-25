const express = require("express");
const tasks = require("./routes/tasks");
const connectDb = require("./db/connect");
const notFound = require("./middleware/not-found");
const errorHandlerMiddleware = require("./middleware/error-handler");
require("dotenv").config();

// initializing the app
const app = express();

// getting the env variables
const { MONGO_URI, PORT } = process.env;

// middleware to set json as base data transfer type
app.use(express.json());
app.use(express.static("./public"));

// setting the tasks routes
app.use("/api/v1/tasks", tasks);

// middleware for not existing routes
app.use(notFound);

// generic error handler middleware
app.use(errorHandlerMiddleware);

// first connects to DB if no error occurs starts listening
(async () => {
  try {
    await connectDb(MONGO_URI);
    console.log("Connected to MongoDB");
    app.listen(PORT, console.log(`Server is listening at port ${PORT}`));
  } catch (err) {
    console.log(err);
  }
})();
