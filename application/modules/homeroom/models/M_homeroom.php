<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_homeroom extends CI_Model {

	public function list_homeroom(){
		return $this->db->get('phan_cong_cn')->result();
	}
	public function check_homeroom($data){
		$this->db->where('ma_khoa', $data['ma_khoa']);
		$this->db->where('ma_lop', $data['ma_lop']);
		return $this->db->get('phan_cong_cn')->num_rows();
	}
	public function check_del($data){
		$this->db->where('ma_pc_cn', $data);
		return $this->db->get('phan_cong_cn')->num_rows();
	}
	public function insert_homeroom($data){
		return $this->db->insert('phan_cong_cn', $data);
	}
	public function delete_homeroom($data){
		$this->db->where('ma_pc_cn', $data);
		return $this->db->delete('phan_cong_cn');
	}
	public function get_ma_pc_cn($ma_khoa,$ma_lop){
		$this->db->where('ma_khoa', $ma_khoa);
		$this->db->where('ma_lop', $ma_lop);
		$this->db->select('ma_pc_cn');
		$temp = $this->db->get('phan_cong_cn');
		if ($temp->num_rows()!=0) {
			return $temp->result()[0]->ma_pc_cn;
		}
		return null;
	}
	public function get_homeroom($data){
		$this->db->where('ma_pc_cn', $data);
		return $this->db->get('phan_cong_cn')->result()[0];
	}

}

/* End of file M_homeroom.php */
/* Location: ./application/modules/homeroom/models/M_homeroom.php */