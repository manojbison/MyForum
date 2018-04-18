<div class='center'>
<?php
if (isset($post['post'])){
  echo "<div class='grid'><h3 style='text-align: center'>".$post['post']."</h3>";
  echo "<p>&nbsp;</p>";
  echo "<p class='info'>";
  echo "<span>Posted by- <b>".$post['author']."</b>, ";
  echo "in group- ".$post['groupname'].", ";
  echo "<time class='timeago' datetime='".date('r',$post['date'])."'></time></span>";
  echo "</p>";
  if(isset($post['description'])&&(!empty($post['description']))) {
    echo "<br><hr/><div class='left'>".$post['description']."</div>";
  };
    echo "</div>";

    echo "<div class='info'>";
    $attr = array('style'=>'display: inline-block; margin: 10px ! important;font-size:10px');
    echo form_open('',$attr);
    $favourite == 0 ? $text = 'Fav' : $text = 'Un Fav';
    echo form_submit('ch_fav',$text);
    echo form_close();
    if(($_SESSION['username'] == $post['author'])||($_SESSION['access'] > 0)){
        echo form_open('',$attr);
        echo form_submit('delete_post','Delete ', "style='color: red'");
        echo form_close();
    };
    echo "</div>";


  if(isset($fetched_comments)&&(count($fetched_comments) > 0)){
    foreach($fetched_comments as $f){
      $sorted_comments[$f['date']] = $f;
    }
    ksort($sorted_comments); // Sort by date
    $comments = array_values(array_filter($sorted_comments));
    echo "<p>&nbsp;</p>";

    foreach ($comments as $comment) {
      echo "<div class='grid'>";
      echo "<p class='info'>Posted by- <b>".$comment['commenter']."</b>, ";
      echo "<time class='timeago' datetime='".date('r',$comment['date'])."'></time></p>";
      echo "<div class='left'".$comment['comment']."</div>";
      echo "</div>";
      if(($comment['commenter'] == $_SESSION['username'])||($_SESSION['access'] > 0)){
        echo "<div class='info'>";
          $attr = array('style'=>'display: inline-block; margin: 6px ! important;font-size:10px');
        echo form_open('',$attr);
        echo form_hidden('comment_id',$comment['id']);
        echo form_submit('delete_comment','Delete ', "style='color: red'");
        echo form_close();
        echo "</div>";
      };
      if($comment['id'] != $comments[count($comments)-1]['id']){echo "<p>&nbsp;</p>";}
    }
  }

  echo "<p>&nbsp;</p>";
    echo "<p>&nbsp;</p>";
  echo form_open();
  $attr = array(
    'name'  =>  'comment',
    'id' => 'summernote',
    'style' => 'height: 100px; width: 100%; max-width: 100%; padding: 10px;',
    'placeholder' =>  'Write a comment...'
  );
  echo form_textarea($attr);

  $attr = array(
    'style' => 'width: 100%; padding: 10px; color: rgb(0,0,100)'
  );
  echo form_submit('submit_comment','Post comment',$attr);
  echo form_close();
}else{
  echo "<h1 class='grid'>Nothing here...</h1>";
}
?>
</div>
