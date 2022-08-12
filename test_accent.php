<?php
    namespace AhkConverter\Filtering; 
    class AccentFilter 
    {
        public function hello()
        {
            return "Hello World!";
        }
    }
    // $foo = "á";    
    $foo = "î";

    $pattern = [];
    $replacements = [];

    $reg = '/[\x80-\xFF]/'; //regex for extended ascii characters
    $stanza_sample = 'Nátatalà sa "historia"[2] n~g m~ga pagdaralità n~g sangcataohan ang
    isáng "cáncer"[3] na lubháng nápacasamâ, na bahagyâ na lámang másalang
    ay humáhapdi\'t napupucaw na roon ang lubháng makikirót na sakít. Gayón
    din naman, cailán mang inibig cong icáw ay tawáguin sa guitnâ n~g m~ga
    bágong "civilización"[4], sa han~gad co cung minsang caulayawin co ang
    sa iyo\'y pag-aalaala, at cung minsan nama\'y n~g isumag co icáw sa m~ga
    ibáng lupaín, sa towî na\'y napakikita sa akin ang iyong larawang írog na
    may tagláy n~g gayón ding cáncer sa pamamayan.';

    $temp = '';
    $filter_extended_ascii = preg_match_all($reg, $stanza_sample, $matches, PREG_SET_ORDER, 0);
    foreach ($matches as $key => $object)
    {
        // var_dump($object);
        foreach ($object as $key => $ascii) {
            # code...
            // $pattern[] = $ascii;
            // $pattern[] = "/$ascii/";
            $temp .= $ascii;
            // die();
            // echo mb_ord($ascii, 'ISO-8859-1'). "\n";
            // $pattern[] = "/\x".strtoupper(dechex(mb_ord($ascii, 'ISO-8859-1')))."/";
            // echo "$key: ".bin2hex($ascii) ."\n";
            // echo $ascii ."\n";

            // echo $stanza_sample = str_replace($ascii, strtoupper(dechex(mb_ord($ascii, 'ISO-8859-1'))), $stanza_sample);
        }
        // echo $object;
    }
    echo $temp;

    var_dump(str_split($temp));
    // print_r($stanza_sample);
    // var_dump($pattern);
    // // $replacements = array();
    // echo preg_replace($pattern, $replacements, $stanza_sample);

    // echo mb_ord($foo);
    // echo dechex(mb_ord($foo));
    
?>