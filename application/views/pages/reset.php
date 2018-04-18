<!DOCTYPE html>
<html lang="en">  
<head>
<link href="<?php echo base_url(); ?>assets/css/style.css" rel='stylesheet' type='text/css' />
</head>
<body>
<div class="container">
    <h2>Reset Password</h2>
    <?php
    if(!empty($success_msg)){
        echo '<p class="statusMsg">'.$success_msg.'</p>';
    }elseif(!empty($error_msg)){
        echo '<p class="statusMsg">'.$error_msg.'</p>';
    }
    ?>
    <form action="" method="post">
    <div class="form-group has-feedback">
            <input type="username" class="form-control" name="username" placeholder="User Name" required="" value="">
            <?php echo form_error('username','<span class="help-block">','</span>'); ?>
    </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Password" required="">
          <?php echo form_error('password','<span class="help-block">','</span>'); ?>
        </div>

        <div class="form-group">
        <input type="password" class="form-control" name="conf_password" placeholder="Confirm password" required="">
        <?php echo form_error('conf_password','<span class="help-block">','</span>'); ?>
        </div> 

        <div class="form-group">
            <input type="submit" name="resetSubmit" class="btn-primary" value="Reset password"/>
        </div>
    </form>
</div>
</body>
</html>