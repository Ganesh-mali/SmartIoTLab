/*var Docker = require('dockerode');
var docker1 = new Docker({host: 'http://127.0.0.1', port: 3001});
docker1.createContainer({Image: 'ubuntu', Cmd: ['/bin/bash'], name: 'ubuntu-test'}, function (err, container) {
  container.start(function (err, data) {
    console.log("Started the container");
  });
});*/

//This Program works fine and show the list of docker container created 
var Docker = require('dockerode');
var dockerHostIP = "172.17.0.1"
var dockerHostPort = 4243
 
//var docker = new Docker({socketPath: '/var/run/docker.sock'});
var docker = new Docker({host: 'http://127.0.0.1', port: 2375});
 

docker.createContainer({ Image: 'nodered/node-red-docker', Tty: false, name: 'nodered2', PortBindings: { "1880/tcp": [{ "HostPort": "1234" }] } }, function (err,container){
  container.start();
})
