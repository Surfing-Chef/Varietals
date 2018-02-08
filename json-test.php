<?php
header('Content-Type: text/plain');

$testdata = json_decode(file_get_contents("list.json"), true);

define("TAB1", "\t\t\t\t");
define("TAB2", "\t\t\t\t\t\t\t\t");

$data = $testdata['cats'];
foreach($data as $cat){
    $cat_label = $cat['cat_label'];
    $subs_array = $cat['subs'];

    echo "$cat_label\n";
    foreach($subs_array as $sub){
        $sub_label = $sub['sub_label'];
        $preps_array = $sub['preps'];

        echo "\t$sub_label\n";
        foreach($preps_array as $prep){
            $prep_label = $prep['prep_label'];
            $varietals = $prep['varietals'];
    
            echo "\t\t$prep_label - $varietals\n";
        }
    }
    echo "\n";
}