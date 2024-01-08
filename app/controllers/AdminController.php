<?php
session_start();
include_once('../models/Admin.php');

class adminController extends admin {

    public function cDeposit($_email , $_amount){
        return $this->mDeposit($_email, $_amount);
    }

    public function cWithdrawVerified($_email){
        return $this->mWithdrawVerified($_email);
    }

    public function cupdateUsername($_username, $_password){
        return $this->mupdateUsername($_username, $_password );
    }

    public function cupdatePassword( $_username ,$_cpassword, $_npassword){
        return $this->mupdatePassword($_username , $_cpassword, $_npassword );
    }

}


function getFunction(){
    if($_POST['action'] == "cDeposit" ){
        $admin = new adminController();
        echo  $admin->cDeposit($_POST['email'] , $_POST['amount']);
    }
    if($_POST['action'] == "cWithdrawVerified" ){
        $admin = new adminController();
        echo $admin->cWithdrawVerified($_POST['email']);
    }

    if($_POST['action'] == "cupdateUsername"){
        $admin = new adminController();
        echo $admin->cupdateUsername($_POST['username'], $_POST['password']);
    }

    if($_POST['action'] == "cupdatePassword"){
        $admin = new adminController();
        echo $admin->cupdatePassword($_POST['owner-username'] ,$_POST['cpassword'], $_POST['npassword']);
    }
}
getFunction();

?>