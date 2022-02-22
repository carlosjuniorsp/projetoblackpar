const express = require("express");
const api = express();
const morgan = require("morgan");
const body = require("body-parser");

//Routes
const users = require("./routes/user");
const search = require("./routes/search");
const login = require("./routes/login");

api.use(morgan("dev"));
api.use(body.urlencoded({ extended: false }));
api.use(body.json());

api.use("/user", users);
api.use("/search", search);
api.use("/login", login);

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
