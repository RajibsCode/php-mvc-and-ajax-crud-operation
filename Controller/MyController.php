<?php

date_default_timezone_set('Asia/Kolkata');
require_once("Model/MyModel.php");
session_start();

class MyController extends MyModel {

    function __construct() {
        parent::__construct();
        if (isset($_SERVER['PATH_INFO'])) {
            
            switch ($_SERVER['PATH_INFO']) {

                case '/index':
                    include 'Views/index.php';
                    break;
                //// 1 make Rest API for show data
                case '/getEmpData':
                    try {
                        $all_data = $this->SelectData('employee');
                        // data convert array to json
                        echo json_encode($all_data);

                    } catch (\Exception $ex) {
                        throw $ex;
                    }
                    break;
                //// 15 make Rest API for Update data
                case '/editEmpData':
                    try {
                        $all_data = $this->SelectData('employee',['id'=>$this->htmlValidation($_REQUEST['check_id'])]);//get data from id

                        // data convert array to json
                        echo json_encode($all_data);

                    } catch (\Exception $ex) {
                        throw $ex;
                    }
                    break;
                //// 4 make Rest API for Insert data
                case '/insertEmpData':
                    try {
                        // echo "<pre>";
                        // print_r($_SERVER);
                        // exit;
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        // 5 make array and then form validation in model
                            $ins_data = [
                                'emp_id' => $this->htmlValidation($_POST['emp_id']),
                                'name' => $this->htmlValidation($_POST['name']),
                                'email' => $this->htmlValidation($_POST['email']),
                                'department' => $this->htmlValidation($_POST['department']),
                                'designation' => $this->htmlValidation($_POST['designation']),
                                'joining_date' => $this->htmlValidation($_POST['joining_date']),
                                'gender' => $this->htmlValidation($_POST['gender']),
                            ];
                            // 7 then call the function
                            $insert = $this->InsertData('employee', $ins_data);
                            // data convert array to json
                            echo json_encode($insert);
                       }else{
                            // 8 show error message and then jquery in index
                            $Response = [
                                'Data' => null,
                                'Message' => 'Method must be POST',
                                'Code' => 0

                            ];
                            echo json_encode($Response);
                        }

                    } catch (\Exception $ex) {
                        throw $ex;
                    }
                break;
                //// 21 make Rest API for Update data
                case '/updateEmpData':
                    try {
                        // echo "<pre>";
                        // print_r($_SERVER);
                        // exit;
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        // make array and then form validation in model
                            $update_data = [
                                'emp_id' => $this->htmlValidation($_POST['emp_id']),
                                'name' => $this->htmlValidation($_POST['name']),
                                'email' => $this->htmlValidation($_POST['email']),
                                'department' => $this->htmlValidation($_POST['department']),
                                'designation' => $this->htmlValidation($_POST['designation']),
                                'joining_date' => $this->htmlValidation($_POST['joining_date']),
                                'gender' => $this->htmlValidation($_POST['gender']),
                            ];
                            // then call the function
                            $update = $this->UpdateData('employee', $update_data, ['id'=>$this->htmlValidation($_POST['id'])]);
                            // data convert array to json
                            echo json_encode($update);
                       }else{
                            // show error message and then jquery in index
                            $Response = [
                                'Data' => null,
                                'Message' => 'Method must be POST',
                                'Code' => 0

                            ];
                            echo json_encode($Response);
                        }

                    } catch (\Exception $ex) {
                        throw $ex;
                    }
                break;
                //// 23 make Rest API for Delete data
                case '/deleteEmpData':
                    try {
                        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                            $delete_data = $this->DeleteData('employee',['id'=>$this->htmlValidation($_REQUEST['delete_id'])]);//get data from id

                            // data convert array to json
                            echo json_encode($delete_data);
                        }
                    } catch (\Exception $ex) {
                        throw $ex;
                    }
                    break;


                
                default:
                    include 'Views/index.php';
                break;
            }
        } else {
            ?>
            <script type="text/javascript">
                window.location.href = 'index';
            </script>
            <?php

        }
    }

}

$obj = new MyController;
?>