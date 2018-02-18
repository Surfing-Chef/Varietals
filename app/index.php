<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/styles.css">

    <title>JSON Matches Food and Wine 1.0</title>
</head>
<body>
<?php
//header('Content-Type: text/plain');

$testdata = json_decode(file_get_contents("list.json"), true);
$data = $testdata['cats'];
  
?><!-- START ACCORDION-CONTAINER -->
    <ul id="accordion" class="cats"><?php

    foreach($data as $cat){
        $cat_label = $cat['cat_label'];        
        $subs_array = $cat['subs'];
        ?>
        <!-- START .cats -->
        <li class="cats">
            <a class="toggle" href="javascript:void(0);"><?php echo $cat_label; ?></a>
            <ul class="inner">
            <?php
            foreach($subs_array as $sub){
                $sub_label = $sub['sub_label'];
                $preps_array = $sub['preps'];
                ?>
                <!-- START .subs -->
                <li class="subs">
                    <a class="toggle" href="javascript:void(0);"><?php echo $sub_label; ?></a>
                    <ul class="inner">
                    <?php
                    foreach($preps_array as $prep){
                        $prep_label = $prep['prep_label'];
                        $varietals = $prep['varietals'];
                        ?>
                        <!-- START .preps -->
                        <li class="preps">
                            <a class="toggle" href="javascript:void(0);"><?php echo $prep_label; ?></a>
                            <ul class="inner varietal">
                                <?php $varietalsArray = explode(',', $varietals); 
                                foreach($varietalsArray as $item){
                                    echo "<li>$item</li>";
                                }?>
                            </ul>
                        </li><!-- END .preps -->
                    <?php } ?>
                    </ul>
                </li><!-- END .subs -->
            <?php } ?>
            </ul>
        </li><!-- END .cats --><?php
    }?>
    </ul><!-- END ACCORDION-CONTAINER --><?php
?>

<script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script>

$().ready(function(){
    $('.toggle').click(function(e) {
        e.preventDefault();
    
        var $this = $(this);
    
        if ($this.next().hasClass('show')) {
            $this.next().removeClass('show');
            $this.next().slideUp(350);
        } else {
            $this.parent().parent().find('li .inner').removeClass('show');
            $this.parent().parent().find('li .inner').slideUp(350);
            $this.next().toggleClass('show');
            $this.next().slideToggle(350);
        }
    });
});

</script>
</body>
</html>