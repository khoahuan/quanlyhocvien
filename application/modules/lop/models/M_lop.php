<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_lop extends CI_Model {

	public function insert_lop($data){
		return $this->db->insert('lop', $data);
	}
	public function updata_lop($data){
		$this->db->where('ma_lop', $data['ma_lop']);
		unset($data['ma_lop']);
		return $this->db->update('lop', $data);
	}
	public function delete_lop($data){
		$this->db->where('ma_lop', $data);
		return $this->db->delete('lop');;
	}
	public function check_lop($data){
		$this->db->where('ma_lop', $data);
		return $this->db->get('lop')->num_rows();
	}
	public function list_lop($sdt=null,$ma_khoa =null){
		if (isset($sdt)&& isset($ma_khoa)) {
			$this->db->select('l.*');
			$this->db->where('sdt', $sdt);
			$this->db->where('ma_khoa', $ma_khoa);
			$this->db->distinct();
			$this->db->join('lop l', 'l.ma_lop = pc.ma_lop', 'left');
			return  $this->db->get('phan_cong_cn pc')->result();
		}
		return $this->db->get('lop')->result();
	}
	public function get_info($data){
		$this->db->where('ma_lop', $data);
		$arr = $this->db->get('lop')->result();
		return $arr[0];
	}

}

/* End of file M_lop.php */
/* Location: ./application/modules/lop/models/M_lop.php */