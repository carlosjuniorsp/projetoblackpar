const express = require("express");
const router = express.Router();

router.get("/list/:id", (req, res, next) => {
  const id = req.params.id;
  res.status(200).send({
    msg: "Deu certo o list",
    id: id,
  });
});

router.post("/register", (req, res, next) => {
  const user = {
    name: req.body.name,
    telefone: req.body.phone,
  };
  res.status(201).send({
    msg: "usuário cadastrado",
    user: user,
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
