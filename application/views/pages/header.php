<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/bootstrap.min.css">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/summernote.css">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url();?>css/style.css">
    <title><?php echo $title; ?></title>
  </head>
  <body class="main" >
    <script src='<?php echo base_url();?>js/jquery-3.1.1.min.js'></script>
    <script src="<?php echo base_url();?>js/jquery.timeago.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>js/summernote.min.js" type="text/javascript"></script>
    <script src='<?php echo base_url();?>js/main.js'></script>
 <div class = "topbar">
     <div style = "float:right;font-family: fontawesome;font-size:20px; display: block;color:#ff4000" ><?php echo "Welcome $loggeduser.."?></div>
  <div class="topbar-wrapper">
  			 <table style="width:100%">
  				  <tr style="width:100%" >
  <td style="width:50%">

      <a href="<?php echo base_url();?>" style="text-decoration: none; font-family: fontawesome;font-size: 37px; display: block;letter-spacing: 3px; color:#555555">
              MyForum
            </a>
  </td>
  					<td style="width:50%;text-align:right"></td>

  				  </tr>

  			</table>
  		</div>
  	</div>

