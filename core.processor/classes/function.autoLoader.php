<?php
// This function will auto load your classes so you don't have to always
// include files. You could make a similar function to autoload functions
function autoLoader($class)
    {
        if(class_exists($class))
            return true;

        if(is_file($include = CLASS_DIR.'/class.'.$class.'.php'))
            include_once($include);
    }
?>
