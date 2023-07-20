<?php
class user{
private $errors =array();

    public function signup($POST){

        foreach($POST as $key=>$value){
                //username valiiiiiiiii
            if($key == "username"){

                if(trim($value) == ""){

                    $this->errors[]="please enter a valid username";
                }
                if(strlen($value) > 22    || strlen($value) <3 ){

                    $this->errors[]="username is too short or too long";
                }
                if(is_numeric($value)){
                    
                    $this->errors[]="username can not be anumber ";
            }
        }

    if($key == "email"){

        if(trim($value) == ""){

            $this->errors[]="please enter the email";
        }
        if(!filter_var($value,FILTER_VALIDATE_EMAIL)){

            $this->errors[]="please enter a valid email";
        }
}
}$DB = new Database();
//check if email already exists
$data = array();
$data['email'] = $POST['email'];

$query = "select * from users where email = :email limit 1";
$result = $DB->read($query,$data);
if($result){
    $this->errors[] = "That email is already in use";
}

            if(count($this->errors ) == 0){
                
         $query ="insert into  users (username ,email ,password,date) values (:username ,:email ,:password, :date)";
                $db = new database();

                $data =array();
                $data['username']=$POST['username'];
                $data['email']=$POST['email'];
                $data['password']=$POST['password'];
                $data['date']=date("Y:m:d  H:i:s");


                $result=$db->write($query,$data);
                if(!$result){
                    $this->errors[]="something went wrong";
                }


            
        }return $this->errors ;


    
    }
}
