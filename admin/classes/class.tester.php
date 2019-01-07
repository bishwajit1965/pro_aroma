<?php

class Tester
{

    public function __construct()
    {
        echo "Hellow I am a tester function constructor";
    }
    public function myAddress()
    {
        echo $a = 6;
        return $this;
    }
    public function yourAddress()
    {
        echo $b = 10;
        return $this;
    }
    public function name()
    {
        return $this->yourAddress();
    }

    public function names()
    {
        return $this->yourAddress();
    }
}
