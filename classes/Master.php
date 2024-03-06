<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function save_department(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `department_list` set {$data} ";
		}else{
			$sql = "UPDATE `department_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `department_list` where `name` = '{$name}' ".(is_numeric($id) && $id > 0 ? " and id != '{$id}'" : "")." ")->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = 'Department Name already exists.';
			
		}else{
			$save = $this->conn->query($sql);
			if($save){
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['id'] = $rid;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = "Department has successfully added.";
				else
					$resp['msg'] = "Department details has been updated successfully.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
			$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_department(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `department_list` set delete_flag = 1 where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Department has been deleted successfully.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_course(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `course_list` set {$data} ";
		}else{
			$sql = "UPDATE `course_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `course_list` where `name` = '{$name}' and `department_id` = '{$department_id}' ".(is_numeric($id) && $id > 0 ? " and id != '{$id}'" : "")." ")->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = ' Course Name already exists on the selected Department.';
			
		}else{
			$save = $this->conn->query($sql);
			if($save){
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['id'] = $rid;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = " Course has successfully added.";
				else
					$resp['msg'] = " Course details has been updated successfully.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
			$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_course(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `course_list` set delete_flag = 1 where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Course has been deleted successfully.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_student(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,['id'])){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `student_list` set {$data} ";
		}else{
			$sql = "UPDATE `student_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `student_list` where roll = '{$roll}' ".(!empty($id) ? " and id != '{$id}' " : "")." ")->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "An error occured.";
		}else{
			$save = $this->conn->query($sql);
			if($save){
				$sid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['sid'] = $sid;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg']= " Student Information successfully saved.";
				else
					$resp['msg']= " Student Information successfully updated.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
			$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_student(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `student_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Student has been deleted successfully.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_academic(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `academic_history` set {$data} ";
		}else{
			$sql = "UPDATE `academic_history` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = " Academic has successfully added.";
			else
				$resp['msg'] = " Academic details has been updated successfully.";
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = "An error occured.";
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] =='success')
			$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_academic(){
		extract($_POST);
		$get = $this->conn->query("SELECT * FROM `academic_history` where id = '{$id}'");
		if($get->num_rows > 0){
			$res = $get->fetch_array();
		}
		$del = $this->conn->query("DELETE FROM `academic_history` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Academic has been deleted successfully.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function update_student_status(){
		extract($_POST);
		
		$update = $this->conn->query("UPDATE `student_list` set status = '{$status}' where id = '{$id}'");
		if($update){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Student's Status has been updated successfully.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save_department':
		echo $Master->save_department();
	break;
	case 'delete_department':
		echo $Master->delete_department();
	break;
	case 'save_course':
		echo $Master->save_course();
	break;
	case 'delete_course':
		echo $Master->delete_course();
	break;
	case 'save_student':
		echo $Master->save_student();
	break;
	case 'delete_student':
		echo $Master->delete_student();
	break;
	case 'save_academic':
		echo $Master->save_academic();
	break;
	case 'delete_academic':
		echo $Master->delete_academic();
	break;
	case 'update_student_status':
		echo $Master->update_student_status();
	break;
	default:
		// echo $sysset->index();
		break;
}