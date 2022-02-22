const express = require("express");
const api = express();

const users = require('./routes/user');

api.use('/user', users);

module.exports = api;