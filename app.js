const express = require("express");
const api = express();

api.use((req, res, next) => {
    res.status(200).send({
        msg: "deu certo",
    })
});

module.exports = api;