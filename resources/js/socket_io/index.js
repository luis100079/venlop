var server = require('http').Server();

var io = require('socket.io')(server);

var Redis = require('ioredis');

var redis = new Redis();

redis.subscribe('test-channel');

redis.on('message' , function(){

//  message = JSON.parse(message);
  console.log("Hola");

})


server.listen(3001);
