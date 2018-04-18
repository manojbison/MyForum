<div class='center'><div class='grid'>
<?php
// Add new user
echo "<h3>Start a topic</h3>";
echo "<p>&nbsp;</p>";
echo form_open();
$attr = array(
  'name'  =>  'post',
  'style' => 'width: 100%; padding: 10px;',
  'placeholder' =>  'Topic title...',
  'autofocus' => 'autofocus'
);
echo form_input($attr);
echo '<div id="summernote"></div>';

echo "<p>&nbsp;</p>";

$attr = array(
  'style' => 'width: 100%; padding: 10px;'
);
echo form_dropdown('groupname',$options,$_SESSION['group'],$attr);

echo "<p>&nbsp;</p>";

$attr = array(
  'name'  =>  'description',
  'id' => 'summernote',
  'style' => 'height: 100px; width: 100%; max-width: 100%; padding: 10px;',
  'placeholder' =>  'Description... (optional)'
);
echo form_textarea($attr);

$attr = array(
  'style' => 'width: 100%; padding: 10px; color: rgb(0,0,100)'
);
echo form_submit('submit','Post',$attr);
echo form_close();

echo "<p>&nbsp;</p><p>&nbsp;</p>";

?>
</div></div>
