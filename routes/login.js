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
          console.log(req.body.email, req.body.password);
        conn.release();
        if (error) {
          return res.status(500).send({ error: error });
        }
        if (results.length < 1) {
          return res.status(401).send({ msg: "Falha na autenticação" });
        }
        bcrypt.compare(
          req.body.password,
          results[0].password,
          (err, result) => {
            if (err) {
              return res.status(401).send({ msg: "Falha na autenticação" });
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
                .send({ msg: "Login efetuado", token: token });
            }
            return res.status(401).send({ msg: "Falha na autenticação" });
          }
        );
      }
    );
  });
});

module.exports = router;
