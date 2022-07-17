<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function getcust_code($params)
  {
    $this->db->select('cust_code');
    $this->db->from('cust_tbl');
    $this->db->where($params);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->row()->cust_code;
    } else {
      return false;
    }
  }

  public function countofloan($param)
  {
    $this->db->select('*');
    $this->db->from('loan_tbl');
    $this->db->where('cust_code', $param);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return false;
    }
  }

  public function get_meta($param, $tbl, $result)
  {
    $this->db->select('*');
    $this->db->from($tbl);
    $this->db->where($param);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->row()->$result;
    } else {
      return false;
    }
  }

  public function count($param1, $param2 = NULL)
  {
    $this->db->select('*');
    $this->db->from($param1);
    if (!empty($param2)) {
      $this->db->where($param2);
    }
    $query  = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query;
    } else {
      return false;
    }
  }

  public function finder($param, $tbl)
  {
    $this->db->select('*');
    $this->db->from($tbl);
    $this->db->where($param);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query;
    } else {
      return false;
    }
  }

  public function pendings($loan_no)
  {
    $where = array(
      'loan_no' => $loan_no,
      'status' => 0,
      'emi_date <=' => date('d-m-Y')
    );

    $this->db->select('*');
    $this->db->from('emi_tbl');
    $this->db->where($where);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query;
    } else {
      return false;
    }
  }


  public function nullCheck($fieldName, $param, $tbl)
  {
    $this->db->select('*');
    $this->db->from($tbl);
    $this->db->where($fieldName . ' is NOT NULL', NULL, FALSE);
    $this->db->where($param);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query;
    } else {
      return false;
    }
  }

  public function emiStatReport($param)
  {

    $this->db->select('*, COUNT(id) as EMC,SUM(emi_amount) as EMA ');
    $this->db->from('emi_tbl');
    $this->db->where($param);

    /* // $this->db->join('cust_docs', 'cust_docs.cust_code = cust_tbl.cust_code', 'left');
    $this->db->join('loan_tbl', 'loan_tbl.cust_code = cust_tbl.cust_code', 'right');
     */
    $this->db->group_by('status');
    $this->db->order_by('emi_date', 'asc');
    $query = $this->db->get();
    if ($query) {
      return $query;
    } else {
      return false;
    }
  }

  public function getalldata()
  {/* 
    $this->db->select('*');
    $this->db->from('cust_tbl');
    // $this->db->join('cust_docs', 'cust_docs.cust_code = cust_tbl.cust_code', 'left');
    $this->db->join('loan_tbl', 'loan_tbl.cust_code = cust_tbl.cust_code', 'right');
    $this->db->group_by('cust_tbl.cust_code');
    $this->db->order_by('cust_tbl.id', 'asc');
    $query = $this->db->get();
   */
    $this->db->from('cust_tbl');
    $this->db->join('cust_docs', 'cust_tbl.cust_code = cust_docs.cust_code', 'left');
    $this->db->join('loan_tbl', 'cust_tbl.cust_code = loan_tbl.cust_code', 'left');
    $query = $this->db->get();
    if ($query) {
      return $query->result_array();
    } else {
      return false;
    }
  }


  public function mixedfinder($param, $tbl, $tbl1)
  {
    $this->db->from($tbl);
    $this->db->where($param);
    // $this->db->join('cust_docs', 'cust_tbl.cust_code = cust_docs.cust_code', 'left');
    $this->db->join($tbl1, 'cust_tbl.cust_code = loan_tbl.cust_code', 'left');
    $query = $this->db->get();
    if ($query) {
      return $query->result();
    } else {
      return false;
    }
  }

  public function get_docs($search, $param, $tbl)
  {
    $this->db->select('*');
    $this->db->from($tbl);
    $this->db->where($param);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->row()->$search;
    } else {
      return false;
    }
  }

  public function get_docs_all($param, $tbl)
  {
    $this->db->select('*');
    $this->db->from($tbl);
    $this->db->where($param);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query;
    } else {
      return false;
    }
  }

  public function getuser($param)
  {
    $this->db->select('*');
    $this->db->from('user_tvl');
    $this->db->where($param);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query;
    } else {
      return false;
    }
  }

  public function getlastid()
  {
    $query = $this->db->select('*')->order_by('id', "desc")->limit(1)->get('game_tbl');
    if ($query->num_rows() > 0) {
      return $query->row()->userid;
    } else {
      return false;
    }
  }

  public function duplicate_finder($param, $tbl)
  {
    $this->db->select('*');
    $this->db->from($tbl);
    $this->db->where($param);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }
  public function getQuery($code)
  {
    $query = $this->db->query($code, FALSE);
    if ($query->num_rows() > 0) {
      return $query;
    } else {
      return false;
    }
  }
  public function updater($type, $user_data, $tbl)
  {
    $update = $this->db->update($tbl, $user_data, $type);
    if ($update) {
      return true;
    } else {
      return false;
    }
  }

  public function replace($where, $param, $tbl)
  {
    $this->db->set($param);
    $this->db->where($where);
    $this->db->update($tbl);
  }

  public function Nibedita_store_koro($storekikorbo, $kothayekorbo)
  {
    $insert = $this->db->insert($kothayekorbo, $storekikorbo);
    if ($insert) {
      return true;
    } else {
      return false;
    }
  }

  public function insert($param, $table)
  {
    $insert = $this->db->insert($table, $param);
    if ($insert) {
      return true;
    } else {
      return false;
    }
  }

  function multiInsert($data, $tbl)
  {

    $query = $this->db->insert_batch($tbl, $data);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }
  public function delete($param, $tbl)
  {
    $deleter = $this->db->delete($tbl, $param);

    if ($deleter) {
      return true;
    } else {
      return false;
    }
  }

  public function getStatelist()
  {
    $this->db->select('*');
    $this->db->from('state_tbl');
    $this->db->where('country_code', 'IN');
    $query  = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

  public function getBanklist()
  {
    $this->db->select('*');
    $this->db->from('bank_tbl');
    $this->db->where('status', '1');
    $query  = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

  public function get_wallet_amount($param, $tbl)
  {
    $this->db->select_sum('amount');
    $this->db->where($param);
    //	$this->db->where('date >=', $from);
    //	$this->db->where('date <=', $to);
    $result = $this->db->get($tbl);
    if ($result->num_rows() > 0) {
      return $result->row()->amount;
    } else {
      return 0;
    }
  }

  public function get_wallet_m_amount($param, $tbl)
  {
    $this->db->select_sum('m_amount');
    $this->db->where($param);
    //	$this->db->where('date >=', $from);
    //	$this->db->where('date <=', $to);
    $result = $this->db->get($tbl);
    if ($result->num_rows() > 0) {
      return $result->row()->m_amount;
    } else {
      return 0;
    }
  }
}