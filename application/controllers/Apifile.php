<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Kolkata");
class Apifile extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('api');
        //$this->output->enable_profiler(TRUE);
    }

    function authchecker()
    {
        $result = array();
        $data = $this->input->post();
        $action = $this->input->post('action');
        if ((array_key_exists('action', $data)) !== false) {
            unset($data['action']);
        }
        $token = str_replace('"', '', $this->input->post('token'));
        if (!empty($token)) {
            $result['status'] = 1;
            $result['msg'] = 'Success'; //'Pls update your app from ${vLocal} to ${vWeb}'
            $result['data'] = array('app_version' => '1.0.5', 'updateUrl' => 'https://github.com/SPRSTechHub/');
        } else {
            $result['status'] = null;
            $result['msg'] = null;
            $result['data'] = null;
        }
        header('Access-Control-Allow-Origin: *', 'Content-Type: application/json; charset=utf-8');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    function login()
    {
        $result = array();
        $mobileno = $this->input->post('mobileno');
        $password = $this->input->post('password');
        $fcmKey = $this->input->post('fcmKey');

        $userfind = $this->query->finder(array('mobileno' => $mobileno, 'password' => $password), 'login_tbl');
        if ($userfind) {
            $user_find = $this->query->finder(array('mobile' => $mobileno), 'agent_tbl');
            $result['status'] = 1;
            $result['msg'] = "Login Successfully";
            $result['data'] = array($user_find->row());
        } else {
            $result['status'] = 0;
            $result['msg'] = "Crediental does not match please check mobille number or password";
            $result['data'] = array();
        }
        echo json_encode($result);
    }

    function chkCustomer()
    {
        $result = array();
        $data = $this->input->post();
        $action = $this->input->post('action');
        if ((array_key_exists('action', $data)) !== false) {
            unset($data['action']);
        }
        $mobile = str_replace('"', '', $this->input->post('mobile'));
        if (!empty($mobile)) {
            $row = array();
            $getCust = $this->api->finder(array('mobile' => $mobile), 'cust_tbl');
            if (!empty($getCust)) {
                $getCust = $getCust->row();
                $getCust_img = $this->api->get_docs('profile', array('cust_code' => $getCust->cust_code), 'cust_docs');
                $getCust_img = (!empty($getCust_img)) ? $getCust_img : 'default/nofile.png';

                $row = $getCust;
                $row->img = base_url() . 'uploads/' . $getCust_img;
                $result['status'] = 1;
                $result['msg'] = "1 Customer found!";
                $result['data'] = $row;
            } else {

                $result['status'] = 0;
                $result['msg'] = "Error, Customer not Exists!";
                $result['data'] = null;
            }
        } else {
            $result['status'] = 0;
            $result['msg'] = "Error, Customer not Exists!";
            $result['data'] = null;
        }
        header('Access-Control-Allow-Origin: *', 'Content-Type: application/json; charset=utf-8');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    function getCustomer()
    {
        $result = array();
        $data = $this->input->post();
        $action = $this->input->post('action');
        if ((array_key_exists('action', $data)) !== false) {
            unset($data['action']);
        }

        $mobile = str_replace('"', '', $this->input->post('mobile'));
        if (!empty($mobile)) {
            $row = array();
            $getCust = $this->api->finder(array('mobile' => $mobile), 'cust_tbl');
            if (!empty($getCust)) {
                $getCust = $getCust->row();
                //$getCust_img = $this->api->get_docs('profile', array('cust_code' => $getCust->cust_code), 'cust_docs');
                //$getCust_img = (!empty($getCust_img)) ? $getCust_img : 'default/nofile.png';

                $getDocs = $this->api->get_docs_all(array('cust_code' => $getCust->cust_code), 'cust_docs');
                if ($getDocs) {
                    foreach ($getDocs->result() as $rowdata) {
                        $docs = array('profile' => $rowdata->profile ? base_url() . 'uploads/' . $rowdata->profile : base_url() . 'uploads/default/nofile.png', 'pan' => $rowdata->pan ? base_url() . 'uploads/' . $rowdata->pan : base_url() . 'uploads/default/nofile.png', 'adhaar' => $rowdata->adhaar ? base_url() . 'uploads/' . $rowdata->adhaar : base_url() . 'uploads/default/nofile.png');
                    }
                } else {
                    $docs = array(
                        'profile' => base_url() . 'uploads/default/nofile.png', 'pan' => base_url() . 'uploads/default/nofile.png', 'adhaar' => base_url() . 'uploads/default/nofile.png'
                    );
                }

                $row = $getCust;
                //$row->img = base_url() . 'uploads/' . $getCust_img;
                $result = array('status' => 1, 'msg' => "1 Customer found!");
                $result['data'][] =  $docs;  //$row;
            } else {
                $result['status'] = 0;
                $result['msg'] = "Error, Customer not Exists!";
                $result[] = array('data' => null);
            }
        } else {
            $result[] = array(
                'status' => 0,
                'msg' => "Error, Customer not Exists!",
                'data' => null
            );
        }
        header('Access-Control-Allow-Origin: *', 'Content-Type: application/json; charset=utf-8');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function add_cust()
    {
        $result = array();
        $f_name = $this->input->post('f_name');
        $l_name = $this->input->post('l_name');
        $mobile = $this->input->post('mobile');
        $alt_mob = $this->input->post('alt_mob');
        $address = $this->input->post('address');
        $gender = $this->input->post('gender');
        $dob = $this->input->post('dob');

        $cust_code_count = $this->api->count('cust_tbl', '');
        $cust_code_count = !empty($cust_code_count) ? $cust_code_count->num_rows() : '0';
        $cust_code =  'MDC' . substr($mobile, -4) . date('dm') . $cust_code_count;

        if (!empty($f_name) || !empty($mobile) || !empty($cust_code)) {

            $cust_arr = array(
                'cust_code' => $cust_code,
                'mobile' => $mobile,
                'f_name' => $f_name,
                'l_name' => $l_name,
                'alt_mob' => $alt_mob,
                'address' => $address,
                'gender' => $gender,
                'dob' => $dob,
                'status' => '1',
                'date' => date('d-m-Y'),
            );

            $find_cust = $this->api->finder(array('mobile' => $mobile), 'cust_tbl');
            if ($find_cust) {
                $result['status'] = 0;
                $result['msg'] = "Error, Customer Exists!";
            } else {
                $add_customer = $this->api->insert($cust_arr, 'cust_tbl');
                if ($add_customer) {
                    $this->addCbil($cust_code);
                    $result['status'] = 1;
                    $result['ccode'] = $cust_code;
                    $result['msg'] = "Details store Successfully";
                } else {
                    $result['status'] = 0;
                    $result['msg'] = "Error,Try Again!";
                }
            }
        } else {
            $result['status'] = 0;
            $result['msg'] = "Data Missing";
        }
        header('Access-Control-Allow-Origin: *', 'Content-Type: application/json; charset=utf-8');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function add_cust_loan()
    {
        $result = array();
        $purpose = $this->input->post('purpose');
        $mobile = $this->input->post('mobile');
        $cust_code = $this->input->post('cust_code');
        $loan_date = $this->input->post('loan_date');
        $loan_amnt = $this->input->post('loan_amnt');
        $emi_amnt = $this->input->post('emi_amnt');
        $tenure = $this->input->post('tenure');

        $count_data = $this->api->count('loan_tbl', '');
        $count_data = !empty($count_data) ? $count_data->num_rows() : '0';
        $loan_no =  'MDL' . substr($mobile, -4) . date('dm') . $count_data;

        if (!empty($mobile) || !empty($tenure) || !empty($emi_amnt)) {
            $loan_arr = array(
                'cust_code' => $cust_code,
                'loan_no' => $loan_no,
                'loan_date' => $loan_date,
                'loan_amnt' => $loan_amnt,
                'total_amnt' => $emi_amnt * $tenure,
                'emi_amnt' => $emi_amnt,
                'emi_count' => $tenure,
                'purpose' => $purpose,
                'tenure' => $tenure,
                'status' => '1',
                'date' => date('d-m-Y'),
            );

            $find_loan = $this->api->finder(array('cust_code' => $mobile, 'date' => date('d-m-Y')), 'loan_tbl');
            if ($find_loan) {
                $result['status'] = 0;
                $result['msg'] = "Error, Loan Exists!";
            } else {
                $add_customer = $this->api->insert($loan_arr, 'loan_tbl');
                if ($add_customer) {
                    $result['status'] = 1;
                    $result['lcode'] = $loan_no;
                    $result['msg'] = "Details store Successfully";
                } else {
                    $result['status'] = 0;
                    $result['msg'] = "Error,Try Again!";
                }
            }
        } else {
            $result['status'] = 0;
            $result['msg'] = "Data Missing";
        }
        header('Access-Control-Allow-Origin: *', 'Content-Type: application/json; charset=utf-8');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    /*   function add_loan()
    {
        $result = array();
        $mobileno = str_replace('"', '', $this->input->post('mobileno'));
        $loan_amnt = str_replace('"', '', $this->input->post('loan_amnt'));
        $total_amnt = str_replace('"', '', $this->input->post('total_amnt'));
        $purpose = str_replace('"', '', $this->input->post('purpose'));
        $cust_code = str_replace('"', '', $this->input->post('cust_code'));

        $cust_arr = array(
            'mobileno' => $mobileno,
            'loan_amnt' => $loan_amnt,
            'total_amnt' => $total_amnt,
            'purpose' => $purpose,
            'cust_code' => $cust_code,
            'status' => '1',
            'date' => date('Y-m-d'),
        );

        if (!empty($f_name) || !empty($mobile) || !empty($cust_code)) {
            $user_find = $this->query->insert($cust_arr, 'loan_tbl');
            if ($user_find) {
                $result['status'] = 1;
                $result['msg'] = "Details store Successfully";
                $result['data'] = array($user_find->row());
            } else {
                $result['status'] = 0;
                $result['msg'] = "Error,Try Again!";
                $result['data'] = array();
            }
        } else {
            $result['status'] = 0;
            $result['msg'] = "Error,Try Again!";
            $result['data'] = array();
        }
        header('Access-Control-Allow-Origin: *', 'Content-Type: application/json; charset=utf-8');
        echo json_encode($result, JSON_PRETTY_PRINT);
    } */

    public function getAllCustomers()
    {
        $result = array();
        $all_customers = $this->api->getalldata();
        if ($all_customers) {
            foreach ($all_customers as $row_value) {
                $row[] = array(
                    'Name' => $row_value['f_name'] . ' ' . $row_value['l_name'],
                    'mobile' => $row_value['mobile'],
                    'img_link' => (!empty($row_value['profile'])) ? $row_value['profile'] : 'default/nofile.png',
                    'loanAmnt' => $row_value['loan_amnt'] != null ? $row_value['loan_amnt'] : '0',
                    'emiAmnt' => $row_value['emi_amnt'],
                    'cstatus' => $row_value['loan_amnt'] != null ? 'Y' : 'N',
                );
            }
            $result = array('status' => 1, 'msg' => "1 Customer found!");
            $result['data'] = $row;
        } else {
            $result['status'] = 0;
            $result['msg'] = "Error, Customer not Exists!";
            $result[] = array('data' => null);
        }
        header('Access-Control-Allow-Origin: *', 'Content-Type: application/json; charset=utf-8');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    function getPendingEmi()
    {
        $result = array();
        $response = array();
        $data = $this->input->post();
        //$data = array('emp_code' => 'SMERR09', 'loan_no' => 'MDL454515063');
        //date = 'd-m-Y';

        $emilist = $this->pendingEMI($data['loan_no']);
        if ($emilist) {
            $response['status'] = 1;
            $response['msg'] = "Fetched Emi List!";
            $response['data'] = $emilist['emis'];
        } else {
            $response['status'] = 0;
            $response['msg'] = "No pending emi found!";
        }

        header('Access-Control-Allow-Origin: *', 'Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    function checkEmi()
    {
        $response = array();
        $searchData = '1234567890';
        $ext_data = $this->checkData($searchData);
        //   print_r($ext_data);
        if ($ext_data) {
            if ($ext_data['data_type'] == 'loan_no') {
                $getLoanD = $this->api->finder(array($ext_data['data_type'] => $ext_data['data'], 'status' => 1), 'loan_tbl');
                if ($getLoanD) {
                    $getCust =  $this->api->finder(array('cust_code' => $getLoanD->row()->cust_code), 'cust_tbl');
                    $response['custdetails'] = !empty($getCust) ? $getCust->row() : false;
                    $response['loandetails'] = $getLoanD->row();
                    $response['emidetails'] = $this->emiStatReport($getLoanD->row()->loan_no);
                } else {
                    $response['loandata'] = 'no data!';
                }
            } elseif ($ext_data['data_type'] == 'cust_code') {
                $getLoanD = $this->api->finder(array($ext_data['data_type'] => $ext_data['data'], 'status' => 1), 'loan_tbl');
                if ($getLoanD) {
                    $getCust =  $this->api->finder(array('cust_code' => $getLoanD->row()->cust_code), 'cust_tbl');
                    $response['custdetails'] = !empty($getCust) ? $getCust->row() : false;
                    $response['loandetails'] = $getLoanD->row();
                    $response['emidetails'] = $this->emiStatReport($getLoanD->row()->loan_no);
                } else {
                    $response['loandata'] = 'no data!';
                }
            } elseif ($ext_data['data_type'] == 'mobile') {
                $getCustCode = $this->api->getcust_code(array('mobile' => $ext_data['data']));
                $getLoanD = $this->api->finder(array('cust_code' => $getCustCode, 'status' => 1), 'loan_tbl');
                if ($getLoanD) {
                    $getCust =  $this->api->finder(array('cust_code' => $getLoanD->row()->cust_code), 'cust_tbl');
                    $response['custdetails'] = !empty($getCust) ? $getCust->row() : false;
                    $response['loandetails'] = $getLoanD->row();
                    $response['emidetails'] = $this->emiStatReport($getLoanD->row()->loan_no);
                } else {
                    $response['loandata'] = 'no data!';
                }
            }
        }
        header('Access-Control-Allow-Origin: *', 'Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function add_cust_image()
    {
        $result = array();
        $data = $this->input->post();
        $action = $this->input->post('action');
        if ((array_key_exists('action', $data)) !== false) {
            unset($data['action']);
        }

        $chkCust = $this->api->finder(array('cust_code' => $this->input->post('id')), 'cust_tbl');
        if ($chkCust) {
            // cust alive!
            $fileStore = $this->upload_image('image');
            if (!empty($fileStore)) {
                $chkImg = $this->api->finder(array('cust_code' => $this->input->post('id')), 'cust_docs');
                if (!empty($chkImg)) {
                    $add_img_data = $this->api->updater(array('cust_code' => $this->input->post('id')), array('profile' => $fileStore), 'cust_docs');
                } else {
                    $add_img_data = $this->api->insert(array('cust_code' => $this->input->post('id'), 'profile' => $fileStore), 'cust_docs');
                }
                $data['img_url'] = $fileStore;
                $result['status'] = 1;
                $result['msg'] = "Image uploaded Successfully";
            } else {
                $data['img_url'] = '';
                $result['status'] = 0;
                $result['msg'] = "Image upload Error!";
            }
        } else {
            $data['img_url'] = '';
            $result['status'] = 0;
            $result['msg'] = "Customer not in our system!";
        }

        header('Access-Control-Allow-Origin: *', 'Content-Type: application/json; charset=utf-8');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function add_cust_docs()
    {
        $result = array();
        $data = $this->input->post();
        $cust_code = $this->input->post('cust_code');
        $doc_type = $this->input->post('doc_type');
        if ((array_key_exists('action', $data)) !== false) {
            unset($data['action']);
        }

        if (empty($doc_type) || empty($cust_code) || empty($this->input->post('doc_no'))) {
            $data['img_url'] = '';
            $result['status'] = 0;
            $result['msg'] = "missing details!";
        } else {
            $chkCust = $this->api->finder(array('cust_code' => $cust_code), 'cust_tbl');
            if ($chkCust) {
                $fileStore = $this->upload_docs('image');
                $add_docno = $this->api->updater(array('cust_code' => $cust_code), array($doc_type . 'no' => $data['doc_no']), 'cust_tbl');
                $add_img_data = $this->api->updater(array('cust_code' => $cust_code), array($doc_type . 'no' => $data['doc_no'], $doc_type => $fileStore), 'cust_docs');
                $data['img_url'] = $fileStore;
                $result['status'] = '1';
                $result['msg'] = 'Image replaced Successfully';
            } else {
                $data['img_url'] = '';
                $result['status'] = 0;
                $result['msg'] = "Customer not in our system!";
            }
        }

        header('Access-Control-Allow-Origin: *', 'Content-Type: application/json; charset=utf-8');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    function upload_image($param)
    {
        if (isset($_FILES[$param])) {
            $extension = explode('.', $_FILES[$param]['name']);
            $new_name = rand() . '.' . $extension[1];
            $destination = 'uploads/' . $new_name;
            move_uploaded_file($_FILES[$param]['tmp_name'], $destination);
            return $new_name;
        } else {
            return false;
        }
    }

    function upload_docs($param)
    {
        if (isset($_FILES[$param])) {
            $extension = explode('.', $_FILES[$param]['name']);
            $new_name = rand() . '.' . $extension[1];
            $destination = 'uploads/docs/' . $new_name;
            move_uploaded_file($_FILES[$param]['tmp_name'], $destination);
            return $new_name;
        } else {
            return false;
        }
    }

    function fcmKey()
    {
        $result   = array();
        $mobileno = $this->input->post('mobileno');
        $fcm_id   = $this->input->post('fcm_id');
        if ($mobileno == '' || $fcm_id == '') {
            $result['status'] = 0;
            $result['msg']    = "Empty param !";
            $result['data']   = array();
        } else {
            $chk_fcm = $this->query->finder(array('fcm_id' => $fcm_id), 'fcm_tbl');
            if ($chk_fcm) {
                $result['status'] = 0;
                $result['msg']    = "Already Stored .";
            } else {
                $userfind = $this->query->insert(array('mobileno' => $mobileno, 'fcm_id' => $fcm_id, 'status' => '1', 'date' => date('Y-m-d')), 'fcm_tbl');
                if ($userfind) {
                    $result['status'] = 1;
                    $result['msg']    = "Date insert Successfully";
                } else {
                    $result['status'] = 0;
                    $result['msg']    = "Error!";
                }
            }
        }
        header('Access-Control-Allow-Origin: *', 'Content-Type: application/json; charset=utf-8');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    function getcats()
    {
        $result = array();
        $row = array();
        $query = $this->db->get('cats_data');

        if ($query) {
            foreach ($query->result_array() as $rowdata) {
                $row[] = array(
                    "id" => $rowdata['id'],
                    "cat_title" => $rowdata['cat_title'],
                    "cat_id" => $rowdata['cat_id'],
                    "cat_img" => $rowdata['cat_img']
                );
            }
        }

        $result = $row;
        header('Access-Control-Allow-Origin: *', 'Content-Type: application/json; charset=utf-8');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    function fetch_cibil()
    {
        $result = array();
        $row = array();
        $data = $this->input->post();

        if ((array_key_exists('action', $data)) !== false) {
            unset($data['action']);
        }

        $cust_code = $this->api->getcust_code(array($data['checkby'] => $data['dataval']));
        if ($cust_code) {
            $docs = $this->DocsStatus($cust_code);

            $loan_count = $this->api->countofloan($cust_code);
            $loan_count = $loan_count ? array('count' => $loan_count) : array('count' => '0');
            $getCBIL = $this->api->finder(array('cust_code' => $cust_code), 'cibil_score');
            $getCBIL = $getCBIL ? array('cbil' => round(($getCBIL->row()->score_val), 2)) : array('cbil' => 0);
        } else {
            $result = null;
        }

        $result = array_merge($docs, $loan_count, $getCBIL);

        header('Access-Control-Allow-Origin: *', 'Content-Type: application/json; charset=utf-8');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    function DocsStatus($cust_code)
    {
        $getDocs = $this->api->get_docs_all(array('cust_code' => $cust_code), 'cust_docs');
        if ($getDocs) {
            foreach ($getDocs->result() as $rowdata) {
                $docs = array('profile_url' => $rowdata->profile ? base_url() . 'uploads/' . $rowdata->profile : base_url() . 'uploads/default/nofile.png', 'profile' => $rowdata->profile ? '1' : '0', 'pan' => $rowdata->panno ? '1' : '0', 'adhaar' => $rowdata->adhaarno ? '1' : '0');
            }
            return $docs;
        } else {
            return false;
        }
    }

    public function addCbil($cust_code)
    {
        $exists = $this->api->finder(array('cust_code' => $cust_code), 'cibil_score');
        if ($exists) {
            $this->api->updater(array('cust_code' => $cust_code), array('cust_code' => $cust_code, 'score_val' => 0), 'cibil_score');
        } else {
            $this->api->insert(array('cust_code' => $cust_code, 'score_val' => 0), 'cibil_score');
        }
        return true;
    }

    // Generate a random character string
    function rand_str($length = 8, $chars = '')
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }

    function insertEmi()
    {

        $data = $this->emicalc(array('loan_no' => 'MDL764315062', 'loandate' => '25-03-2022', 'loanamount' => '15000', 'tennure' => '24'));
        $resp = $this->api->multiInsert($data, 'emi_tbl');

        header('Access-Control-Allow-Origin: *', 'Content-Type: application/json; charset=utf-8');
        print_r(json_encode($resp, JSON_PRETTY_PRINT));
    }

    function emicalc($params)
    {
        $result = array();
        $emicount = array();

        $loandate = $params['loandate'];
        $loan_amount = $params['loanamount'];
        $tennure = $params['tennure'];
        $interest =  round((($loan_amount * 0.1) * ($tennure / 4)), 2);
        $emi = round(($loan_amount + $interest) / $tennure, 2);
        $emi = $emi;

        for ($i = 0; $i <= 24; $i++) {
            $loandate = date("d-m-Y", strtotime("+7 days", strtotime($loandate)));
            $emicount[] = array(
                'loan_no' => $params['loan_no'],
                'emi_date' => $loandate,
                'emi_amount' => $emi,
                'bal_amount' => round(($loan_amount + $interest) - ($emi * $i), 0),
                'loan_amount' => $loan_amount,
                'emi_id' => $this->rand_str(8),
                'status' => 0,
            );
        }

        $result = $emicount;
        return $result;
    }

    function checkData($param)
    {
        $setails_type = array();
        if (preg_match('/^[0-9]{10}+$/', $param)) {
            $setails_type['data'] = $param;
            $setails_type['data_type'] = 'mobile';
        } elseif (is_string($param)) {
            if (substr($param, 0, 3) == 'MDC') {
                $setails_type['data'] = $param;
                $setails_type['data_type'] = 'cust_code';
            } elseif (substr($param, 0, 3) == 'MDL') {
                $setails_type['data'] = $param;
                $setails_type['data_type'] = 'loan_no';
            }
        }
        return $setails_type;
    }

    function emiStatReport($loanno)
    {
        $eData = array();
        $getEmi = $this->api->emiStatReport(array('loan_no' => $loanno));
        if ($getEmi) {
            foreach ($getEmi->result() as $row_data) {
                $eData[] = array(
                    'status' => ($row_data->status == 1) ? 'paid' : 'unpaid',
                    'emi_amount' => $row_data->EMA,
                    'emi_count' => $row_data->EMC,
                );
            }
        } else {
            $eData = false;
        }
        return $eData;
    }

    function findLoan($param)
    {
        $getLoanD = $this->api->mixedfinder(array('loan_no' => $param), 'loan_tbl', 'cust_tbl');
        if ($getLoanD) {
            $rt = array();
            foreach ($getLoanD as $keyv) {
                $emi_p = $this->pendingEMI($param)['count'];
                $data = array(
                    'cust_code' => $keyv->cust_code,
                    'loan_no' => $keyv->loan_no,
                    'loan_date' => $keyv->loan_date,
                    'loan_amnt' => $keyv->loan_amnt,
                    'emi_amnt' => $keyv->emi_amnt,
                    'tenure' => $keyv->tenure,
                    'name' => $keyv->f_name . ' ' . $keyv->l_name,
                    'mobile' => $keyv->mobile,
                    'pending_emi_count' => !empty($emi_p) ? $emi_p : '',
                );
            }

            return $data;
        } else {
            return false;
        }
    }

    function getPendingLoans()
    {
        $result = array();
        $response = array();
        $loans = array();
        $data = $this->input->post();
        //$data = array('emp_code' => 'SMERR09');
        //date = 'd-m-Y';
        if (!empty($data['emp_code'])) {
            $getLoans = $this->api->finder(array('collection_agent' => $data['emp_code'], 'status' => 1), 'loan_mgmnt_tbl');
            if ($getLoans) {
                foreach ($getLoans->result() as $rowdata) {
                    $loan_no = $rowdata->loan_no;
                    $loans = $this->findLoan($loan_no);
                    array_push($result, $loans);
                }

                $response['status'] = 1;
                $response['msg'] = "Fetched Emi List!";
                $response['data'] = $result;
            } else {
                $response['status'] = 0;
                $response['msg'] = "No pending emi found!";
            }
        } else {
            $response['status'] = 0;
            $response['msg'] = "Employee code not found in emi master!";
        }
        header('Access-Control-Allow-Origin: *', 'Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    function pendingEMI($loan_no)
    {
        $data = array();

        $pendings = $this->api->pendings($loan_no);
        if ($pendings) {
            foreach ($pendings->result() as $value) {
                $tr[] = array(
                    'loan_no' => $value->loan_no,
                    'emi_code' => $value->emi_id,
                    'date' => $value->emi_date,
                    'emi_amount' => $value->emi_amount,
                );
            }

            $data['emis'] = $tr;
            $data['count'] = $pendings->num_rows();
        } else {
            $data['emis'] = false;
            $data['count'] = false;
        }
        return $data;
    }
}