/*var Docker = require('dockerode');
var docker1 = new Docker({host: 'http://127.0.0.1', port: 3001});
docker1.createContainer({Image: 'ubuntu', Cmd: ['/bin/bash'], name: 'ubuntu-test'}, function (err, container) {
  container.start(function (err, data) {
    console.log("Started the container");
  });
});*/

//This Program works fine and show the list of docker container created 
var Docker = require('dockerode');
 
//var docker = new Docker({socketPath: '/var/run/docker.sock'});
var docker = new Docker({host: 'http://127.0.0.1', port: 2375});
 

docker.listContainers({ all: true }, function (err, containers) {
    console.log('Total number of containers: ' + containers.length);
    containers.forEach(function (container) {
        console.log(`Container ${container.Names} - current status ${container.Status} - based on image ${container.Image}`)
    })
});
