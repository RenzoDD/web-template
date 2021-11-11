const Util = require('../utilities/util');

/**** Router ****/
const express = require('express');
const router = express.Router();

/**** Middleware ****/
router.use((req, res, next) => {
    res.setHeader('Access-Control-Allow-Origin', '*');
    res.setHeader('Content-Type', 'application/json');

    next();
});

/**** Routes ****/
router.get('/', (req, res) => {
    res.send({
        msj: "Hello world",
        emoji: ":)"
    });
});
router.post('/', (req, res) => {
    res.send({
        msj: req.body.msj,
        emoji: ":)"
    });
});
router.get('/:var', (req, res) => {
    res.send({
        msj: req.params.var,
        emoji: ":)"
    });
});

module.exports = router;