<?php

class Params
{
    private $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getName()
    {
        return isset($this->data['name']) ? $this->data['name'] : null;
    }

    public function getScore()
    {
        return isset($this->data['score']) ? $this->data['score'] : null;
    }
}
