const express = require("express");
const router = express.Router();
const connection = require("../connection").pool;

const bcrypt = require("bcrypt");

router.post("/", (req, res, next) => {
  connection.getConnection((error, conn) => {
    if (error) {
      return res.status(500).send({ error: error });
    }
    conn.query(
      "SELECT email, password FROM users WHERE email = ?",
      [req.body.email],
      (error, results, field) => {
        conn.release();
        if (error) {
          return res.status(500).send({ error: error });
        }
        if (results.length < 1) {
          return res.status(401).send({ msg: "Falha na autenticação" });
        }
        bcrypt.compare(req.body.password, results[0].password, (err, result) => {
          if (err) {
            return res.status(401).send({ msg: "Falha na autenticação" });
          }
          if (result) {
            return res.status(200).send({ msg: "Autenticado" });
          }
          return res.status(401).send({ msg: "Falha na autenticação" });
        });
      }
    );
  });
});

module.exports = router;
