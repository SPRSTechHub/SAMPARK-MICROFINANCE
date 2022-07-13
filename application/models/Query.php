<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Query extends CI_Model{

  function __construct(){
			parent::__construct();
			$this->load->database(); 
  }

  public function get_meta($param, $tbl, $result){
    $this->db->select('*');
    $this->db->from($tbl);
    $this->db->where($param);
    $query = $this->db->get();
    
    if($query->num_rows()>0){
    return $query->row()->$result;
    }else{
    return false;
    }
    }

public function finder($param, $tbl){
$this->db->select('*');
$this->db->from($tbl);
$this->db->where($param);
$query = $this->db->get();

if($query->num_rows()>0){
return $query;
}else{
return false;
}
}
public function getuser($param){
  $this->db->select('*');
  $this->db->from('user_tvl');
  $this->db->where($param);
  $query = $this->db->get();
  if($query->num_rows()>0){
  return $query;
  }else{
  return false;
  }
  }

public function get_referals($param){
      $this->db->select('user_tvl.userid, member_tvl.member_code, member_tvl.doa, member_tvl.dor, member_tvl.price, member_tvl.status, user_tvl.f_name, user_tvl.l_name, user_tvl.email, user_tvl.mobile, user_tvl.sponserid, user_tvl.sponser_name');
      $this->db->from('member_tvl');
      $this->db->join('user_tvl', 'user_tvl.userid = member_tvl.userid');
      $this->db->where('user_tvl.sponserid',$param);
      $query=$this->db->get();
      if($query->num_rows()>0){
      return $query;
      }else{
      return false;
      }
  }

  public function get_ref($param){
    $this->db->select('*');
    $this->db->from('user_tvl');
    $this->db->where('userid',$param);
    $query  = $this->db->get();
    
    if($query->num_rows()>0){
    return $query->row()->sponserid;
    }else{
    return false;
    }
    }

    public function getlevelamount($param){
      $this->db->select('*');
      $this->db->from('bonus_level_tbl');
      $this->db->where('level',$param);
      $query  = $this->db->get();
      
      if($query->num_rows()>0){
      return $query->row()->amount;
      }else{
      return false;
      }
      }

  public function tot_referals($param){
    $this->db->select('*');
    $this->db->from('user_tvl');
    $this->db->where('sponserid',$param);
    $query  = $this->db->get();
    
    if($query->num_rows()>0){
    return $query;
    }else{
    return false;
    }
  } 

    public function act_referals($param){
      $this->db->select('user_tvl.userid, member_tvl.member_code, member_tvl.doa, member_tvl.dor, member_tvl.price, member_tvl.status, user_tvl.f_name, user_tvl.l_name, user_tvl.email, user_tvl.mobile, user_tvl.sponserid, user_tvl.sponser_name');
      $this->db->from('member_tvl');
      $this->db->where('member_tvl.status','1');
      $this->db->join('user_tvl', 'user_tvl.userid = member_tvl.userid');
      $this->db->where('user_tvl.sponserid',$param);
      $query=$this->db->get();
      if($query->num_rows()>0){
      return $query;
      }else{
      return false;
      }
    }

  public function checkMember($userid){
    $this->db->select('*');
    $this->db->from('member_tvl');
    $this->db->where('userid',$userid);
    $query  = $this->db->get();
    if($query->num_rows()>0){
    return $query->row();
    }else{
    return false;
    }
  }

public function getlastid(){
  $query=$this->db->select('*')->order_by('id',"desc")->limit(1)->get('game_tbl');
  if($query->num_rows()>0){
  return $query->row()->userid;
  }else{
  return false;
  } 
}

public function duplicate_finder($param, $tbl){
  $this->db->select('*');
  $this->db->from($tbl);
  $this->db->where($param);
  $query = $this->db->get();

  if($query->num_rows()>0){
  return true;
  }else{
  return false;
  }
}
public function getQuery($code){
  $query = $this->db->query($code, FALSE);
  if($query->num_rows()>0){
  return $query;
  }else{
  return false;
  }
}
public function updater($type,$user_data, $tbl){
  $update = $this->db->update($tbl, $user_data, $type);
    if($update){
      return true;
    } else {
      return false;
    }
  }

  public function replace($where,$param, $tbl){
    $this->db->set($param);
    $this->db->where($where);
    $this->db->update($tbl);
  }

 public function Nibedita_store_koro($storekikorbo, $kothayekorbo){ 
  $insert = $this->db->insert($kothayekorbo,$storekikorbo);
       if($insert){
              return true;
       }else{
            return false;
        }
}

public function insert($param, $table){ 
  $insert = $this->db->insert($table,$param);
       if($insert){
              return true;
       }else{
            return false;
        }
}

public function delete($param, $tbl){
  $deleter = $this->db->delete($tbl,$param);

    if($deleter){
      return true;
    }else{
      return false;
    }
}

public function get_count($param1, $param2 = NULL){

$this->db->select('*');
$this->db->from($param1);

if(!empty($param2)){
  $this->db->where($param2);
}
$query  = $this->db->get();
if($query->num_rows()>0){
return $query;
}else{
return false;
}
}

public function getStatelist(){
  $this->db->select('*');
  $this->db->from('state_tbl');
  $this->db->where('country_code','IN');
  $query  = $this->db->get();
  
  if($query->num_rows()>0){
  return $query->result();
  }else{
  return false;
  }
  }

  public function getBanklist(){
    $this->db->select('*');
    $this->db->from('bank_tbl');
    $this->db->where('status','1');
    $query  = $this->db->get();
    
    if($query->num_rows()>0){
    return $query->result();
    }else{
    return false;
    }
    }

    public function get_wallet_amount($param, $tbl){
      $this->db->select_sum('amount');
      $this->db->where($param);
     //	$this->db->where('date >=', $from);
     //	$this->db->where('date <=', $to);
      $result = $this->db->get($tbl);
       if($result->num_rows() > 0){
        return $result->row()->amount;
                  }else{
              return 0;
          }
    }

    public function get_wallet_m_amount($param, $tbl){
      $this->db->select_sum('m_amount');
      $this->db->where($param);
     //	$this->db->where('date >=', $from);
     //	$this->db->where('date <=', $to);
      $result = $this->db->get($tbl);
       if($result->num_rows() > 0){
        return $result->row()->m_amount;
                  }else{
              return 0;
          }
    }


}