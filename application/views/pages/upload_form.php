<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart(base_url().'Reposit');?>

<input type="file" name="userfile" size="200" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>