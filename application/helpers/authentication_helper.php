<?php

// Create your own authentication method here...

function authenticate( $username, $password )
{
  $credential[$username] = 'password';
  $credential['admin'] = 'MyPHPForum';

  if( $password == $credential[$username] ){
    // Autherticated
    return TRUE;
  }else{
    // authentication failed
    return FALSE;
  }
}

?>
