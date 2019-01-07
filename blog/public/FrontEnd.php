<?php
spl_autoload_register(function ($class) {
    include_once('../../admin/classes/class.'.$class.'.php');
});

class  FrontEnd extends Article
{
    public function name()
    {
        echo "ABC";
    }

}
