<?php
require "vendor/autoload.php";
use App\Broker;
use App\Subscriber;
use App\Publisher;

$page1 = new Broker();
$publisher = new Publisher($page1);
$subscriber1 = new Subscriber();

$page1->subscribe($subscriber1,'maker');
$publisher->publish('maker','Salami Kolawole');
