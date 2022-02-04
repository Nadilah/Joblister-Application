<?php
//start session
session_start();


//config file - autoload our classes
require_once 'config.php';


//include the helpers file
require_once 'helpers/system_helper.php';

//autoloader - it will include the file whenever we
// -- instantiate the template class or the template object
function __autoload($class_name){
    require_once 'lib/'.$class_name. '.php';

}

