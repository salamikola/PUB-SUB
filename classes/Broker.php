<?php
namespace App;

use App\Subscriber;
use Contract\SubscriberContract;


class Broker {
    private array $subscribers = [];

    public function addTopic($topic){
        $this->subscribers[$topic] = [];
    }

    public function subscribe(SubscriberContract $subscriberContract,$eventName){
        if(!array_key_exists($eventName,$this->subscribers)){
            //add the topic it has not been added
            $this->addTopic($eventName);
            //add the subscriber
            array_push($this->subscribers[$eventName],$subscriberContract);
            return $this->subscribers;
        }
        //check if object has not already subscribe to the topic
        if(!in_array($subscriberContract,$this->subscribers[$eventName])){
            array_push($this->subscribers[$eventName],$subscriberContract);
            return $this->subscribers;
        }
        return $this->subscribers;
    }


    public function invoke($event,$data){
        //get the topic to fire
        $topicToInvoke = array_key_exists($event,$this->subscribers)?$this->subscribers[$event]:[];
        if (empty($topicToInvoke)){
            return 'Invalid topic';
        }
        foreach ($topicToInvoke as $subscriber){
            $subscriber->listen($data,$event);
        }
    }
}