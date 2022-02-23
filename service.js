const http = require('http');
const api = require('./app');
const port = process.env.PORT || 7000;
const server = http.createServer(api);
server.listen(port);