<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="jquery-ui.css">
    <link rel="stylesheet" href="jquery-ui.structure.css">
    <link rel="stylesheet" href="jquery-ui.theme.css">

    <title>JSON Matches Food and Wine</title>
</head>
<body>
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

?>

<script src="jquery-ui/jquery-ui.js"></script>

<!-- Custom scripts for Jquery-UI: Accordion



</script>
</body>
</html>