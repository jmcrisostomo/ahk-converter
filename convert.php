<?php
    // namespace AhkConverter\Core; 

    // use AhkConverter\Filtering\AccentFilter;

    // $test_namespace = new AccentFilter();
    // echo $test_namespace->hello();
    // die();
    /**
    * String Manipulation and Builder for AHK
    * Created by JM Crisostomo
    */
    date_default_timezone_set("Asia/Manila");

    define('TXT_FILE', 'pg20228.txt');
    define('INPUT_DIR', 'txt');
    define('OUTPUT_DIR', 'outputs');



    class Convert 
    {
        // properties
        public $ahk_string_name;
        public $array_txt;
        public $array_ahk;
        public $date_today;
        
        function __construct () 
        {
            $this->ahk_string_name  = "Noli";
            $this->date_today       = date('Y_m_d_His');
            $this->array_txt        = array();
            $this->array_ahk        = array();
        }

        function init () 
        {
            echo $this->convert();
        }

        function convert () 
        {
            // store stream to array
            $input_file = file( INPUT_DIR."/".TXT_FILE, FILE_IGNORE_NEW_LINES ) or die ("file is missing.");
            foreach($input_file as $line) 
            {
                $this->array_txt[] = $line;
            }

            // generate string
            $counter = 1;
            foreach ($this->array_txt as $index => $line) 
            {
                if (!empty($line) == TRUE)
                {
                    // double quote fix
                    $line = str_replace('"', '""', $line);

                    $build = $this->ahk_string_name.'['.$counter.'] := "'.$line.'"'.PHP_EOL;
                    $build = str_replace("“",'""',$build);
                    $build = str_replace("”", '""',$build);
                    $build = str_replace("’", "'",$build);
                    $build = str_replace("–", '-',$build);
                    $build = str_replace("!", '{!}',$build);
                    $build = $this->accent_filter($build);

                    // print_r($build);

                    $this->array_ahk[] = $build;
                    $counter += 1;
                }
            }
            // die();
            return $this->build_output($this->ahk_string_name, $this->array_ahk);
        }
     
        function accent_filter ($str = NULL) 
        {
            $regexp = '/\\\u00[0-9a-fA-F][0-9a-fA-F]/';
            $stanza = json_encode($str);

            $arr_json = [];

            if (preg_match_all($regexp, $stanza, $matches))
            {
                $temp = $matches[0];

                for ($i = 0; $i < count($temp); $i++) 
                { 
                    if ($arr_json == NULL || in_array($temp[$i], $arr_json) == FALSE)
                    {
                        $arr_json[] = $temp[$i];
                    }
                }

                if ($arr_json) 
                {
                    foreach ($arr_json as $value) 
                    {
                        // strip string
                        $strip = strtoupper( substr($value, -4, 4) );
                        $ahk_format = '{U+'. $strip .'}';
                        $stanza = str_replace($value, $ahk_format, $stanza);
                    }
                }
            }
            $stanza = json_decode($stanza);
            return $stanza;
        }

        function build_output ($string_name, $generate_array) 
        {
            $generate = implode('', $generate_array);

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

            // generarrte ahk file
            $ahk_txt_file = fopen( OUTPUT_DIR."/".$this->ahk_string_name."-".$this->date_today.".ahk", "w" ) or die("Unable to open file!");
            fwrite($ahk_txt_file, $ahk_build);
            fclose($ahk_txt_file);

            return $ahk_build;
        } 
        
    }
        

    $convert = new Convert();
    $convert->init();
?>