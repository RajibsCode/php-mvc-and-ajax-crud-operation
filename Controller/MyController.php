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