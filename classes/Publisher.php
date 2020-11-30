<?php
namespace App;
use App\Broker;

    class Publisher {

        private \App\Broker $broker;

        public function __construct(Broker $broker){
        $this->broker = $broker;
        }

        public function publish($topic,$data){
            $this->broker->invoke($topic,$data);
        }
}