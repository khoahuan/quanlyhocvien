<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_course extends CI_Model {

	public function insert_course($data){
		return $this->db->insert('khoa_hoc', $data);
	}
	public function updata_course($data){
		$this->db->where('ma_khoa', $data['ma_khoa']);
		unset($data['ma_khoa']);
		return $this->db->update('khoa_hoc', $data);
	}
	public function delete_course($data){
		$this->db->where('ma_khoa', $data);
		return $this->db->delete('khoa_hoc');;
	}
	public function check_course($data){
		$this->db->where('ma_khoa', $data);
		return $this->db->get('khoa_hoc')->num_rows();
	}
	public function list_course($sdt=null){
		if (isset($sdt)) {
			$this->db->distinct();
			$this->db->select('kh.*');
			$this->db->where('sdt', $sdt);
			$this->db->join('khoa_hoc kh', 'kh.ma_khoa = pc.ma_khoa', 'left');
			return $this->db->get('phan_cong_cn pc')->result();
		}
		return $this->db->get('khoa_hoc')->result();
	}
	public function get_info($data){
		$this->db->where('ma_khoa', $data);
		$arr = $this->db->get('khoa_hoc')->result();
		return $arr[0];
	}

}

/* End of file M_course.php */
/* Location: ./application/modules/course/models/M_course.php */