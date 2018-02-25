<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 18.02.2018
 * Time: 14:40
 */

namespace App\Classes\Socket;

use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

class BasePusher implements  WampServerInterface
{
    protected $subscribedTopics = array();

    public function getSubscribeTopic(){
        return $this->subscribedTopics;
    }
    public function addSubscribeTopic(){

    }
    public function onSubscribe(ConnectionInterface $conn, $topic) {
    }
    public function onUnSubscribe(ConnectionInterface $conn, $topic) {
    }
    public function onOpen(ConnectionInterface $conn) {
    }
    public function onClose(ConnectionInterface $conn) {
    }
    public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {
        // In this application if clients send data it's because the user hacked around in console
        $conn->callError($id, $topic, 'You are not allowed to make calls')->close();
    }
    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
        // In this application if clients send data it's because the user hacked around in console
        $conn->close();
    }
    public function onError(ConnectionInterface $conn, \Exception $e) {
    }
}