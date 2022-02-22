const express = require("express");
const api = express();
const morgan = require('morgan');

//Routes
const users = require('./routes/user');

api.use(morgan('dev'));
api.use('/user', users);

module.exports = api;