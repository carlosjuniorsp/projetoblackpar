const express = require("express");
const router = express.Router();
const connection = require("../connection").pool;
const config = require("../config");

const bcrypt = require("bcrypt");
const jwt = require("jsonwebtoken");

router.post("/", (req, res, next) => {
  connection.getConnection((error, conn) => {
    if (error) {
      return res.status(500).send({ error: error });
    }
    conn.query(
      "SELECT email, password,id, name, type FROM users WHERE email = ?",
      [req.body.email],
      (error, results, field) => {
        conn.release();
        if (error) {
          return res.status(500).send({ error: error });
        }
        if (results.length < 1) {
          return res.status(401).send({ msg: "Falha na autenticação", token: null });
        }
        bcrypt.compare(
          req.body.password,
          results[0].password,
          (err, result) => {
            if (err) {
              return res.status(401).send({ msg: "Falha na autenticação", token: null });
            }
            if (result) {
              const token = jwt.sign(
                {
                  id: results[0].id,
                  name: results[0].name,
                  email: results[0].email,
                },
                config.JWT_USER_TOKEN,
                {
                  expiresIn: "5h",
                }
              );
              return res
                .status(200)
                .send({ user: results[0].name, token: token, type: results[0].type });
            }
            return res.status(401).send({ msg: "Falha na autenticação", token: null });
          }
        );
      }
    );
  });
});

module.exports = router;
