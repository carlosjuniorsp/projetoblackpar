const express = require("express");
const config = require("../config");
const router = express.Router();

const { google } = require('googleapis');
const youtube = new google.youtube({
    version: 'v3',
    auth: config.YOUTUBE_KEY
});

router.get("/:title/:maxResults", (req, res, next) => {
    youtube.search.list({
        q: req.params.title,
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
    });
});

module.exports = router;