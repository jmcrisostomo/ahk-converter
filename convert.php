<?php
/**
* String Manipulation for AHK Strings
* Created by JM Crisostomo
*/
date_default_timezone_set("Asia/Manila");

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
        $build = 'Noli['.$arr_cout.'] := "'.$line.'"'.PHP_EOL;
        $build = str_replace("“",'""',$build);
        $build = str_replace("”", '""',$build);
        $build = str_replace("’", "'",$build);
        $build = str_replace('"', '""',$build);
        $build = str_replace("–", '-',$build);
        $build = str_replace("!", '{!}',$build);

        echo $arr_ahk_format[] = $build;
        fwrite($ahk_txt_file, $build);

        $arr_cout += 1;
    }
    // break;
}
fclose($ahk_txt_file);