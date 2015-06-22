<?php

class UsersAdminModel extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
	
	function validate($user_name, $password)
	{
		$this->db->where('username', $user_name);
		$this->db->where('password', $password);
		$query = $this->db->get('tbl_admin');
		
		if($query->num_rows == 1)
		{
			return true;
		}		
	}
	
	function GetUser($per_page,$page)
	{ 
		$sql="select * from tbl_users where is_delete=0 limit $page,$per_page";
		$query=$this->db->query($sql);
		return $result=$query->result();
		
	}
	function GettotalUser()
	{
		$sql="select * from tbl_users where is_delete=0";
		$query=$this->db->query($sql);
		return $query->num_rows();
		
	}
	function GetUserDetail($id)
	{
		$sql="select * from tbl_users where userid=$id";
		$query=$this->db->query($sql);
		return $query->result();
	}
	function adduser()
	{
	
		$dob = $this->input->post('dob');
		$years = $this->config->item('year_value');
		$data = array("first_name"=>$this->input->post('first_name'),
					  "last_name"=>$this->input->post('last_name'),
					  "username"=>$this->input->post('username'),
					  'city_id'=>$this->input->post('city'),
					  "dob"=>get_birth_date($years[$dob['year']-1],$dob['month'],$dob['day']),
					  "gender_partner"=> $this->input->post('int'),
					  "type_partner"=> $this->input->post('type_partner'),
					  "password"=>$this->input->post('password'),
					  "email"=>$this->input->post('email'),
					  "about_me"=>$this->input->post('about_me'),
					  "sports"=>$this->input->post('sports'),
					  "regular_workout"=>$this->input->post('regular_workout'),
					  "register_date"=> @mdate('%Y-%m-%d %H:%i:%s', now()),
					  "modify_date"=> @mdate('%Y-%m-%d %H:%i:%s', now())
					 );
		$this->db->insert('tbl_users', $data);
		//echo $this->db->last_query();die;
		//return $this->db->insert_id();			 
   }
   function updateuser()
	{
		$uid=$this->input->post('userid');
	
		$dob = $this->input->post('dob');
		$years = $this->config->item('year_value');
		$data = array("first_name"=>$this->input->post('first_name'),
					  "last_name"=>$this->input->post('last_name'),
					  
					  'city_id'=>$this->input->post('city'),
					  "dob"=>get_birth_date($years[$dob['year']-1],$dob['month'],$dob['day']),
					  "gender_partner"=> $this->input->post('int'),
					  "type_partner"=> $this->input->post('type_partner'),
					 
					  "email"=>$this->input->post('email'),
					  "about_me"=>$this->input->post('about_me'),
					  "sports"=>$this->input->post('sports'),
					  "regular_workout"=>$this->input->post('regular_workout'),
					  "register_date"=> @mdate('%Y-%m-%d %H:%i:%s', now()),
					  "modify_date"=> @mdate('%Y-%m-%d %H:%i:%s', now())
					 );
					 
			$this->db->where("userid", $uid);
			$this->db->update("tbl_users", $data);		 
   }
	
	 function delete_user($id)
	 {
		 $data=array("is_delete"=>'1');
		 $this->db->where("userid", $id);
		 $this->db->update("tbl_users", $data);
		 
		// Delete all notification 
		$sql="select id from tbl_notification where (recipient_id=$id or sender_id=$id)";
		$query=$this->db->query($sql);
		$result=$query->result();
	
		foreach ($result as $notif)
		{
			$nid=$notif->id;
			$use_data=array("is_delete"=>'1');	
			$this->db->where("id", $nid);
			$this->db->update("tbl_notification", $use_data);
		}
		
		// Delete all picture 
		
		$usql="select id from tbl_upload where user_id=$id";
		$uquery=$this->db->query($usql);
		$uresult=$uquery->result();
	
		foreach ($uresult as $photo)
		{
			$uid=$photo->id;
			$puser_data=array("is_delete"=>'1');	
			$this->db->where("id", $uid);
			$this->db->update("tbl_upload", $puser_data);
		}
		
		// Delete all Friends 
		
		$fsql="select id from tbl_user_friend where (user_id=$id OR friend_id=$id)";
		$fquery=$this->db->query($fsql);
		$fresult=$fquery->result();
	
		foreach ($fresult as $friend)
		{
			$fid=$friend->id;
			$use_data=array("is_delete"=>'1');	
			$this->db->where("id", $fid);
			$this->db->update("tbl_user_friend", $use_data);
		}
		// Delete all User groups 
		
		$gsql="select id from tbl_user_group where user_id=$id";
		$gquery=$this->db->query($gsql);
		$gresult=$gquery->result();
	
		foreach ($gresult as $group)
		{
			$gid=$group->id;
			$guse_data=array("is_delete"=>'1');	
			$this->db->where("id", $gid);
			$this->db->update("tbl_user_group", $guse_data);
		}
		
		// Delete all User Workouts 
		
		$wsql="select workout_id from tbl_workout where workout_user_id=$id";
		$wquery=$this->db->query($wsql);
		$wresult=$wquery->result();
	
		foreach ($wresult as $work)
		{
			$wid=$work->id;
			$work_data=array("is_delete"=>'1');	
			$this->db->where("workout_id", $wid);
			$this->db->update("tbl_workout", $work_data);
		}
		
	
	 }
}

