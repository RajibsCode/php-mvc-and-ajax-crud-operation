<?php

mysqli_report(MYSQLI_REPORT_STRICT);

class MyModel {

    public $connection = '';

    function __construct() {
        // echo "hii";
        try {
            $this->connection = new mysqli("localhost", "root", "", "eployee");
        } catch (Exception $e) {
            // echo "hii";
            $msg = $e->getMessage();
            $folderName = "DBErrorLog";
            if (!file_exists($folderName)) {
                mkdir($folderName); // in windows its working 
                // mkdir($folderName,0777,true); // ubuntu require permission 
            }
            $FileName = $folderName . "/ErrorLog_" . date("d_M_Y") . ".txt";
            file_put_contents($FileName, PHP_EOL . "TIME:>> " . date('Y-m-d H:i A') . PHP_EOL . "ErrorMessage:>> " . $msg . PHP_EOL, FILE_APPEND);
        }
    }

    function InsertData($tbl, $data) {
        $clms = implode(',', array_keys($data));
        $vals = implode("','", $data);
        $InsertSQL = "INSERT INTO $tbl($clms)VALUES('$vals')";
        //echo $InsertSQL; exit;
        $InsertEx = $this->connection->query($InsertSQL);
        if ($InsertEx == 1) {
            $Response["Data"] = null;
            $Response["Message"] = 'Data inserted successfully.';
            $Response["Code"] = 1;
        } else {
            $Response["Data"] = null;
            $Response["Message"] = 'Please try again later.';
            $Response["Code"] = 0;
        }
        return $Response;
    }

    function SelectData($tbl, $where = '') {
        $Sql = " SELECT * FROM $tbl";
        if ($where != '') {
            $Sql .= " WHERE ";
            foreach ($where as $key => $value) {
                $Sql .= " $key LIKE '$value%' AND";
            }
            $Sql = rtrim($Sql, 'AND');
        }
        $Sql .= " order by id desc";
        //echo $Sql;exit;
        $Ex = $this->connection->query($Sql);
        if ($Ex->num_rows > 0) {

            while ($FetchData = $Ex->fetch_object()) {
                $allData[] = $FetchData;
            }
            $Res['Data'] = $allData;
            $Res['Code'] = 1;
            $Res['Message'] = "Success";
            //print_r($Res);exit;
        } else {
            $Res['Data'] = null;
            $Res['Code'] = 0;
            $Res['Message'] = "no data";
        }
        return $Res;
    }

    function UpdateData($tbl, $data, $where) {

        $UpdateData = "UPDATE $tbl set ";
        foreach ($data as $key => $value) {
            $UpdateData .= "$key = '$value',";
            // print_r($UpdateData);
        }
        $UpdateData1 = rtrim($UpdateData, ',');
        $UpdateData1 .= " WHERE ";
        foreach ($where as $key => $value) {
            $UpdateData1 .= "$key = '$value' AND";
        }
        $UpdateData1 = rtrim($UpdateData1, 'AND');
        return $SelectEx = $this->connection->query($UpdateData1);
    }

    function DeleteData($tbl, $where) {
        $DeleteSQl = "DELETE FROM $tbl WHERE ";
        foreach ($where as $key => $value) {
            $DeleteSQl .= " $key = '$value'";
        }
        /* echo $DeleteSQl;exit(); */
        $DeleteSQlAfterTrim = rtrim($DeleteSQl);
        return $DeleteSQlEx = $this->connection->query($DeleteSQlAfterTrim);
    }

}

?>
