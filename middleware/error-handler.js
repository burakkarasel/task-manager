const GenericResponse = require("../models/genericResponse");
const { CustomAPIError } = require("../errors/custom-error");

const errorHandlerMiddleware = (err, req, res, next) => {
  if (err instanceof CustomAPIError) {
    return res
      .status(err.statusCode)
      .json(new GenericResponse(false, err.statusCode, err.message, null));
  }
  return res
    .status(500)
    .json(new GenericResponse(false, 500, err.message, null));
};

module.exports = errorHandlerMiddleware;
