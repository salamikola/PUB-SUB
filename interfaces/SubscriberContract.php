<?php

namespace Contract;

interface SubscriberContract
{
    public function listen($data,$topic);
}