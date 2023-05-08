const express = require('express');
const app = express();
const server = require('http').Server(app);
const io = require('socket.io')(server);
const { v4: uuidV4} = require('uuid');


app.set('view engine', 'ejs');
app.use(express.static('public'));

app.get('/', (req, res) => {
    res.redirect(`/${uuidV4()}`);
})

app.get('/:room', (req,res) => {
    res.render('room', {roomID: req.params.room});
})

//Whenever we have a connection, we are looking for different events in there
io.on('connection', socket => {
    socket.on('join-room', (roomID, userID) => {
        console.log(userID, roomID)
    })
})

const PORT = 3000;
app.listen(PORT, () => {
    console.log('Server running on port ' + PORT);
});