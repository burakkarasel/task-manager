const GenericResponse = require("../models/genericResponse");

const notFound = (req, res) => {
  return res
    .status(404)
    .json(new GenericResponse(false, 404, "Route doesn't exists", null));
};

module.exports = notFound;
