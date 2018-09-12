<?php
    namespace Config;
    set_include_path(dirname(__DIR__));
    require("vendor/autoload.php");

    use Ratchet\ConnectionInterface;
    use Ratchet\Wamp\WampServerInterface;


    class Pusher implements WampServerInterface{

        protected $data = array();

        public function onSubscribe(ConnectionInterface $conn, $topic){
            $this->data[$topic->getId()] = $topic;
        }

        public function onReport($entry){
            $entryData = json_decode($entry, true);
            var_dump($this->data);
            

            if(!array_key_exists($entryData['report'], $this->data)){
                return;
            }

            echo "lorenzo montecalbo";

            $topic = $this->data[$entryData['report']];

            $topic->broadcast($entryData);
        }

        public function onUnSubscribe(ConnectionInterface $conn, $topic){

        }

        public function onClose(ConnectionInterface $conn){

        }

        public function onOpen(ConnectionInterface $conn){

        }

        public function onCall(ConnectionInterface $conn, $id, $topic, array $param){

            $conn->callError($id, $topic, 'You are not allowed to make calls')->close();

        }

        public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $elible){
            $conn->close();
        }

        public function onError(ConnectionInterface $conn, \Exception $e){

        }

    }
?>