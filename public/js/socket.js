/**
 * Created by User on 20.02.2018.
 */
var conn = null
$( document ).ready(function() {
    $( "#connect_to_room" ).click(function() {
        conn = new WebSocket('ws://localhost:8080');

        conn.onopen = function(e) {
            console.log("Connection established!");
        };

        conn.onmessage = function(e) {
            console.log(e.data);
        };
    });
    $( "#send_message" ).click(function() {
        conn.send('Hello World!');
    });
    console.log( "ready!" );
});