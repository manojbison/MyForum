<div class='center'>
<?php
// List posts

echo "<h3>".$_SESSION['group']."</h3>";
echo "<p>&nbsp;</p>";

if (count($posts) > 0){
  foreach($posts as $post){
    echo anchor(base_url().'view_post/'.$post['id'],'<p class="post">'.$post['post'].'</p>');
  }

  if(isset($base_url)&&(isset($total_rows))){
    // Pagination
    $config['base_url'] = $base_url;
    $config['total_rows'] = $total_rows;
    $config['per_page'] = $per_page;
    $config['full_tag_open'] = '<p class="center">';
    $config['full_tag_close'] = '</p>';
    $config['cur_tag_open'] = '<a class="input"><b>';
    $config['cur_tag_close'] = '</b></a>';
    $config['attributes'] = array('class' => 'input', 'style' => 'margin: 5px');

    $this->pagination->initialize($config);
    echo "<p>&nbsp;</p>";
    echo $this->pagination->create_links();
  }
}else{
  echo "<p class='grid'>Nothing here...</p>";
}
?>
</div>
