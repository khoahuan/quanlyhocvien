<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_theo_doi extends CI_Model {

	
	public function get_phong(){
		return $this->db->get('phong_hoc')->result();		
	}
	public function get_mon(){
		return $this->db->get('mon_hoc')->result();		
	}
	public function get_mon_phan_cong($data){
		$this->db->select('mh.ma_mon,mh.ten_mon');
		$this->db->where('pc.sdt', $data);
		$this->db->join('mon_hoc mh', 'mh.ma_mon = pc.ma_mon', 'left');
		return $this->db->get('phan_cong pc')->result();
	}
	public function get_khoa(){
		return $this->db->get('khoa_hoc')->result();		
	}
	public function get_lop(){
		return $this->db->get('lop')->result();		
	}
	public function get_lop_co_hv($sdt,$ma_khoa){
		$this->db->select('l.*');
		$this->db->distinct();
		$this->db->join('phan_cong_cn pc', 'hv.ma_pc_cn = pc.ma_pc_cn', 'left');
		$this->db->join('lop l', 'l.ma_lop = pc.ma_lop', 'left');
		$this->db->where('pc.ma_khoa', $ma_khoa);
		$this->db->where('pc.sdt', $sdt);

		return $this->db->get('hoc_vien hv')->result();		
	}
	public function get_ten_phong($id){
		$this->db->where('ma_phong', $id);
		return $this->db->get('phong_hoc')->result()[0]->ten_phong;		
	}
	public function get_ten_mon($id){
		$this->db->where('ma_mon', $id);
		return $this->db->get('mon_hoc')->result()[0]->ten_mon;		
	}
	public function get_ten_khoa($id){
		$this->db->where('ma_khoa', $id);
		return $this->db->get('khoa_hoc')->result()[0]->ten_khoa;		
	}
	public function get_ten_lop($id){
		$this->db->where('ma_lop', $id);
		return $this->db->get('lop')->result()[0]->ten_lop;		
	}
	public function insert_sotheodoi($data){
		return $this->db->insert('so_theo_doi', $data);
	}
	public function delete_sotheodoi($data){
		$this->db->where('ma_theodoi', $data);
        return $this->db->delete('so_theo_doi');
	}
	public function update_sotheodoi($data){
		
		
		$this->db->where('sdt', $data['sdt']);
		$this->db->where('ngay', $data['ngay']);
		$this->db->where('ma_khoa', $data['ma_khoa']);
		$this->db->where('ma_mon', $data['ma_mon']);
		$this->db->where('ma_lop', $data['ma_lop']);
		$this->db->where('ma_buoi', $data['ma_buoi']);
		unset($data['sdt']);
		unset($data['ngay']);
		unset($data['ma_khoa']);
		unset($data['ma_mon']);
		unset($data['ma_lop']);
		unset($data['ma_buoi']);
		if (!isset($data['de_cuong'])) {
			$data['de_cuong'] = 0;
		}
		if (!isset($data['giao_an'])) {
			$data['giao_an'] = 0;
		}
		if (!isset($data['so_tay'])) {
			$data['so_tay'] = 0;
		}

		return $this->db->update('so_theo_doi', $data);
	}
	public function list_so_theo_doi($ngay=null,$sdt=null,$ma_khoa=null,$ma_mon=null,$ma_lop=null){
		if (isset($sdt)) {
			$this->db->where('sdt', $sdt);
			$this->db->where('ma_lop', $ma_lop);
			$this->db->where('ma_khoa', $ma_khoa);
			$this->db->where('ma_mon', $ma_mon);
			$this->db->like('ngay', $ngay);
		}
		//$this->db->get('so_theo_doi');
		//return $this->db->last_query();
		return $this->db->get('so_theo_doi')->result();
	}
	public function check_so_theo_doi($data){
		$this->db->where('ma_theodoi', $data);
		return $this->db->get('so_theo_doi')->num_rows();
	}
	public function check_so_theo_doi_2($ngay,$sdt,$ma_khoa,$ma_mon,$ma_lop,$ma_buoi){
		
		$this->db->where('ngay', $ngay);
		$this->db->where('sdt', $sdt);
		$this->db->where('ma_khoa', $ma_khoa);
		$this->db->where('ma_mon', $ma_mon);
		$this->db->where('ma_lop', $ma_lop);
		$this->db->where('ma_buoi', $ma_buoi);
		return $this->db->get('so_theo_doi')->num_rows();
	}
	public function get_so_theo_doi($ngay,$sdt,$ma_khoa,$ma_mon,$ma_lop,$ma_buoi){
		
		$this->db->where('ngay', $ngay);
		$this->db->where('sdt', $sdt);
		$this->db->where('ma_khoa', $ma_khoa);
		$this->db->where('ma_mon', $ma_mon);
		$this->db->where('ma_lop', $ma_lop);
		$this->db->where('ma_buoi', $ma_buoi);
		return $this->db->get('so_theo_doi')->result()[0];
	}
	public function get_so_theo_doi_2($data){
		$this->db->where('ma_theodoi', $data);
		return $this->db->get('so_theo_doi')->result()[0];
	}
	
}

/* End of file m_theo_doi.php */
/* Location: ./application/modules/theo_doi/models/m_theo_doi.php */