<?php
class Module{
    function __get($key)
    {
        $CDT =& get_instance();
        return $CDT->$key;
    }
}

?>