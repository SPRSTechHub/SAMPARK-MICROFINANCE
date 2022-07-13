<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Play extends CI_Controller {
    function __construct(){
		parent::__construct();
		$this->load->model('Query');
    }

	public function index()
	{
		$this->load->view('vidio');
  }

    public function share_vid()
    {
      $this->load->view('share_vid1');
      }
    
public function store_res(){
  $result = array();
  $rand = $this->input->post('rand');
  $store =  $this->query->updater(array('rand'=>$rand),array('status'=>'0'),'vid_link_tbl');
  if($store){
    $result['err']='1';
  }else{
    $result['err']='0';
  }
 
  echo json_encode($result);

}

function add_fcm(){
  $result=array();
  $fcm_key = $this->input->post('key');
  $mobile = $this->input->post('mobile');

  if(!empty($fcm_key)){
    
      $token_arr=array(
          'token'=>$fcm_key,
          'user'=>$mobile,
          'status'=>'1',
          'date'=>date('d-m-Y'),
      );

      $find_cust = $this->query->finder(array('token'=>$fcm_key), 'dg_adm_fcm_tbl');
      if($find_cust){
          $result['status']= 0;
          $result['msg']="Error, Token Exists!";
      }else{
          $add_customer = $this->query->insert($token_arr, 'dg_adm_fcm_tbl');
          if($add_customer){
              
              $result['status']= 1;
              $result['msg']="Details store Successfully";
          }else{
              $result['status']= 0;
              $result['msg']="Error,Try Again!";
          }
      }
  }else{
    $result['status']= 0;
    $result['msg']="Data Missing";
  }
  echo json_encode($result);
}

public function checking_tbl(){
  $msg = array();
  $emp_id= $this->input->post('emp_id');
  $emp_pass=$this->input->post('emp_pass');
  $userfind = $this->query->finder(array('emp_id' => $emp_id), 'emp_tbl');
  if($userfind){
    $emp_data = array(
      'emp_id'=>$emp_id,
      'emp_pass'=>$emp_pass,
      'status'=> '1',
    );
    $data_chk = $this->query->finder($emp_data, 'emp_tbl');
     if($data_chk){

    $this->session->set_userdata('ses_data',$data_chk->row());
    $msg['error'] = '0';
    $msg['status'] = 'Logged in Successfully';

     }else{
    $msg['error'] = '1';
    $msg['status'] ='incorrect password';
     }
  }else{
     $msg['error'] = '2';
     $msg['status'] ='create account to log in';
  }
  echo json_encode($msg);
}

function generate_link(){
  $result = array();
  $mobileno = $this->input->post('mobileno');
  $rand = $this->generateRandomString('10');
  $datar=array(
  'mobileno' => $mobileno,
  'rand'=>$rand,
  'status' => '1'
  );
  $store =  $this->query->insert($datar,'vid_link_tbl');
  if($store){
    $result['err']='100';
    $result['uri'] = $rand;
  }else{
    $result['err']='99';
  }
  echo json_encode($result);
}

public function gen_link(){
  $result = array();

  $mobileno = strip_tags($this->input->post('mobile'));
  $rand = $this->generateRandomString('10');
  if(!empty($mobileno)){
    $datar=array(
      'mobileno' => $mobileno,
      'rand'=>$rand,
      'status' => '1'
      );
      $store =  $this->query->insert($datar,'vid_link_tbl');
      $store = true;
      if($store){
        $result['errorcode']='100';
        $result['msg'] = 'Click this below link to view about us.';
        $result['linky'] = $rand;
      }else{
        $result['errorcode']='420';
        $result['msg'] = 'Link generate failed! Try after sometime.';
      }
  }else{
    $result['errorcode'] ='420';
    $result['msg'] ='Empty post on server!';
  }
  echo json_encode($result);
}

function generateRandomString($length) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function baal(){
$data['device_id']='fiOSmaGaQ8aNSTxAdEbfaa:APA91bEJDGTIhwoXiYgxi9lz1MY__lKS5085o5XSA9i_Dr0bp1RHwQG2YjlH7qFC8hb5uwIqXk-tJi43C-X4LvF9sfOH2pX1jY-QskAAFKHU5hfBigg5CpjJmzPP9ZdvVp8-mrnwApGo';
  $this->load->view('fcmboard',$data);
}

public function sendNotify($device_id, $message){
if(!empty($device_id)){
  $cont = '<script>';
  $cont .= 'var url = "https://fcm.googleapis.com/fcm/send";';
  $cont .= 'var xhr = new XMLHttpRequest();';
  $cont .= 'xhr.open("POST", url);';
  $cont .= 'xhr.setRequestHeader("Content-Type", "application/json,");';
  $cont .= 'xhr.setRequestHeader("Authorization", "key=AAAAKE0Y9Nk:APA91bHRAerJRUkhyHk8ftUb6vUB2L02au3W0yVBLa6ZoK5MK3fDz6pMwQOIrZKAc7R5_zD_dJJfyeZx6YdY5akoTERv1XJ4jJcNL3FMXtC4u4Lj5KLGVb65MD6B9PuIxW3fm523viKO");';
  $cont .= 'xhr.onreadystatechange = function () {if (xhr.readyState === 4) {return xhr.responseText;}};';
  $cont .="var data = '".'{"registration_ids":["'.$device_id.'"],"notification": {"body": "'.$message.'","title": "DestiniGo","android_channel_id": "destinigo_admin"}}'."';";
  $cont .= 'xhr.send(data);</script>';
  return $cont;
}else{
  return false;
}
}

///////////////////////////////////



function push_notification_php() {

  $device_token = 'fiOSmaGaQ8aNSTxAdEbfaa:APA91bEJDGTIhwoXiYgxi9lz1MY__lKS5085o5XSA9i_Dr0bp1RHwQG2YjlH7qFC8hb5uwIqXk-tJi43C-X4LvF9sfOH2pX1jY-QskAAFKHU5hfBigg5CpjJmzPP9ZdvVp8-mrnwApGo';
  $message = 'ssss';
  /* API URL */
  $url = 'https://fcm.googleapis.com/fcm/send';

  /* authorization_key */
  $authorization_key = 'AAAAKE0Y9Nk:APA91bHRAerJRUkhyHk8ftUb6vUB2L02au3W0yVBLa6ZoK5MK3fDz6pMwQOIrZKAc7R5_zD_dJJfyeZx6YdY5akoTERv1XJ4jJcNL3FMXtC4u4Lj5KLGVb65MD6B9PuIxW3fm523viKO';

  $fields = array(
      'registration_ids' => array($device_token),
      'data' => array (
          "message" => $message
      )
  );
  $fields = json_encode($fields);

  $headers = array (
    'Authorization: key= AAAAKE0Y9Nk:APA91bHRAerJRUkhyHk8ftUb6vUB2L02au3W0yVBLa6ZoK5MK3fDz6pMwQOIrZKAc7R5_zD_dJJfyeZx6YdY5akoTERv1XJ4jJcNL3FMXtC4u4Lj5KLGVb65MD6B9PuIxW3fm523viKO',
    'Content-Type: application/json'
    );

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

  $result = curl_exec($ch);
  echo $result;
  curl_close($ch);
}


















}


?>


