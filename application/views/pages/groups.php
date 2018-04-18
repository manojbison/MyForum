<div class='center'><div class='grid'>
<?php
echo "<h3>Groups</h3>";
echo "<p>&nbsp;</p>";
foreach($groups as $g){
  echo "<a href='".base_url()."group/".$g['name']."'><p class='post'>".$g['name']."</p></a>";
}
echo "<p>&nbsp;</p>";
echo "</div>";
?>
</div></div>
