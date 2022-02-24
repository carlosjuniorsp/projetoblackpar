const express = require("express");
const router = express.Router();
const connection = require("../connection").pool;

router.get("/:id", (req, res, next) => {
    console.log(req.params.id)
    connection.getConnection((error, conn) => {
        if (error) {
            return res.status(500).send({ error: error });
        }
        conn.query(
            "SELECT * FROM history WHERE user_id=?",
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

module.exports = router;