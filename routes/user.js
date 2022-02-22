const express = require("express");
const router = express.Router();
const connection = require("../connection").pool;

const bcrypt = require('bcrypt');
const saltRounds = 10;
const myPlaintextPassword = 's0/\/\P4$$w0rD';

router.get("/list/:id", (req, res, next) => {
  connection.getConnection((error, conn) => {
    if (error) {
      return res.status(500).send({ error: error });
    }
    conn.query(
      "SELECT * FROM users WHERE id=?",
      [req.params.id],
      (error, result, field) => {
        if (error) {
          return res.status(500).send({ error: error });
        }
        return res.status(200).send({ response: result });
      }
    );
  });
});

router.post("/register", (req, res, next) => {
  connection.getConnection((error, conn) => {
    if (error) {
      return res.status(500).send({ error: error });
    }

  bcrypt.genSalt(saltRounds, function(err, salt) {
    bcrypt.hash(myPlaintextPassword, salt, function(err, hash) {
      conn.query(
        "INSERT INTO users (name, last_name, type, phone, email, password) VALUES (?,?,?,?,?,?)",
        [
          req.body.name,
          req.body.last_name,
          req.body.type,
          req.body.phone,
          req.body.email,
          hash,
        ],
        (error, result, field) => {
          conn.release();
          if (error) {
            return res.status(500).send({ error: error, response: null });
          }
  
          res.status(201).send({
            msg: "Usuário cadastrado",
            userId: result.insertId,
          });
        }
      );
    });
  });
    
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
