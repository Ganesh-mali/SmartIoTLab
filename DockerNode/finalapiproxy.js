var express = require("express");
var app = express();
var mysql = require('mysql');
//This file will contain the final working code for accessing/creating
//NodeRED nodes from remote location
//@vikas1369
var con = mysql.createConnection({
  host: "127.0.0.1",
  user: "vernemq",
  password: "vernemq",
  database: "vernemq_db"
});
var Docker = require('dockerode');
var docker = new Docker({host: 'http://127.0.0.1', port: 2375});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connected");
});

app.get('/',function(req,res) {
var user_name = req.query.user

  //Select all customers and return the result object:
  con.query("SELECT * FROM users where username='"+user_name+"'", function (err, result, fields) {
    if (err) throw err;
   //JSONOb = JSON.parse(result);
    var resultsetlen = Object.keys(result).length
    if(resultsetlen == 0){
    res.send("Username doesnt exist in database");
    }
    else if(resultsetlen == 1){
    console.log("Result Found");
    var portNum;
    //res.send("Username exists in database");
    docker.listContainers({ all: true }, function (err, containers) {
    console.log('Total number of containers: ' + containers.length);
    containers.forEach(function (container) {
        //console.log(`Container ${container.Names} - current status ${container.Status} - based on image ${container.Image}`)
        //console.log(typeof(container.Names));
        var name = JSON.stringify(container.Names);
        if(name.includes(user_name)){
                console.log(container.Names);
                console.log(container.Ports);
                ports = container.Ports[0];
                portNum = ports['PublicPort'];
                console.log(ports['PublicPort']);
                var finalURL = "http://172.18.22.9:"+portNum;
                console.log(finalURL); 
                res.redirect(finalURL);
        }
        })
    });
  }
  });
});

app.listen(3002);



