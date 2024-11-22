const express = require('express')
const app = express()
const mysql = require('mysql')
const server = require('http').Server(app)
const io = require('socket.io')(server)
const { v4: uuidV4 } = require('uuid')

//Create connection
const db  = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '',
  database : 'studentcare'
});

//Connect
db.connect((err) => {
  if(err){
    throw err;
  }
  console.log('MySql Connected...');
});




app.set('view engine', 'ejs')
app.use(express.static('public'))

// app.get('/', (req, res) => {
  
//   res.redirect(`/${uuidV4()}`)
// })

/* 
  Changes need to be done:
    1. Create a UI for creating new meetings or to join an existing meeting scheduled
    2. For creating the meetings, generate a random meeting ID and save it on the database
    3. When joining a meeting or starting a meeting, enter the ID and then re direct to that room
*/

app.get('/:room', (req, res) => {
  const roomId = req.params.room;
  let sql = 'SELECT meetingID FROM appointments';
  let query = db.query(sql, (err, result) => {
    if (err) throw err;
    console.log(result); 
    const appointmentIDs = result.map(obj => obj.meetingID);
    if (appointmentIDs.includes(roomId)) {
      let sql2 = `UPDATE appointments SET is_started = 1 WHERE meetingID = ${db.escape(roomId)}`;
      db.query(sql2, (err, result) => {
        if (err) throw err;
        res.render('room', { roomId });
      });
    } else {
      res.render('error');
    }
  });
});



io.on('connection', socket => {
  socket.on('join-room', (roomId, userId) => {
    socket.join(roomId)
    socket.to(roomId).broadcast.emit('user-connected', userId)

    socket.on('disconnect', () => {
      socket.to(roomId).broadcast.emit('user-disconnected', userId)
    })
  })
})

server.listen(3000)