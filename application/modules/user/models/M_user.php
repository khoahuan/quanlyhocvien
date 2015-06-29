<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->library('session');
	}
	
	public function check_login(){
		//$user_info=$this->session->userdata('user');
		if ($this->session->has_userdata('user')) {
			return 1;
		}else{
			return 0;
		}
	}

	public function create_login($sdt,$mat_khau){
		$mat_khau=  md5($mat_khau);
	    $this->db->select('cap_bac');
	    $this->db->where('sdt', $sdt);
	    $this->db->where('mat_khau', $mat_khau);
	    $fld = $this->db->get('giao_vien')->result();
	    if (empty($fld))
	        return 0;
	    $info = array('sdt' => $sdt,
	    			'cap_bac' => $fld[0]->cap_bac
	    			);
	    $arr=array('user'=>$info);
	    $this->session->set_userdata($arr);
		return $sdt;
	}
	public function check_user($sdt,$mat_khau){
		$mat_khau=  md5($mat_khau);
	    $this->db->select('cap_bac');
	    $this->db->where('sdt', $sdt);
	    $this->db->where('mat_khau', $mat_khau);
	    $fld = $this->db->get('giao_vien')->num_rows();
	    if ($fld==0)
	        return 0;
		return 1;
	}
	public function updata_pass($data){
		$data['mat_khau']=  md5($data['mat_khau']);
		$this->db->where('sdt', $data['sdt']);
	    return $this->db->update('giao_vien', $data);
	}


	public function get_info($sdt =null){
		if (isset($sdt)) {
			$this->db->where('sdt', $sdt);
			$arr =  $this->db->get('giao_vien')->result();
			return $arr[0];
		}
		if (!$this->check_login())
	        return 0;
	    $user_info=$this->session->userdata('user');
		$this->db->where('sdt', $user_info['sdt']);
		$arr =  $this->db->get('giao_vien')->result();
		return $arr[0];
	}
	public function list_user(){
		return $this->db->get('giao_vien')->result();
	}
	public function check_giaovien($sdt){
		$this->db->select('sdt');
		$this->db->where('sdt', $sdt);
		return $this->db->get('giao_vien')->num_rows();
	}
	public function insert_user($data){
		return $this->db->insert('giao_vien', $data);
	}
	public function updata_user($data){
		$this->db->where('sdt',$data['sdt']);
		unset($data['sdt']);
		return $this->db->update('giao_vien', $data);
	}
	public function delete_user($data){
		$this->db->where('sdt',$data);
		return $this->db->delete('giao_vien');
	}
	

}

/* End of file M_user.php */
/* Location: ./application/modules/user/models/M_user.php */