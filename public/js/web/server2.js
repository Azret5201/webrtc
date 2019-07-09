//require our websocket library
var WebSocketServer = require('ws').Server;

//creating a websocket server at port 8000
var wss = new WebSocketServer({port: 8000});

//all connected to the server users
var users = {};

//when a user connects to our server
wss.on('connection', function (connection) {
    console.log("User connected");

    //when server gets a message from a connected user
    connection.on('message', function (message) {
        var data;
        
        //accepting only JSON messages
        try {
            data = JSON.parse(message);
        }catch (e) {
            console.log("Invalid JSON");
            data = {};
        }

        //switch type of the user message
        switch (data.type)
        {
            //when a user tries to login
            case "login":
                console.log("User logged: ", data.name);
                //if anyone is logged in with this username then refuse
                if(users[data.name]){
                    sendTo(connection, {
                        type: "login",
                        success: false
                    });
                }else {
                    //save user connection in the server
                    users[data.name] = connection;
                    connection.name = data.name;

                    sendTo(connection, {
                        type: "login",
                        success: true
                    });
                }
                break;

                //create offer
            case "offer":
                //for ex. UserA wants to call UserB
                console.log("Sending offer to: ", data.name);

                //if userb exists the nsend him offer details
                var conn = users[data.name];

                if (conn != null) {
                    //setting that UserA connected with UserB
                    connection.otherName = data.name;

                    sendTo(conn, {
                        type: "offer",
                        offer: data.offer,
                        name: connection.name
                    });
                }
                break;
                //create answer
            case "answer":
                console.log("Sending answer to: ", data.name);

                //for ex. UserB answers UserA
                var conn = users[data.name];

                if (conn != null) {
                    connection.otherName = data.name;

                    sendTo(conn, {
                        type: "answer",
                        answer: data.answer
                    });
                }
                break;

                //create ICE candidate
            case "candidate":
                console.log("Sending candidate to: ", data.name);
                var conn = users[data.name];

                if (conn != null)
                {
                    sendTo(conn, {
                        type: "candidate",
                        candidate: data.candidate
                    });
                }
                break;

            case "leave":
                console.log("Disconnecting from", data.name);
                var conn = users[data.name];
                conn.otherName = null;

                //notify the other user so he can disconnect his peer connection
                if (conn != null) {
                    sendTo(conn, {
                        type: "leave"
                    });
                }


            default:
                sendTo(connection, {
                    type: "error",
                    message: "Command no found: " + data.type
                });
                break;
        }
    });

    connection.on("close", function () {
        if(connection.name) {
            delete users[connection.name];

            if (connection.otherName) {
                console.log("Disconnecting from", connection.otherName);
                var conn = users[connection.otherName];
                conn.otherName = null;


                if (conn != null) {
                    sendTo(conn, {
                        type: "leave"
                    });
                }
            }
        }
    });
    connection.send("Hello from server");
});

function sendTo(connection, message) {
    connection.send(JSON.stringify(message));
}
