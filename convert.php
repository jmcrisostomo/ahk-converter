<?php
/**
* String Manipulation for AHK Strings
* Created by JM Crisostomo
*/
date_default_timezone_set("Asia/Manila");


// might refractor this
function generateAHK ($variable = NULL) {
    $variable_name = $variable;

    $ahk_build = "Noli:=[]



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
    
        Send, % Noli[ Counter ]
        SetKeyDelay, 5000
        ; SetKeyDelay, 600
        Send, {Enter}
    
        Counter += 1
    
        ; DeleteCout += 1
    
        If ( Counter = Noli.MaxIndex() ){
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
    Return";
}

$arr_candide = [];
$arr_ahk_format = [];

foreach(file("pg20228.txt", FILE_IGNORE_NEW_LINES) as $line) {
    $arr_candide[] = $line;
}

$arr_cout = 1;

$date = date('Y_m_d_His');

$ahk_txt_file = fopen("outputs/$date.txt", "w") or die("Unable to open file!");
foreach ($arr_candide as $index => $line) {
    if (!empty($line) == TRUE)
    {
        // double quote fix
        $line = str_replace('"', '""', $line);

        $build = 'Noli['.$arr_cout.'] := "'.$line.'"'.PHP_EOL;
        $build = str_replace("“",'""',$build);
        $build = str_replace("”", '""',$build);
        $build = str_replace("’", "'",$build);
        $build = str_replace("–", '-',$build);
        $build = str_replace("!", '{!}',$build);

        echo $arr_ahk_format[] = $build;
        fwrite($ahk_txt_file, $build);

        $arr_cout += 1;
    }
}
fclose($ahk_txt_file);


