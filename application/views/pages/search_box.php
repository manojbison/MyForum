<div class='center'>
<?php
// Search bar
echo form_open();
$attr = array(
  'name'  =>  'searchbar',
  'type' => 'search',
  'autofocus' => 'autofocus',
  'maxlength' =>  '100',
  'style' => 'width: 80%; padding: 10px; float: left',
  'placeholder' =>  'Search in '.$_SESSION['group'].'...'
);
echo form_input($attr);

$attr = array(
  'style' => 'width: 20%; padding: 10px; float: right; color: rgb(0,0,100)'
);
echo form_submit('search','Search',$attr);
echo form_close();
?>
</div>
<p>&nbsp;</p>
