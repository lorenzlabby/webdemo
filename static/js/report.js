var conn = new ab.Session('ws://149.28.138.51:80',
    function(){
        conn.subscribe('arg0', function(topic, data){
            console.log('New article published to category' + topic + ' : ' + data);
        });
    },

    function() {
        console.warn('WebSocket connection close');
    },

    {'skipSubprotocolCheck': true}
);