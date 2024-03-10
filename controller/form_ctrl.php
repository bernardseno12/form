<?php
    include '../model/form_mdl.php';

    $Controller = new Controller();

    if(isset($_POST['type'])){
        switch($_POST['type']){
            case 1:
                echo json_encode($Controller->ctrlCreate($_POST));
                break;
            case 2:
                echo json_encode($Controller->ctrlRead($_POST));
                break;
            case 3:
                echo json_encode($Controller->ctrlUpdate($_POST));
                break;
            case 4:
                echo json_encode($Controller->ctrlDelete($_POST));
                break;
            default:
                echo json_encode(array('isSuccess'=>'0', 'ErrMsg' => 'Please Specify Which Route'));
                break;
        }
    }
    else{
        echo json_encode(array('ErrorMsg'=>'Check the data'));
    }

    class Controller{
        public $param;

        public function ctrlCreate($param){
            $Model = new Model();
            $uniqId = $param['unid'];
            $fname = $param['fname'];
            $lname = $param['lname'];
            $fullname = $param['fullname'];
            $address = $param['address'];
            $birthday = $param['birthday'];
            $formattedBirthday = date('Y-m-d', strtotime($birthday));
            $age = $param['age'];
            $createArr = array('uniqid' => $uniqId, 'fname' => $fname, 'lname' => $lname, 'fullname' => $fullname, 'address' => $address, 'birthday' => $formattedBirthday, 'age' => $age);

            // return array('$createArray' => $createArr);
            return $Model->createMdl($createArr);
        }

        public function ctrlRead($param){
            $Model = new Model();
            $readArr = array('lname' => $param['lname']);

            return $Model->readMdl($readArr);
        }

        public function ctrlUpdate($param){
            $Model = new Model();
            $uniqId = $param['unid'];
            $fname = $param['fname'];
            $lname = $param['lname'];
            $fullname = $param['fullname'];
            $address = $param['address'];
            $birthday = $param['birthday'];
            $formattedBirthday = date('Y-m-d', strtotime($birthday));
            $age = $param['age'];
            $mdlArray = array('uniqid' => $uniqId, 'fname' => $fname, 'lname' => $lname, 'fullname' => $fullname, 'address' => $address, 'birthday' => $formattedBirthday, 'age' => $age);
            
            return $Model->updateMdl($mdlArray);
        }

        public function ctrlDelete($param){
            $Model = new Model();
            $deleteArr = array('uniqid' => $param['trId']);

            return $Model->deleteMdl($deleteArr);
            // return array('ctrlDelete' => $param);
        }
    }