var conn = new ab.Session('ws://149.28.138.51/ws2/:5555',
    function(){
        conn.subscribe('report', function(topic, data){
            var dataLoop = data.data;
            console.log(dataLoop);
            for( dataLoop in d){
                console.log(d);
            };

        });
    },

    function() {
        console.warn('WebSocket connection close');
    },

    {'skipSubprotocolCheck': true}
);