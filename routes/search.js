const express = require("express");
const config = require("../config");
const router = express.Router();
const { google } = require('googleapis');
const connection = require("../connection").pool;
const youtube = new google.youtube({
    version: 'v3',
    auth: config.YOUTUBE_KEY
});

router.get("/userId/:id/:title/:maxResults", (req, res, next) => {
    let userId = req.params.id;
    let title = req.params.title;
    youtube.search.list({
        q: title,
        part: 'snippet',
        fields: 'items(id(videoId), snippet(title))',
        maxResults: req.params.maxResults ? req.params.maxResults : 10,
        type: 'video'
    }, function (err, result) {
        if (err) {
            res.status(500).send({
                error: err
            });
        }
        res.status(200).send({
            data: result.data.items
        })
        history(userId, title);
    });
});

async function history(id, title) {
    connection.getConnection((error, conn) => {
        if (error) {
            return { error: error };
        }
        conn.query(
            "SELECT id FROM users WHERE id=?",
            [id],
            (error, result, field) => {
                if (result.length < 0) {
                    console.log("Usuário não encontrado");
                    return;
                } else {
                    let date = new Date();
                    conn.query(
                        "INSERT INTO history (user_id, title, date) VALUES (?,?, ?)",
                        [
                            id,
                            title,
                            date
                        ],
                        (error, result, field) => {
                            conn.release();
                            if (error) {
                                console.log({ error: error, response: null });
                                return;
                            }
                            console.log("Histórico salvo");
                        }
                    );
                }
            }
        );
    });
}

module.exports = router;