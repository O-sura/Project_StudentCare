<?php
    require_once 'config/config.php';
    require_once 'helper/send_mail.php';
    require_once 'helper/Report.php';

    // Include all the core files required to run the application
    // require_once 'core/Core.php';
    // require_once 'core/Controller.php';
    // require_once 'core/Database.php';
    // require_once 'helper/.php';

    //Autoload Core classes
    spl_autoload_register(function($classname){
        if(file_exists(APPROOT. '/core/' . $classname . '.php')){
            include_once APPROOT. '/core/' . $classname . '.php';
            // require_once 'core/' . $classname . '.php';
        }
        if(file_exists(APPROOT. '/helper/' . $classname . '.php')){
            include_once APPROOT. '/helper/' . $classname . '.php';
        }
    });