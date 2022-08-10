<?php
    /**
    * String Manipulation and Builder for AHK
    * Created by JM Crisostomo
    */
    date_default_timezone_set("Asia/Manila");

    define('TXT_FILE', 'pg20228.txt');

    class Convert {
        // properties
        public $ahk_string_name;
        public $array_test;
        
        function __construct () {
            $this->ahk_string_name = "HelloWorld";
            $this->array_test = [];
        }

        function init () {
            $this->convert();
            echo $this->build($this->ahk_string_name, $this->array_test);
        }

        function convert () {
            $this->array_test = ['Foo', 'Bar', 'Bazz'];
        }
     
        function build ($string_name, $generate_array) {
            $generate = implode(PHP_EOL, $generate_array);

            echo TXT_FILE;
            die();

            $ahk_build = "
{$string_name}:=[]

;Generates loop here
{$generate}

Counter := 1
DeleteCout := 1

Escape::
ExitApp
Return

F4::
    If (toggle := !toggle) {
        Send, y
        SetTimer, spamBot, 50
    }
    Else {
        SetTimer, spamBot, off
        Send, y
    }
Return

spamBot:

    Send, % {$string_name}[ Counter ]
    SetKeyDelay, 5000
    ; SetKeyDelay, 600
    Send, {Enter}

    Counter += 1

    ; DeleteCout += 1

    If ( Counter = $string_name.MaxIndex() ){
    Counter := 1
    }
    
    If ( DeleteCout = 5 ){
        Loop, 10
        {
            send, {Up}
            send, ^a
            send, {BS}
            send, {Enter}
            send, {Enter}
            sleep, 500
            send, {WheelUp}
        }
        DeleteCout := 1
    }
Return

deleteChat:
    Loop, 10
    {
        send, {Up}
        send, ^a
        send, {BS}
        send, {Enter}
        send, {Enter}
        sleep, 500
        send, {WheelUp}
    }
Return
            ";
            return $ahk_build;
        } 
        
    }
        

    $convert = new Convert();
    $convert->init();
?>