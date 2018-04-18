<?php
$_SESSION['username'] = $me; // Must be already set
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        /* Create two equal columns that floats next to each other */
        .column {
            float:right;
            padding: 10px;
            height: 15px; /* Should be removed. Only for demonstration */

        }

    </style>
<link type="text/css" rel="stylesheet" media="all" href="<?=base_url()?>chat/css/chat.css" />
<script type="text/javascript" src="<?=base_url()?>chat/js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>chat/js/chat.js"></script>

</head>
<body>

<div class="column" >
<div id="main_container">
       <h3> <strong>Friends</strong> <h3>


        <?php foreach ($users as $user) { ?>
               <a href="javascript: void(0)" onclick="javascript:chatWith('<?=$user->username?>')" >
               <?php 
			   if($user->username != $loggeduser){
			   echo "$user->username";
         echo "<br/>" ;
		 }
		 ?>

                   </a>

        <?php   } ?>

    </div></div>


</body>
</html>
