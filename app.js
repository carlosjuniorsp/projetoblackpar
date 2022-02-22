const express = require("express");
const api = express();
const morgan = require("morgan");

api.use(morgan("dev"));
const users = require("./routes/user");

api.use((newError, req, res, next) => {
    res.status(newError.status || 500);
    return res.send({
        error: {
            message: newError.message,
        },
    });
});

api.use((error, req, next) => {
  const reqError = new Error("Dados não encontrados!");
  reqError.status = 404;
  next(reqError);
});

//Routes 
api.use("/user", users);

module.exports = api;
