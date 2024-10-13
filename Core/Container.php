<?php

namespace Core;

class Container
{
    public $binding = [];

    public function bind($key, $resolver)
    {
        $this->binding[$key] = $resolver;
    }

    public function resolve($key)
    {
        if (!array_key_exists($key, $this->binding)) {
            throw new \Exception("No matching binding found for {$key}");
        }
        $resolver = $this->binding[$key];

        return call_user_func($resolver);
    }

}