const express = require("express");
const router = express.Router();

router.get("/list/:id", (req, res, next) => {
  const id = req.params.id;
  res.status(200).send({
    msg: "Deu certo o list",
    id: id,
  });
});

router.post("/", (req, res, next) => {
  res.status(200).send({
    msg: "deu certo post",
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
