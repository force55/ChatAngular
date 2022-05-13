const express = require('express');
const path = require('path');
const { createServer } = require('http');

const { WebSocketServer } = require('ws');

const app = express();

const server = createServer(app);
const wss = new WebSocketServer({ server });

wss.on('connection', function (ws, request) {
    // const userId = request.session.userId;

    // map.set(userId, ws);

    ws.on('message', function (message) {
        //
        // Here we can now use code
        //
        console.log(`Received message ${message}`);
        console.log(`Received message ${request}`);
    });

    ws.on('close', function () {
        console.log(`Close`);
    });
});


server.listen(8080, function () {
    console.log('Listening on http://localhost:8080');
});
