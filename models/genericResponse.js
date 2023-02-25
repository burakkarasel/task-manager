class GenericResponse {
  success;
  httpStatusCode;
  message;
  data;
  constructor(_success, _httpStatusCode, _message, _data) {
    this.success = _success;
    this.httpStatusCode = _httpStatusCode;
    this.message = _message;
    this.data = _data;
  }
}

module.exports = GenericResponse;
