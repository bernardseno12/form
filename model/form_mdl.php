<?php

    class Model{
        public $param;

        public function createMdl($param){
            include '../config/form_config.php';

            $sql = "INSERT INTO credentials(`UNIQID`, `FIRSTNAME`, `LASTNAME`, `FULLNAME`, `ADDRESS`, `BIRTHDAY`, `AGE`)
                    VALUES('{$param['uniqid']}', '{$param['fname']}', '{$param['lname']}', '{$param['fullname']}', '{$param['address']}', '{$param['birthday']}', '{$param['age']}')";
            $data = mysqli_query($conn, $sql);

            return ($data) ? array('IsSuccess' => '1', 'SuccessMsg' => 'Successfully Created') : array('IsSuccess' => '0', 'ErrMsg' => 'Check Client/Server Side Logic');
            // return array('modelArray' => $param);
        }

        public function readMdl($param){
            include '../config/form_config.php';
            $lname = $param['lname'];

            $sql = "SELECT * FROM credentials WHERE LASTNAME LIKE '%$lname%'";
            $data = mysqli_query($conn, $sql);
            
            if($data){
                return (mysqli_num_rows($data) > 0) ? array('results' => mysqli_fetch_all($data), 'IsSuccess' => '1') : array('IsSuccess' => '0', 'ErrMsg' => 'No Records Found') ;
            }
            else{
                return array('IsSuccess' => '0', mysqli_error($conn));
            }
        }

        public function updateMdl($param){
            include '../config/form_config.php';

            $sql = "UPDATE credentials
                    SET FIRSTNAME='{$param['fname']}', LASTNAME='{$param['lname']}', FULLNAME='{$param['fullname']}', ADDRESS='{$param['address']}', BIRTHDAY='{$param['birthday']}', AGE='{$param['age']}'
                    WHERE UNIQID='{$param['uniqid']}'
                    ";

            $data = mysqli_query($conn, $sql);

            return ($data) ? array('IsSuccess' => 1, 'SuccessMsg' => 'Successfully Updated') : array('IsSuccess' => 0, 'ErrMsg' => 'Check UNIQID') ;
            // return array('updateMdl' => $uniqid);
        }

        public function deleteMdl($param){
            include '../config/form_config.php';

            $sql = "DELETE FROM credentials
                    WHERE UNIQID='{$param['uniqid']}'
                   ";

            $data = mysqli_query($conn, $sql);

            return ($data) ? array('IsSuccess' => 1, 'SuccessMsg' => 'Successfully Deleted') : array('IsSuccess' => '0', 'ErrMsg' => 'Check UNIQID');
            // return array('IsSuccess' => '1', 'deleteMdl' => $param);
        }
    }