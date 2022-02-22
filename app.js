const express = require("express");
const api = express();
const morgan = require("morgan");

//Routes
const users = require("./routes/user");

api.use(morgan("dev"));
api.use("/user", users);

api.use((error, req, next) => {
  const reqError = new Error("Dados não encontrados!");
  reqError.status = 404;
  next(reqError);
});

api.use((newError, req, res, next) => {
  res.status(newError.status || 500);
  return res.send({
    error: {
      message: newError.message,
    },
  });
});
module.exports = api;
