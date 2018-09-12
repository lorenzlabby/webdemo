var conn = new ab.Session('ws://localhost:8080',
    function(){
        conn.subscribe('arg0', function(topic, data){
            console.log('New article published to category' + topic + ' : ' + data);
        });
    },

    function() {
        console.warn('WebSocket connection close');
    },

    {'skipSubprotocolCheck': true}
)