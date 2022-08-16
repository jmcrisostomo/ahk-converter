
<?php
    // namespace AhkConverter\Filtering; 
    // class AccentFilter 
    // {
    //     public function hello()
    //     {
    //         return "Hello World!";
    //     }
    // }
    // $foo = "á";    
    // $foo = "î";

    // $pattern = [];
    // $replacements = [];

    // mb_regex_encoding('ISO-8859-1');
    // $reg = '/[\xA0-\xFF]/'; //regex for extended ascii characters

    
$stanza_sample = 'Nátatalà sa "historia"[2] n~g m~ga pagdaralità n~g sangcataohan ang
isáng "cáncer"[3] na lubháng nápacasamâ, na bahagyâ na lámang másalang
ay humáhapdi\'t napupucaw na roon ang lubháng makikirót na sakít. Gayón
din naman, cailán mang inibig cong icáw ay tawáguin sa guitnâ n~g m~ga
bágong "civilización"[4], sa han~gad co cung minsang caulayawin co ang
sa iyo\'y pag-aalaala, at cung minsan nama\'y n~g isumag co icáw sa m~ga
ibáng lupaín, sa towî na\'y napakikita sa akin ang iyong larawang írog na
may tagláy n~g gayón ding cáncer sa pamamayan.';

$stanza_sample = '¿Anó? Di bagá cayâ macalálabas sa
inyong man~ga dulaan ang isang
César? Tangí na bagá lamang macalálabas
doon ang isang Aquiles,
ang isang Orestes, ó Andrómaca?';
    
$regexp = '/\\\u00[0-9a-fA-F][0-9a-fA-F]/';
$stanza_sample = json_encode($stanza_sample);

$arr_json = [];

if (preg_match_all($regexp, $stanza_sample, $matches))
{
    // print_r($matches);
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
            print_r($value);
            $strip = strtoupper( substr($value, -4, 4) );
            $ahk_format = '{U+'. $strip .'}';
            $stanza_sample = str_replace($value, $ahk_format, $stanza_sample);
        }
        print_r(json_decode($stanza_sample));
    }
}




    // echo html_entity_decode(htmlentities($stanza_sample, ENT_QUOTES, 'UTF-8'), ENT_QUOTES , 'ISO-8859-1');
    // function hex2str($hex) {
    //     $str = '';
    //     for($i=0;$i<strlen($hex);$i+=2) 
    //     {
    //         $str .= chr(hexdec(substr($hex,$i,2)));
    //     };
    //     return $str;
    // }

    
    // $temp = '';
    // $filter_extended_ascii = preg_match_all($reg, $stanza_sample, $matches, PREG_SET_ORDER, 0);
    // foreach ($matches as $key => $object)
    // {
    //     foreach ($object as $key => $ascii) {
    //         // echo json_encode($ascii);
    //         # code...
    //         // $pattern[] = $ascii;
    //         // $pattern[] = "/$ascii/";
    //         $temp .= $ascii;
    //         // die();
    //         // echo mb_ord($ascii, 'ISO-8859-1'). "\n";
    //         // $pattern[] = "/\x".strtoupper(dechex(mb_ord($ascii, 'ISO-8859-1')))."/";
    //         // echo "$key: ".bin2hex($ascii) ."\n";
    //         // echo $ascii ."\n";

    //         // $stanza_sample = "0x".str_replace($ascii, strtoupper(dechex(ord($ascii))), $stanza_sample);
    //     }

    //     $temp .= $object[0];
    //     // echo $object[0];
    // }

    // // echo $temp;
    // echo json_encode($stanza_sample);


    // $temp_ascii = [];
    // $temp_hex = [];
    // // // echo $stanza_sample;
    // // // print_r($matches);
    // // // var_dump(count(str_split($temp)));
    // $arr_ascii = str_split($temp);
    // for ($i = 0; $i < count($arr_ascii); $i++) { 
        // if ($temp_ascii == NULL)
        // {
        //     $temp_ascii[] = utf8_encode($arr_ascii[$i]);
        // }
        // else if (!in_array($arr_ascii[$i], $temp_ascii)) 
        // {
        //     $temp_ascii[] = utf8_encode($arr_ascii[$i]);
        // }

    // }

    // var_dump($temp_ascii);
    // foreach (str_split($temp) as $value) {

    //         $temp_ascii[] = $value;
    //         // $temp_hex[] = mb_ord($value, "ISO-8859-1");
    //         echo $value;
    //         // echo iconv("ISO-8859-1", 'ISO-8859-1//TRANSLIT', $value);
    // }
    // die();
    // $temp_another = [];

    // foreach ($temp_hex as $key => $value) {
    //     if ($temp_hex[$key] !== $value)
    //     {
    //         $temp_another[] = $value;
    //     }
    //     echo $key;
    // }

    // for ($i = 0; $i < count($temp_hex); $i++) 
    // { 
    //     if ($temp_another == NULL)
    //     {
    //         $temp_another[] = $temp_hex[$i];
    //     }
    //     else if (!in_array($temp_hex[$i], $temp_another)) 
    //     {
    //         $temp_another[] = $temp_hex[$i];
    //     }
    //     // if ($temp_hex[$i] !== $value)
    //     // {
    //     //     $temp_another[] = $value;
    //     // }
    //     // echo $key;
    // }

    // for ($i = 0; $i < count($temp_another); $i++) { 
    //     echo "decimal: $temp_another[$i] | hex: ".dechex($temp_another[$i])." | chr: ".mb_chr($temp_another[$i], 'UTF-8')."\n";
    //     // var_dump(mb_chr($temp_another[$i], 'UTF-8'));
    //     // var_dump(mb_chr($temp_another[$i], 'ISO-8859-1'));
    // }

    // var_dump($temp_ascii);
    // echo json_encode($temp_another);


    // echo utf8_encode($stanza_sample, $output);
    // echo $output;
    // print_r($stanza_sample);
    // var_dump($pattern);
    // // $replacements = array();
    // echo preg_replace($pattern, $replacements, $stanza_sample);

    // echo mb_ord($foo);
    // echo dechex(mb_ord($foo));
    
?>