const express = require("express");
const tasks = require("./routes/tasks");
const connectDb = require("./db/connect");
require("dotenv").config();

// initializing the app
const app = express();

// getting the env variables
const { MONGO_URI, PORT } = process.env;

// middleware to set json as base data transfer type
app.use(express.json());

// setting the routes
app.use("/api/v1/tasks", tasks);

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
