var app = require('express')()

var server = require('http').Server(app);

var io = require('socket.io')(server);

var Redis = require('ioredis');

var redis = new Redis();


app.get('/', function(request, response){
    response.sendFile(__dirname + '/index.html')
})


redis.subscribe('venlop_database_test-channel');

redis.on('message', function(channel, message){
    console.log(message);

    io.emit('chat.message', message)

});


/*

redis.psubscribe('*');

redis.on('pmessage', function(subscribed, channel, message){
    console.log(message);
})


redis.psubscribe('*', function(err, count) {
    console.log("Listening to " + count + " channels.");
    if(err){
      console.log(err);
    }
  });

redis.on('pmessage', function(subscribed, channel, message) {
    console.log("message: " + message);
  });


*/



server.listen(3000);
