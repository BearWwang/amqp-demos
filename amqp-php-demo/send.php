<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;
include("AliyunCredentialsProvider.php");


/*接入点*/
$host = "***";
/*默认端口*/
$port = 5672;
/*资源隔离*/
$virtualHost = "test";
/*阿里云的accessKey*/
$accessKey = "***";
/*阿里云的accessSecret*/
$accessSecret = "***";
/*主账号id*/
$resourceOwnerId = 0;

$connectionUtil = new ConnectionUtil($host, $port, $virtualHost, $accessKey, $accessSecret, $resourceOwnerId);
$connection = $connectionUtil->getConnection();

$channel = $connection->channel();

$channel->queue_declare('queue', false, false, false, false);


$msg = new AMQPMessage('Hello World!');

$channel->basic_publish($msg, '', 'queue');
echo " [x] Sent 'Hello World!'\n";

$channel->close();
$connection->close();
?>
