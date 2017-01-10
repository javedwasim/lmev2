<?php

Class User extends CI_Model{
    
    public function login($username, $password){
        
        $this->db->select('id, username, password, created_date');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);
        
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return $query->result();
        }else{
            return false;
        }
    }

	public function loginemail($email){

		$this->db->select('id, username, password, created_date');
		$this->db->from('users');
		$this->db->where('email', $email);
		$this->db->limit(1);

		$query = $this->db->get();
		if($query->num_rows() == 1){
			return $query->result();
		}else{
			return false;
		}
	}
	
	public function userRecord($userid){
        
        $this->db->select('id, username, password, created_date,image,email,about,lastlogin_date,is_active,full_name');
        $this->db->from('users');
        $this->db->where('id', $userid);
        $this->db->limit(1);
        
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return $query->result();
        }else{
            return false;
        }
    }

	public function updatepassword($email,$data){

		$this->db->where('email', $email);
		$this->db->update('users', $data);

	}
	
	public function register($data){

		$randomPwd =  $this->randomPassword();
		$password = md5($randomPwd);
		$createdDate = date("Y-m-d H:i:s");  
		
		$data = array(
		   'username' => $data['username'] ,
		   'email' => 	 $data['email'] ,
		   'created_date' => $createdDate,
		   'password' => $password,
		   'image' => 'default.png',
		   'about' => 'Say something about',
		    'lastlogin_date'=>'0000-00-00 00:00:00',
			'is_active'=>1,
			'full_name'=>'Your Name',

		);

		$userinfo = array(
		   'username' => $data['username'] ,
		   'email' => $data['email'] ,
		   'created_date' => $createdDate,
		   'password' => $randomPwd
		);
		
		$this->db->insert('users', $data);
        $last_inserted_id = $this->db->insert_id();
		
		if($last_inserted_id>0){
			return $userinfo;
		}else{
			echo "User not added";
			die();
		}

        
    }
	
	public function randomPassword() {
		
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}

	public function updateUserProfile($data,$id){

		$this->db->where('id', $id);
		$this->db->update('users', $data);

	}

	public function updateUserPassword($data,$id){

		$this->db->where('id', $id);
		$this->db->update('users', $data);

	}
    
    
}

?>