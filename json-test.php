<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="jquery-ui/jquery-ui.structure.css">
    <link rel="stylesheet" href="jquery-ui/jquery-ui.theme.css">

    <title>JSON Matches Food and Wine</title>
</head>
<body>
<?php
//header('Content-Type: text/plain');

$testdata = json_decode(file_get_contents("list.json"), true);

define("TAB1", "\t\t\t\t");
define("TAB2", "\t\t\t\t\t\t\t\t");

$data = $testdata['cats'];
  
?><!-- START ACCORDION-CONTAINER --><div id="accordion-container" class="cats"><?php

    foreach($data as $cat){
        $cat_label = $cat['cat_label'];        
        $subs_array = $cat['subs'];

        echo "<h1>$cat_label\n</h1>";
        ?><!-- START .subs --><div class="subs"><?php
            foreach($subs_array as $sub){
                $sub_label = $sub['sub_label'];
                $preps_array = $sub['preps'];

                echo "<h2>$sub_label\n</h2>";
                ?><!-- START .preps --><div class="preps"><?php
                foreach($preps_array as $prep){
                    $prep_label = $prep['prep_label'];
                    $varietals = $prep['varietals'];
            
                    echo "<h3>$prep_label\n</h3>";
                    ?><!-- START .preps --><div><ul>

                        <?php $varietalsArray = explode(',', $varietals); 
                        foreach($varietalsArray as $item){
                            echo "<li>$item</li>";
                        }
                        ?>
                    </ul></div><!-- END .preps --><?php
                }?></div><!-- END .preps --><?php
            }?></div><!-- END .subs --><?php
        
    }

?></div><!-- END ACCORDION-CONTAINER --><?php

?>

<script src="jquery-ui/jquery-ui.js"></script>

<!-- Custom scripts for Jquery-UI: Accordion



</script>
</body>
</html>