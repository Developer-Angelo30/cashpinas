<?php
session_start();
date_default_timezone_set('Asia/Manila');
include_once('../models/Admin.php');

class adminView extends admin {
    public function vLogin($_username , $_password){
        return $this->mLogin($_username , $_password);
    }

    public function vFetchDeposit(){
        return $this->mFetchDeposit();
    }

    public function vFetchWithdraw(){
        return $this->mFetchWithdraw();
    }

    public function vinvestmentFetch(){
        return $this->minvestmentFetch();
    }

}

function getFunction(){
    if($_POST['action'] == "vLogin" ){
        $admin = new adminView();
        echo  $admin->vLogin($_POST['username'] , $_POST['password']);
    }

    if($_POST['action'] == 'vFetchDeposit'){
        $admin = new adminView();
        echo $admin->vFetchDeposit();
    }

    if($_POST['action'] == 'vFetchWithdraw'){
        $admin = new adminView();
        echo $admin->vFetchWithdraw();
    }

    if($_POST['action'] == 'vinvestmentFetch'){
        $admin = new adminView();
        echo $admin->vinvestmentFetch();
    }

}
getFunction();
?>