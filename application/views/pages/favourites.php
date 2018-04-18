<div class='center'>
<?php
if(isset($favourites)&&(count($favourites) > 0)){
  echo "<div class='grid'>";
  echo "<h3>Favourites</h3>";
  echo "<p>&nbsp;</p>";
  for($i=0;$i<count($favourites);$i++){
    echo "<a href='".base_url()."view_post/".$favourites[$i]['post_id']."'><p class='post'>".$post[$i]."</p></a>";
  }
  echo "<p>&nbsp;</p>";
  echo "</div>";
}else{
  echo "<div class='grid'><h3>Favourites</h3><p>&nbsp;</p><p>Nothing here...</p></div>";
}
?>
</div>
