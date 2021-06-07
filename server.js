var app = require('express')();
var http = require('http').Server(app);
/*var io = require ('socket.io').(server,{origins:'*:*'});*/
/*var socket = io('http://');*/
const io = require('socket.io')(http, {

    cors: {
  
        origin: "*",
  
        methods: ["GET", "POST"]
  
    }

  });
var Redis = require('ioredis');
var redis = new Redis();
var users = [];

var cors = require('cors');
app.use(cors());

http.listen(8005, function () {
  console.log('CORS-enabled web server listening on port 8005')
});
/*http.listen(8005, function () {
    console.log('Listening to port 8005');
});*/

redis.subscribe('private-channel', function() {
    console.log('subscribed to private channel');
});

redis.on('message', function(channel, message) {
    message = JSON.parse(message);
    console.log(message);
    if (channel == 'private-channel') {
        let data = message.data.data;
        let receiver_id = data.receiver_id;
        let event = message.event;

        /*io.socket.to(`${users[receiver_id]}`).emit(channel + ':' + message.event, data);*/
        io.on('connection', function(socket){
            socket.to(users[receiver_id]).emit(channel + ':' + message.event, data);
          });
       /* io.on('connection', function(socket){
            // to one room
            socket.to('others').emit('an event', { some: 'data' });
            // to multiple rooms
            socket.to('room1').to('room2').emit('hello');
          });*/
    }
});

io.on('connection', function (socket) {
    socket.on("user_connected", function (user_id) {
        users[user_id] = socket.id;
        io.emit('updateUserStatus', users);
        console.log("user connected "+ user_id);
    });

    socket.on('disconnect', function() {
        var i = users.indexOf(socket.id);
        users.splice(i, 1, 0);
        io.emit('updateUserStatus', users);
        console.log(users);
    });
});
