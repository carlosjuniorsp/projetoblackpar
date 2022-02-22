const express = require("express");
const router = express.Router();
const connection = require("../connection").pool;

router.get("/list/:id", (req, res, next) => {
  const id = req.params.id;
  res.status(200).send({
    msg: "Deu certo o list",
    id: id,
  });
});

router.post("/register", (req, res, next) => {
  connection.getConnection((error, conn) => {
    conn.query(
      'INSERT INTO users (name, last_name, type, phone, email, password) VALUES (?,?,?,?,?,?)',
      [
        req.body.name,
        req.body.last_name,
        req.body.type,
        req.body.phone,
        req.body.email,
        req.body.password,
      ],
      (error, result, field) => {
        conn.release();
        if (error) {
          return res.status(500).send({
            error: error,
            response: null,
          });
        }

        res.status(201).send({
          msg: "Usuário cadastrado",
          userId: result.insertId,
        });
      }
    );
  });
});

router.delete("/delete/:id", (req, res, next) => {
  const id = req.params.id;
  res.status(200).send({
    msg: "deu certo delete",
    id: id,
  });
});

router.put("/update/:id", (req, res, next) => {
  res.status(200).send({
    msg: "deu certo put",
  });
});

module.exports = router;
