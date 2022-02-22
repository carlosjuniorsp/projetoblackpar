const express = require("express");
const router = express.Router();

const { google } = require('googleapis');
const youtube = new google.youtube({
    version: 'v3',
    auth: 'AIzaSyAZNQEd9UnGbOWyb4vR0PZyJwZums2zr_4'
});

router.get("/:title", (req, res, next) => {
    youtube.search.list({
        q: req.params.title,
        part: 'snippet',
    }, function (err, result) {
        if (err) {
            console.log(err);
        }
        res.status(200).send({
            data: result.data.items
        })
    });
});

module.exports = router;