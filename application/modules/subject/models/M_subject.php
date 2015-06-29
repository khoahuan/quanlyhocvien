<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_subject extends CI_Model {

	public function insert_subject($data){
		return $this->db->insert('mon_hoc', $data);
	}
	public function updata_subject($data){
		$this->db->where('ma_mon', $data['ma_mon']);
		unset($data['ma_mon']);
		return $this->db->update('mon_hoc', $data);
	}
	public function delete_subject($data){
		$this->db->where('ma_mon', $data);
		return $this->db->delete('mon_hoc');;
	}
	public function check_subject($data){
		$this->db->where('ma_mon', $data);
		return $this->db->get('mon_hoc')->num_rows();
	}
	public function list_subject(){
		return $this->db->get('mon_hoc')->result();
	}
	public function get_info($data){
		$this->db->where('ma_mon', $data);
		$arr = $this->db->get('mon_hoc')->result();
		return $arr[0];
	}
	public function get_tiet_canh_bao($data){
      $arr = $this->get_info($data);
      $lt=$arr->ly_thuyet*20/100;
      $th=$arr->thuc_hanh*15/100;
      $arr = array('LT'=>$lt,
      						'TH'=>$th);
      return $arr;



    }

}

/* End of file M_subject.php */
/* Location: ./application/modules/subject/models/M_subject.php */