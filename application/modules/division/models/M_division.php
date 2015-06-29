<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_division extends CI_Model {

	public function insert_division($data){
		return $this->db->insert('phan_cong', $data);
	}
	
	public function delete_division($sdt,$ma_mon){
		$this->db->where('sdt', $sdt);
		$this->db->where('ma_mon', $ma_mon);
		return $this->db->delete('phan_cong');;
	}
	public function check_division($sdt,$ma_mon){
		$this->db->where('sdt', $sdt);
		$this->db->where('ma_mon', $ma_mon);
		return $this->db->get('phan_cong')->num_rows();
	}
	public function list_division(){
		return $this->db->get('phan_cong')->result();
	}
	public function get_info($data){
		$this->db->where('sdt', $data->sdt);
		$this->db->where('ma_mon', $data->ma_mon);
		$arr = $this->db->get('phan_cong')->result();
		return $arr[0];
	}

}

/* End of file M_division.php */
/* Location: ./application/modules/division/models/M_division.php */