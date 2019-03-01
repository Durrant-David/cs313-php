var http = require('http');
var fs = require('fs');

var student = {
    name: "David Durrant",
    class: "cs313"
};
http.createServer(function (req, res) {
    if (req.url == "/home") {
        res.writeHead(200, {
            "Content-Type": "text/html"
        });
        res.write("<h1>Welcome to the Home Page</h1>");
        res.write("<a href='getData'>Student info</a><br>");
        res.write("<a href='saveData'>Save Student info</a>");
        res.end();
    } else if (req.url == "/saveData") {
        res.writeHead(200, {
            "Content-Type": "text/html"
        });
        createFile(student);
        res.write("<h3>file saved successfully</h3>");
        res.write("<a href='readData'>View File</a>");
        res.end();
    } else if (req.url == "/readData") {
        readFile(res);
    } else if (req.url == "/getData") {
        res.writeHead(200, {
            "Content-Type": "application/json"
        });
        var json = JSON.stringify({
            student
        });
        res.end(json);
    } else {
        res.writeHead(404, {
            "Content-Type": "text/html"
        });
        res.write("Page Not Found");
        res.end();
    }
}).listen(8080);

function createFile(obj) {
    var json = JSON.stringify(obj);
    fs.appendFile('data.txt', json, function (err) {
        if (err) throw err;
        console.log('Saved!');
    });
}

function readFile(res) {
    fs.readFile('data.txt', function (err, data) {
        res.writeHead(200, {
            'Content-Type': 'text/html'
        });
        res.write(data);
        res.end();
    });
}
