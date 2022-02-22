const express = require("express");
const router = express.Router();
const connection = require("../connection").pool;

const bcrypt = require('bcrypt');
const saltRounds = 10;
const myPlaintextPassword = 's0/\/\P4$$w0rD';

router.post("/", (req, res, next) => {
    connection.getConnection((error, conn) => {
        if (error) {
            return res.status(500).send({ error: error });
        }
        conn.query(
            "SELECT * FROM users WHERE email=?",
            [req.body.email],
            (error, result, field) => {
                conn.release();
                if (error) {
                    return res.status(500).send({ error: error });
                }

                if (result.length < 1) {
                    return res.status(401).send({ msg: "Falha na autenticação" });
                }

                bcrypt.compare(req.body.password, result[0].password, (err, results) => {
                    if (err) {
                        return res.status(401).send({ msg: "Falha na autenticação"});
                    }

                    console.log( result[0].password);
                    if (results) {
                        return res.status(200).send({
                            msg: 'Autenticado com sucesso!'
                        })
                    }

                    return res.status(401).send({ msg: "Falha na autenticaçãos" });
                });
            }
        );
    });
});

module.exports = router;
