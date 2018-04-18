<div class='center'>
<?php
// Add new user
echo form_open();
$placeholder = "Add new user";
$attr = array(
  'name'  =>  'username',
  'maxlength' =>  '30',
  'style' => 'width: 70%; padding: 10px; float: left',
  'placeholder' =>  $placeholder
);
echo form_input($attr);

isset($options) ? $options = $options : $options = array(
  '0' => 'Normal user',
  '1' => 'Forum admin'
);
$attr = array(
  'style' => 'width: 20%; padding: 10px; float: left'
);
echo form_dropdown('access',$options,'0',$attr);

$attr = array(
  'style' => 'width: 10%; padding: 10px; float: right; color: rgb(0,0,100)'
);
echo form_submit('add_user','Add',$attr);
echo form_close();

echo "<br><p class='error'>&nbsp;".$add_user_error."&nbsp;</p>";

// List users
if (count($users > 0)){
  foreach($users as $user){
    $_SESSION['username'] == $user['username'] ? $click = 'disabled' : $click = null;
    echo "<div class='grid'>";
    echo "<div class='left33'>".$user['username']."</div>";
    echo "<div class='left33'>";
    echo form_open();
    echo form_hidden('username',$user['username']);
    echo form_dropdown('update_access',$options,$user['access'],"class='select_role'; $click");
    echo form_close();
    echo "</div>";
    echo "<div class='left33'>";
    echo form_open();
    echo form_hidden('username',$user['username']);
    echo form_submit('delete_user','Delete', "style='color: red'; $click");
    echo form_close();
    echo "</div>";
    echo "</div><br>";
  }
  echo "<div>";
}
?>
</div>
