var http = require("http");
var fs = require("fs");
var url = require("url");

function onRequest(request,response){
    var pathname = url.parse(request.url).pathname;
    console.log("Request for " + pathname + "received.");
    fs.readFile("admin.html","binary",function(err,file){
        if(err){
            response.writeHead(500,{
                'Content-Type': 'text/plain'
            });
            response.end();
        }else{
            response.writeHead(200,{
                'Content-Type': 'text/html'
            });
            response.write(file,"binary");
            response.end();
        }
    })
    fs.readFile("user.json","binary",function(err,file){
        response.writeHead(200,{
            'Content-Type': 'text/html'
        });
        response.write(file,"binary");
        response.end();
    })
}

http.createServer(onRequest).listen(3000);
console.log("Server has started");
