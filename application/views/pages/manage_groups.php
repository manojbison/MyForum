<div class='center'>
<?php
// Add new user
echo form_open();
$attr = array(
  'name'  =>  'name',
  'maxlength' =>  '80',
  'style' => 'width: 80%; padding: 10px; float: left',
  'placeholder' =>  'Add new group'
);
echo form_input($attr);

$attr = array(
  'style' => 'width: 20%; padding: 10px; float: right; color: rgb(0,0,100)'
);
echo form_submit('add_group','Add',$attr);
echo form_close();

echo "<br><p class='error'>&nbsp;".$add_group_error."&nbsp;</p>";

// List users
if (count($groups > 0)){
  foreach($groups as $group){
    $group['name'] == "General discussions" ? $click = 'disabled' : $click = null;
    echo "<div class='grid'>";
    echo "<div class='left60'>".$group['name']."</div>";
    echo "<div class='left40'>";
    echo form_open();
    echo form_hidden('name',$group['name']);
    echo form_submit('delete_group','Delete group (with all posts)', "style='color: red'; $click");
    echo form_close();
    echo "</div>";
    echo "</div><br>";
  }
  echo "<div>";
}
?>
</div>
