<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_classroom extends CI_Model {

	public function insert_classroom($data){
		return $this->db->insert('phong_hoc', $data);
	}
	public function updata_classroom($data){
		$this->db->where('ma_phong', $data['ma_phong']);
		unset($data['ma_phong']);
		return $this->db->update('phong_hoc', $data);
	}
	public function delete_classroom($data){
		$this->db->where('ma_phong', $data);
		return $this->db->delete('phong_hoc');;
	}
	public function check_classroom($data){
		$this->db->where('ma_phong', $data);
		return $this->db->get('phong_hoc')->num_rows();
	}
	public function list_classroom(){
		return $this->db->get('phong_hoc')->result();
	}
	public function get_info($data){
		$this->db->where('ma_phong', $data);
		$arr = $this->db->get('phong_hoc')->result();
		return $arr[0];
	}

}

/* End of file M_classroom.php */
/* Location: ./application/modules/classroom/models/M_classroom.php */