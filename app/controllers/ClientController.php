<?php
session_start();
include_once('../models/Client.php');

class clientController extends Client{
    public function cCreate($_email , $_fname , $_lname , $_phone , $_password, $_referral ){
        return $this->mCreate($_email , $_fname , $_lname , $_phone , $_password, $_referral);
    }

    public function cWithdrawRequest($_email , $_amount){
        return $this->mWithdrawRequest($_email , $_amount);
    }

    public function cSettingUpdateInformation($_email, $_fname , $_lname){
        return $this->mSettingUpdateInformation($_email , $_fname , $_lname);
    }

    public function cSettingUpdatePhone($_email, $_phone){
        return $this->mSettingUpdatePhone($_email , $_phone);
    }

    public function cSettingUpdatePassword($_email, $_opassword , $_npassword , $_cpassword ){
        return $this->mSettingUpdatePassword($_email , $_opassword , $_npassword , $_cpassword );
    }

    public function cInvestment($_email,  $_amount ){
        return $this->mInvestment($_email, $_amount);
    }

    public function cinvestmentClaim($_email , $_id){
        return $this->minvestClaim($_email , $_id);
    }

}

function getFunction(){
    if($_POST['action'] == "cCreate" ){
        $client = new clientController();
        echo  $client->cCreate($_POST['email'], $_POST['fname'], $_POST['lname'], $_POST['phone'] , $_POST['password'], $_POST['referral']);
    }

    if($_POST['action'] == "cWithdrawRequest"){
        $client = new clientController();
        echo $client->cWithdrawRequest($_POST['email'], $_POST['amount']);
    }

    if($_POST['action'] == "cSettingUpdateInformation"){
        $client = new clientController();
        echo $client->cSettingUpdateInformation($_POST['email'] , $_POST['fname'], $_POST['lname']);
    }

    if($_POST['action'] == "cSettingUpdatePhone"){
        $client = new clientController();
        echo $client->cSettingUpdatePhone($_POST['email'] , $_POST['phone']);
    }

    if($_POST['action'] == "cSettingUpdatePassword"){
        $client = new clientController();
        echo $client->cSettingUpdatePassword($_POST['email'] , $_POST['opassword'] ,  $_POST['npassword']  , $_POST['cpassword'] );
    }

    if($_POST['action'] == "cInvestment"){
        $client = new clientController();
        echo $client->cInvestment($_POST['email'] , $_POST['amount'] );
    }


    if($_POST['action'] == "cinvestmentClaim"){
        $client = new clientController();
        echo $client->cinvestmentClaim($_POST['email'], $_POST['id']);
    }


    
}
getFunction();

?>