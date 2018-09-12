var conn = new ab.Session('ws://149.28.138.51/ws2/:5555',
    function(){
        conn.subscribe('dbuuid', function(topic, data){
            console.log('New article published to category' + topic + ' : ' + data);
        });
    },

    function() {
        console.warn('WebSocket connection close');
    },

    {'skipSubprotocolCheck': true}
);