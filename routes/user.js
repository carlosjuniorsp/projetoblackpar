const express = require("express");
const router = express.Router();
const connection = require("../connection").pool;
const verifyUser = require('../middleware/verify');

const bcrypt = require("bcrypt");

router.get("/list/:id", (req, res, next) => {
  connection.getConnection((error, conn) => {
    if (error) {
      return res.status(500).send({ error: error });
    }
    conn.query(
      "SELECT * FROM users WHERE id=?",
      [req.params.id],
      (error, result, field) => {
        conn.release();
        if (error) {
          return res.status(500).send({ error: error });
        }
        return res.status(200).send({ result });
      }
    );
  });
});

router.get("/list", (req, res, next) => {
  connection.getConnection((error, conn) => {
    if (error) {
      return res.status(500).send({ error: error });
    }
    conn.query("SELECT * FROM users", (error, result, field) => {
      conn.release();
      if (error) {
        return res.status(500).send({ error: error });
      }
      return res.status(200).send({ result });
    });
  });
});

router.post("/register", verifyUser, (req, res, next) => {
  connection.getConnection((error, conn) => {
    if (error) {
      return res.status(500).send({ error: error });
    }
    conn.query(
      "SELECT email FROM users WHERE email=?",
      [req.body.email],
      (error, result, field) => {
        if (result.length > 0) {
          return res.status(409).send({ error: "E-mail já cadastrado!" });
        } else {
          bcrypt.hash(req.body.password, 10, function (err, hash) {
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

                req.body.id = result.insertId;
                res.status(201).send({
                  msg: "Usuário cadastrado",
                  user: req.body,
                });
              }
            );
          });
        }
      }
    );
  });
});

router.delete("/delete/:id", verifyUser, (req, res, next) => {
  connection.getConnection((error, conn) => {
    if (error) {
      return res.status(500).send({ error: error });
    }
    conn.query(
      "SELECT id FROM users WHERE id=?",
      [req.params.id],
      (error, result, field) => {
        if (result.length < 1) {
          conn.release();
          return res.status(409).send({ msg: "Usuário não encontrado!" });
        } else {
          conn.query(
            "DELETE FROM users WHERE id=?",
            [req.params.id],
            (error, result, field) => {
              if (error) {
                return res.status(500).send({ error: error });
              }
              return res
                .status(200)
                .send({ msg: "Usuário deletado com sucesso!" });
            }
          );
          conn.release();
        }
      }
    );
  });
});

router.put("/update/:id", verifyUser, (req, res, next) => {
  connection.getConnection((error, conn) => {
    if (error) {
      return res.status(500).send({ error: error });
    }
    conn.query(
      "SELECT * FROM users WHERE id=?",
      [req.params.id],
      (error, result, field) => {
        if (result.length < 1) {
          conn.release();
          return res.status(409).send({ error: "Usuário não encontrado!" });
        } else {
          bcrypt.hash(req.body.password, 10, function (err, hash) {
            conn.query(
              "UPDATE users SET name=?, last_name=?, type=?, phone=? WHERE id=?",
              [
                req.body.name,
                req.body.last_name,
                req.body.type,
                req.body.phone,
                req.params.id,
              ],
              (error, results, field) => {
                conn.release();
                if (error) {
                  return res
                    .status(500)
                    .send({ error: error, response: null });
                }

                res.status(201).send({
                  msg: "Usuário atualizado com sucesso!",
                });
              }
            );
            conn.release();
          });
        }
      }
    );
  });
});
module.exports = router;
