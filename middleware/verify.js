const jwt = require('jsonwebtoken');
const config = require('../config');

module.exports = (req, res, next) => {
    try {
        const token = req.headers.authorization.split(' ')[1];
        const decodeToken = jwt.verify(token, config.JWT_USER_TOKEN);
        req.user = decodeToken;
        next()
    } catch (error) {
        return res.status(401).send({ message: 'Não autenticado' });
    }
}