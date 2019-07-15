
console.log("Result Found");
    var portNum;
    //res.send("Username exists in database");
    docker.listContainers({ all: true }, function (err, containers) {
    console.log('Total number of containers: ' + containers.length);
    containers.forEach(function (container) {
        console.log(`Container ${container.Names} - current status ${container.Status} - based on image ${container.Image}`)
        //console.log(typeof(container.Names));
        var name = JSON.stringify(container.Names);
        if(name.includes(user_name)){
                console.log(container.Names);
                console.log(container.Ports);
                ports = container.Ports[0];
                portNum = ports['PublicPort'];
                console.log(ports['PublicPort']);
        }
        })
    });
