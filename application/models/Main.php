<?php
class Main extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->userTbl = 'users';
    }

    function get($table,$limit=null,$offset=null)
    {
        $query = $this->db->get($table,$limit,$offset);
        return $query->result_array();
    }
		function add_message($message, $nickname, $guid)
	{
		$data = array(
			'message'	=> (string) $message,
			'nickname'	=> (string) $nickname,
			'guid'		=> (string)	$guid,
			'timestamp'	=> time(),
		);
		  
		$this->db->insert('messages', $data);
	}
 
	function get_messages($timestamp)
	{
		$this->db->where('timestamp >', $timestamp);
		$this->db->order_by('timestamp', 'DESC');
		$this->db->limit(10); 
		$query = $this->db->get('messages');
		
		return array_reverse($query->result_array());
	}

	    public function getusers()
    {
        $this -> db -> select('*');
        $this -> db -> from('users');
        $query = $this->db->get();
        return $query->result();
    }
    function count_all($table)
    {
        return $this->db->count_all($table);
    }

    function count_where($table,$where)
    {
        return $this->db->where($where)->count_all_results($table);
    }

    function get_where($table,$where,$limit=null,$offset=null)
    {
        $query = $this->db->get_where($table,$where,$limit,$offset);
        return $query->result_array();
    }

    function checkDuplicate($email)
	{
		$this->db->select('email');
		$this->db->from('users');
		$this->db->like('email', $email);
		return $this->db->count_all_results();
	}
	
	function insertUser($data)
	{
		if($this->db->insert('users', $data))
		{
			return  $this->db->insert_id();
		}
		else
		{
			return false;
		}
    }

    public function mail_exists($key)
    {
        $this -> db -> select('*');
        $this -> db -> from('users');
        $this->db->where('email',$key);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function username_exists($user)
    {
        $this -> db -> select('*');
        $this -> db -> from('users');
        $this->db->where('username',$user);
        $querie = $this->db->get();
        if ($querie->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    function saveNewPass($new_pass)
    {
        $data = array(
            'password' => $new_pass
        );
        $this->db->where('username', $this->input->post('username'));
        $this->db->update('users', $data);
        return true;
    }
    
    function match_where($table,$where,$string)
    {
        $s_array = explode(' ',$string);
        $this->db->like('post', $s_array[0], "before");
        foreach($s_array as $s){
          $this->db->or_like('post', $s, "before");
          $this->db->or_like('post', $s, "after");
          $this->db->or_like('description', ">".$s);
          $this->db->or_like('description', $s."<");
          $this->db->or_like('description', $s." ");
          $this->db->or_like('description', " ".$s);
        }
        $query = $this->db->get_where($table,$where);
        return $query->result_array();
    }

    function update($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
    }

    function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function delete($table, $where)
    {
        $this->db->delete($table, $where);
    }

    function getUserInfo($emailID)
    {
        $this->db->select('username'); // DB table fields.
        $this->db->where('email', $emailID); // $emailID is the value which u've already get & now compare to table field "EmailID"
        $query = $this->db->get('users'); // "user" is table name
        return $query->result();
    }


    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->userTbl);

        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key,$value);
            }
        }

        if(array_key_exists("id",$params)){
            $this->db->where('id',$params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            $query = $this->db->get();
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $query->num_rows();
            }elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
                $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
            }else{
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }

        //return fetched data
        return $result;
    }

    public function inser($data = array()) {
        //add created and modified data if not included
        if(!array_key_exists("created", $data)){
            $data['created'] = date("Y-m-d H:i:s");
            $data['access'] = 0 ;
        }
        if(!array_key_exists("modified", $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }
        
        //insert user data to users table
        $insert = $this->db->insert($this->userTbl, $data);
        
        //return the status
        if($insert){
            return $this->db->insert_id();;
        }else{
            return false;
        }
    }
}
?>
