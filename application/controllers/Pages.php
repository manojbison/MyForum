<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('main');
}

    public function view_page($page = "home", $param = null, $param2 = null )
	{
		// Function to load a page

    $users = $this->main->get("users");
    $groups = $this->main->get("groups");
    
    isset($_SESSION['group']) ? $group = $_SESSION['group'] : $group = "General discussions";
    $_SESSION['group'] = $group;
    $data['title'] = ucfirst(str_replace('_',' ',$page));
    $data['users'] = $users;
    $data['groups'] = $groups;
    $data['group'] = $group;
    $data['per_page'] = 10;
    $data['loggeduser'] = $_SESSION['username'];
	//$data['me'] = $_SESSION['username'];

    if(isset($_POST['search'])&&(!empty($_POST['searchbar']))){
      redirect(base_url().'search/'.$_SESSION['group'].'/'.$_POST['searchbar']);
    };

    // Home page
    if ($page == "home") {

        $favourites = $this->main->get_where('favourites', array('username' => $_SESSION['username']));
        if (isset($_SESSION['username'])) {
            for ($i = 0; $i < count($favourites); $i++) {
                $fetched = $this->main->get_where('posts', array('id' => $favourites[$i]['post_id']));
                $data['post'][$i] = $fetched[0]['post'];
            }
        }
        $data['favourites'] = $favourites;
        $this->load->view('pages/header', $data);
        if(isset($_SESSION['username'])){
			$data['me'] = $_SESSION['username'];
	$data['users'] = $this->main->getusers();
		
            if($_SESSION['access'] == 1){

                $this->load->view('pages/logout',$data);
				$this->load->view('pages/home1',$data);
            }else{
                $this->load->view('pages/logout2',$data);
				$this->load->view('pages/home1',$data);
				
            }
        }else{
            $this->load->view('pages/navbar',$data);
        }
        


   //isset($_SESSION['username']) ? $this->load->view('pages/logout',$data) : $this->load->view('pages/navbar',$data);
      $this->load->view('pages/home',$data);
      $this->load->view('pages/groups',$data);
      $this->load->view('pages/favourites',$data);
    }

 elseif ($page == "Repository")
    {

   	$data['myname'] = $_SESSION['username'];

        $this->load->view('pages/header', $data);
        if(isset($_SESSION['username'])){
		
            if($_SESSION['access'] == 1){

                $this->load->view('pages/logout',$data);
				//$this->load->view('pages/home1',$data);
            }else{
                $this->load->view('pages/logout2',$data);
				//$this->load->view('pages/home1',$data);
				
            }
        }else{
            $this->load->view('pages/navbar',$data);
        }

       $this->load->view('pages/upload_form', array('error' => ' ' ));
		
	
	}

   elseif ($page == "Reposit")
    {
	$data['myname'] = $_SESSION['username'];
	        $this->load->view('pages/header', $data);
        if(isset($_SESSION['username'])){
		
            if($_SESSION['access'] == 1){

                $this->load->view('pages/logout',$data);
				//$this->load->view('pages/home1',$data);
            }else{
                $this->load->view('pages/logout2',$data);
				//$this->load->view('pages/home1',$data);
				
            }
        }else{
            $this->load->view('pages/navbar',$data);
        }


                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = '*';
                $config['max_size']             = 20000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);
				$this->upload->initialize($config);

           if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('pages/upload_form', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                        $this->load->view('pages/upload_success', $data);
                }


                

	  }

 // User management page
    elseif ($page == "manage_users")
    {
            $this->load->view('pages/header', $data);
        if(isset($_SESSION['username'])){
            if($_SESSION['access'] == 1){

                $this->load->view('pages/logout',$data);
            }else{
                $this->load->view('pages/logout2',$data);
            }
        }else{
            $this->load->view('pages/navbar',$data);
        }
           // isset($_SESSION['username']) ? $this->load->view('pages/logout', $data) : $this->load->view('pages/navbar', $data);
            $data['add_user_error'] = null;
            if (isset($_POST['add_user']) && (!empty($_POST['username']))) {
                if (in_deep_array($_POST['username'], $users)) {
                    $data['add_user_error'] = "Username " . $_POST['username'] . " already exists !";
                } else {
                    $this->main->insert('users', array('username' => $_POST['username'], 'access' => $_POST['access']));
                    redirect(base_url() . "manage_users");
                }
            };
            if (isset($_POST['delete_user']) && (!empty($_POST['username']))) {
                $this->main->delete('users', array('username' => $_POST['username']));
                redirect(base_url() . "manage_users");
            };
            if (isset($_POST['update_access']) && (!empty($_POST['username']))) {
                $this->main->update('users', array('access' => $_POST['update_access']), array('username' => $_POST['username']));
                redirect(base_url() . "manage_users");
            };
            $this->load->view('pages/manage_users', $data);
    }

    // Group management page
    elseif ($page == "manage_groups")
    {
    
        $this->load->view('pages/header',$data);
        if(isset($_SESSION['username'])){
            if($_SESSION['access'] == 1){

                $this->load->view('pages/logout',$data);
            }else{
                $this->load->view('pages/logout2',$data);
            }
        }else{
            $this->load->view('pages/navbar',$data);
        }
        //isset($_SESSION['username']) ? $this->load->view('pages/logout',$data) : $this->load->view('pages/navbar',$data);
        $data['add_group_error'] = null;
        if (isset($_POST['add_group'])&&(!empty($_POST['name']))){
          if (in_deep_array($_POST['name'],$groups)){
            $data['add_group_error'] = "Group name ".$_POST['name']." already exists !";
          }else{
            $this->main->insert('groups',array('name'=>$_POST['name']));
            redirect(base_url()."manage_groups");
          }
        };
        if (isset($_POST['delete_group'])&&(!empty($_POST['name']))){
          $this->main->delete('groups',array('name'=>$_POST['name']));
          $posts_to_delete = $this->main->get_where('posts',array('groupname'=>$_POST['name']));
          $this->main->delete('posts',array('groupname'=>$_POST['name']));
          foreach($posts_to_delete as $p){
            $this->main->delete('comments',array('post_id'=>$p['id']));
            $this->main->delete('favourites',array('post_id'=>$p['id']));
          }
          redirect(base_url()."manage_groups");
        };
        $this->load->view('pages/manage_groups', $data);
      
    }

    // Logout
    elseif($page == "logout")
    {
      $this->session->unset_userdata('isUserLoggedIn');
      $this->session->unset_userdata('userId');
      $this->session->sess_destroy();
      redirect(base_url());
    }

    //register
    elseif($page == "register")
    {
      $this->load->view('pages/header',$data);
        if(isset($_SESSION['username'])){
            if($_SESSION['access'] == 1){

                $this->load->view('pages/logout',$data);
            }else{
                $this->load->view('pages/logout2',$data);
            }
        }else{
            $this->load->view('pages/navbar',$data);
        }
      //isset($_SESSION['username']) ? $this->load->view('pages/logout',$data) : $this->load->view('pages/navbar',$data);
      $this->load->view('pages/register',$data);
      $data = array();
      $userData = array();
      if($this->input->post('regisSubmit')){
          $this->form_validation->set_rules('username', 'Name', 'required|is_unique[users.username]');
          $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
          $this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[25]');
          $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]');

          $userData = array(
              'username' => strip_tags($this->input->post('username')),
              'email' => strip_tags($this->input->post('email')),
              'password' => md5($this->input->post('password')),
              'gender' => $this->input->post('gender'),
              'phone' => strip_tags($this->input->post('phone'))
          );
          if($this->form_validation->run() == true){
              $insert = $this->main->inser($userData);
              if($insert){
      
                   echo "<script>
alert('Your registration was successfully. Please login to your account.');
window.location.href='login';
</script>";

              }else{
                   echo "<script>
alert('Some problem, please try again.');
window.location.href='register';
</script>";
              }
          }else{
              $mailexist=$this->main->mail_exists($this->input->post('email'));
              if($mailexist){
                  echo "<script>
               alert('Mail id already exist, try another');
               window.location.href='register';
               </script>";
              }
              $userexist=$this->main->username_exists($this->input->post('username'));
              if($userexist){
                  echo "<script>
                  alert('User Name already exist, try another');
                  window.location.href='register';
                  </script>";
              }

                   echo "<script>
alert('Some problem occured, please try again.');
window.location.href='register';
</script>";


}
      }
      $data['user'] = $userData;
      //echo "$data" ;
    }

    elseif($page == "reset"){
        $this->load->view('pages/header',$data);
        if(isset($_SESSION['username'])){
            if($_SESSION['access'] == 1){

                $this->load->view('pages/logout',$data);
            }else{
                $this->load->view('pages/logout2',$data);
            }
        }else{
            $this->load->view('pages/navbar',$data);
        }
        $this->load->view('pages/reset',$data);


        if($this->input->post('resetSubmit')){
            $this->form_validation->set_rules('username', 'Name', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]');

            if ($this->form_validation->run() == true) {

                $fetched = $this->main->get_where('users',array('username'=>$this->input->post('username')));
                if (count($fetched) > 0){
                    $resetpass = $this->main->saveNewPass($this->input->post('password'));
                    if($resetpass){
                        echo "<script>
                        alert('reset successfull');
                        window.location.href='login';
                        </script>";
                    }

                }else{
                    echo "<script>
                                    alert('username Not found, please try again.');
                                    window.location.href='reset';
                                    </script>";
                }
            }
        }

    }



    // Login page
    elseif($page == "login")
    {
      $this->load->view('pages/header',$data);
        if(isset($_SESSION['username'])){
            if($_SESSION['access'] == 1){

                $this->load->view('pages/logout',$data);
            }else{
                $this->load->view('pages/logout2',$data);
            }
        }else{
            $this->load->view('pages/navbar',$data);
        }
      //isset($_SESSION['username']) ? $this->load->view('pages/logout',$data) : $this->load->view('pages/navbar',$data);
            //load the view
      $this->load->view('pages/login', $data);
      $data = array();
      if($this->session->userdata('success_msg')){
          $data['success_msg'] = $this->session->userdata('success_msg');
          $this->session->unset_userdata('success_msg');
      }
      if($this->session->userdata('error_msg')){
          $data['error_msg'] = $this->session->userdata('error_msg');
          $this->session->unset_userdata('error_msg');
      }
      if($this->input->post('loginSubmit')){
          $this->form_validation->set_rules('username', 'Name', 'required');
          $this->form_validation->set_rules('password', 'password', 'required');

          if ($this->form_validation->run() == true) {

              $fetched = $this->main->get_where('users',array('username'=>$this->input->post('username')));
              if (count($fetched) > 0){
                  $_SESSION['username'] = $this->input->post('username');
                  $_SESSION['access'] = $fetched[0]['access'];
                  $this->session->set_userdata('isUserLoggedIn',TRUE);

                  echo "<script>
alert('login successfull');
window.location.href='home';
</script>";
              }else{
                            echo "<script>
alert('Wrong username or password, please try again.');
window.location.href='login';
</script>";
              }
          }
      }

    }
    // Inside a group
    elseif($page == "group")
    {
      //isset($_SESSION['username']) ? $n=null : redirect(base_url().'login');
    
      if(isset($param)&&in_deep_array(urldecode($param),$groups)){
        $group = urldecode($param);
        $data['group'] = $group;
        $_SESSION['group'] = $group;
        $data['base_url'] = base_url().'group/'.$_SESSION['group'];
        $data['total_rows'] = $this->main->count_where('posts',array('groupname'=>$_SESSION['group']));
        isset($param2)&&(is_numeric($param2)) ? $data['offset'] = $param2 : $data['offset'] = 0;
        $data['posts'] = $this->main->get_where('posts',array('groupname'=>$_SESSION['group']),$data['per_page'],$param2);
        $data['title'] = $group;

        $this->load->view('pages/header',$data);
          if(isset($_SESSION['username'])){
              if($_SESSION['access'] == 1){

                  $this->load->view('pages/logout',$data);
              }else{
                  $this->load->view('pages/logout2',$data);
              }
          }else{
              $this->load->view('pages/navbar',$data);
          }
        //isset($_SESSION['username']) ? $this->load->view('pages/logout',$data) : $this->load->view('pages/navbar',$data);
        $this->load->view('pages/search_box');
        $this->load->view('pages/content',$data);
      }else{redirect(base_url());}
   
    }
  

    // Search results page
    elseif($page == "search")
    {
      //isset($_SESSION['username']) ? $n=null : redirect(base_url().'login');

      if(isset($param)&&(in_deep_array(urldecode($param),$groups))&&($param2)&&(!empty($param2))){
        $data['title'] = urldecode($param2);
        $data['posts'] = $this->main->match_where('posts',array('groupname'=>urldecode($param)),urldecode($param2));

        $this->load->view('pages/header',$data);
          if(isset($_SESSION['username'])){
              if($_SESSION['access'] == 1){

                  $this->load->view('pages/logout',$data);
              }else{
                  $this->load->view('pages/logout2',$data);
              }
          }else{
              $this->load->view('pages/navbar',$data);
          }
        //$this->load->view('pages/navbar',$data);
        $this->load->view('pages/search_box');
        $this->load->view('pages/content',$data);
      }else{redirect(base_url());}
    }

    // View all groups
    elseif($page == "groups")
    {
      //isset($_SESSION['username']) ? $n=null : redirect(base_url().'login');

      $this->load->view('pages/header',$data);
      $this->load->view('pages/navbar',$data);
      $this->load->view('pages/groups',$data);
    }
    // View all favourites
    elseif($page == "favourites")
    {
        //isset($_SESSION['username']) ? $n=null : redirect(base_url().'login');

        $favourites = $this->main->get_where('favourites',array('username'=>$_SESSION['username']));

        for($i=0;$i<count($favourites);$i++){
            $fetched = $this->main->get_where('posts',array('id'=>$favourites[$i]['post_id']));
            $data['post'][$i] = $fetched[0]['post'];
        }
        $data['favourites'] = $favourites;
        $this->load->view('pages/header',$data);
        if(isset($_SESSION['username'])){
            if($_SESSION['access'] == 1){

                $this->load->view('pages/logout',$data);
            }else{
                $this->load->view('pages/logout2',$data);
            }
        }else{
            $this->load->view('pages/navbar',$data);
        }
        //isset($_SESSION['username']) ? $this->load->view('pages/logout',$data) : $this->load->view('pages/navbar',$data);
        $this->load->view('pages/favourites',$data);
    }

    // Post something
    elseif($page == "post")
    {
      //isset($_SESSION['username']) ? $n=null : redirect(base_url().'login');

      if(isset($_POST['submit'])&&(!empty($_POST['post']))){
        $post_id = $this->main->insert('posts',array(
          'post'=>$_POST['post'],
          'description'=>$_POST['description'],
          'groupname'=>$_POST['groupname'],
          'author'=>$_SESSION['username'],
          'date'=>now()
        ));
        redirect(base_url().'view_post/'.$post_id);
      };
      $this->load->view('pages/header',$data);
        if(isset($_SESSION['username'])){
            if($_SESSION['access'] == 1){

                $this->load->view('pages/logout',$data);
            }else{
                $this->load->view('pages/logout2',$data);
            }
        }else{
            $this->load->view('pages/navbar',$data);
        }
      //isset($_SESSION['username']) ? $this->load->view('pages/logout',$data) : $this->load->view('pages/navbar',$data);
      for($i=0;$i<count($groups);$i++){
        $data['options'][$groups[$i]['name']] = $groups[$i]['name'];
      }
      $this->load->view('pages/post',$data);
    }

    // View posts
    elseif($page == "view_post")
    {
      //isset($_SESSION['username']) ? $n=null : redirect(base_url().'login');

      if(isset($param)){
        $post_id = $param;
        $fetched = $this->main->get_where('posts',array('id'=>$post_id));

        if (isset($_POST['delete_post'])){
          $this->main->delete('posts',array('id'=>$post_id));
          $this->main->delete('comments',array('post_id'=>$post_id));
          $this->main->delete('favourites',array('post_id'=>$post_id));
          redirect(base_url());
        };

        $fav = $this->main->get_where('favourites',array('post_id'=>$post_id,'username'=>$_SESSION['username']));
        count($fav) > 0 ? $data['favourite'] = 1 : $data['favourite'] = 0;

        if (isset($_POST['ch_fav'])){
          if($data['favourite'] == 0){
            $this->main->insert('favourites',array('post_id'=>$post_id,'username'=>$_SESSION['username']));
          }else{
            $this->main->delete('favourites',array('post_id'=>$post_id,'username'=>$_SESSION['username']));
          };
          redirect(base_url().'view_post/'.$post_id);
        };

        if (isset($_POST['delete_comment'])){
          $this->main->delete('comments',array('id'=>$_POST['comment_id']));
          redirect(base_url().'view_post/'.$post_id);
        };

        if (isset($_POST['submit_comment'])&&(!empty($_POST['comment']))){
          $this->main->insert('comments',array(
            'post_id' => $post_id,
            'comment' => $_POST['comment'],
            'commenter' => $_SESSION['username'],
            'date' => now()
          ));
          redirect(base_url().'view_post/'.$post_id);
        };
        if(count($fetched) > 0){
          $data['post'] = $fetched[0];
          $fetched = $this->main->get_where('comments',array('post_id'=>$post_id));
          $data['fetched_comments'] = $fetched;

          $this->load->view('pages/header',$data);
            if(isset($_SESSION['username'])){
                if($_SESSION['access'] == 1){

                    $this->load->view('pages/logout',$data);
                }else{
                    $this->load->view('pages/logout2',$data);
                }
            }else{
                $this->load->view('pages/navbar',$data);
            }
            //isset($_SESSION['username']) ? $this->load->view('pages/logout',$data) : $this->load->view('pages/navbar',$data);
          $this->load->view('pages/search_box');
          $this->load->view('pages/view_post',$data);
        }else{redirect(base_url());}
      }else{redirect(base_url());}
    }

    $this->load->view('pages/footer');
    
  }

}
