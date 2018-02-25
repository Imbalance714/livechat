<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 19.02.2018
 * Time: 22:23
 */

namespace App\Classes\Socket;

use ZMQContext;

class Pusher extends BasePusher
{

    static  function sendDataToServer(array $data){

        $context = new ZMQContext();
        $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');

        $socket->connect("tcp://localhost:5555");

        $socket->send(json_encode($data));
    }

    public  function broadcast($jsonToSend){
        $entryData = json_decode($jsonToSend, true);

        $subscribedTopic = $this->getSubscribeTopic();

        // If the lookup topic object isn't set there is no one to publish to
        if (!array_key_exists($entryData['topic_id'], $this->subscribedTopics)) {
            return;
        }

        if ( isset($subscribedTopic[$entryData['topic_id']]) ) {
            $topic = $subscribedTopic[$entryData['topic_id']];
            // re-send the data to all the clients subscribed to that category
            $topic->broadcast($entryData);
        }


    }

}