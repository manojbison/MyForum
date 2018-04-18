<?php
echo "<div class='navbar'>";

echo '<ul><li>';
echo anchor('','Home');
echo '</li>';

echo '<li>';
echo anchor(base_url(uri_string()).'#','Groups ('.$_SESSION['group'].') &#9662;');
echo '<ul class="dropdown">';
foreach($groups as $group){
    echo anchor(base_url()."group/".$group['name'],$group['name']);
};
echo '</ul>';
echo '</li>';

echo '<li>';
echo anchor(base_url().'favourites','Favourites');
echo '</li>';

echo '<li>';
echo anchor(base_url().'post','New topic');
echo '</li>';

echo '<li>';
echo anchor(base_url().'Repository','Repository');
echo '</li>';

echo '<div style="float:right ;height:40px;width:80px;margin-right: 5px;margin-top:5px;  background-color:#0095ff;border:1px solid #07c;text-align: center;box-shadow: inset 0 1px 0 #66bfff;line-height: 50px;text-decoration: none;color:white;border-radius: 8px">';
echo anchor(base_url().'logout','Log Out');
echo '</div>';

echo "<p>&nbsp;</p>";
echo "<p>&nbsp;</p>";


echo '</ul>';
echo "</div>";
?>

