<?php

const FLASH = 'FLASH_MESSAGES';

Session::init();
class FlashMessage{

        // Create a flash message which accepts parameters name,message,type
        public static function create_flash($name, $message, $type){
            // remove existing message with the name
            if (isset($_SESSION[FLASH][$name])) {
                unset($_SESSION[FLASH][$name]);
            }
            // add the message to the session
            $_SESSION[FLASH][$name] = ['message' => $message, 'type' => $type];
        }


        // Return the flash html object based on the data of array which gets passed in
        public static function format_flash($flash_message){   
            switch ($flash_message['type']) {
                case "error":
                    $messageIcon = '<i class="fa-sharp fa-solid fa-circle-exclamation"></i>';
                    break;
                case "warning":
                    $messageIcon = '<i class="fa-sharp fa-solid fa-circle-exclamation"></i>';
                    break;
                case "info":
                    $messageIcon = '<i class="fa-solid fa-circle-info"></i>';
                    break;
                case "success":
                    $messageIcon = '<i class="fa-solid fa-circle-check"></i>';
                    break;
                default:
                    //Defautlt will be a warning
                    $messageIcon = '<i class="fa-sharp fa-solid fa-circle-exclamation"></i>';
                    break;
              }
            return sprintf('
                <div class="alert show %s">
                    <span class="message-icon">%s</span>
                    <p class="message">%s</p>
                    <span class="close-btn">
                        <span><i class="fa-solid fa-xmark"></i></span>
                    </span>
                </div>
            ',
                $flash_message['type'],
                $messageIcon,
                $flash_message['message']
            );
        }

        // Get and display flash message by the name
        public static function display_flash($name){
            if (!isset($_SESSION[FLASH][$name])) {
                return;
            }

            // get message from the session
            $flash_message = $_SESSION[FLASH][$name];

            // delete the flash message
            unset($_SESSION[FLASH][$name]);

            // display the flash message
            echo FlashMessage::format_flash($flash_message);
        }

        // Displaying all the flash messages that has created so far
        public static function display_all_flash(){
            if (!isset($_SESSION[FLASH])) {
                return;
            }

            // get flash messages
            $flash_messages = $_SESSION[FLASH];

            // remove all the flash messages
            unset($_SESSION[FLASH]);

            // show all flash messages
            foreach ($flash_messages as $flash_message) {
                echo FlashMessage::format_flash($flash_message);
            }
        }


        // $type (error, warning, info, success)
        // Helper function to pick the relenvant flash message optionusing different params
        public static function flash($name = '', $message = '', $type = ''){
            if ($name !== '' && $message !== '' && $type !== '') {
                // create a flash message
                FlashMessage::create_flash($name, $message, $type);
            } elseif ($name !== '' && $message === '' && $type === '') {
                // display a flash message
                FlashMessage::display_flash($name);
            } elseif ($name === '' && $message === '' && $type === '') {
                // display all flash message
                FlashMessage::display_all_flash();
            }
        }
}


