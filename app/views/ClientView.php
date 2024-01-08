<?php
session_start();
include_once('../models/Client.php');

class clientView extends Client{

    public function vLogin($_email , $_password){
        return $this->mLogin($_email, $_password);
    }

    public function vHomeFetchAmount($_email){
        return $this->mHomeFetchAmount($_email);
    }

    public function vHomeFetchWidthdraw($_email){
        return $this->mHomeFetchWidthdraw($_email);
    }

    public function vHomeFetchDeposit($_email){
        return $this->mHomeFetchDeposit($_email);
    }

    public function vHomeFetchReferral($_email){
        return $this->mHomeFetchReferral($_email);
    }

    public function vHomeFetchAll($_email){
        return $this->mHomeFetchAll($_email);
    }

    public function vHomeFetchLink($_email){
        return $this->mHomeFetchLink($_email);
    }

    public function vWithdrawFetchAll($_email){
        return $this->cWithdrawFetchAll($_email);
    }

    public function vDepositFetchAll($_email){
        return $this->mDepositFetchAll($_email);
    }

    public function vinvestmentFetch($_email){
        return $this->minvestmentFetch($_email);
    }
    


}


function getFunction(){
    if($_POST['action'] == "vLogin" ){
        $client = new clientView();
        echo  $client->vLogin($_POST['email'], $_POST['password']);
    }

    if($_POST['action'] == "vHomeFetchAmount"){
        $client = new clientView();
        echo $client->vHomeFetchAmount($_POST['email']);
    }

    if($_POST['action'] == "vHomeFetchWidthdraw"){
        $client = new clientView();
        echo $client->vHomeFetchWidthdraw($_POST['email']);
    }

    if($_POST['action'] == "vHomeFetchDeposit"){
        $client = new clientView();
        echo $client->vHomeFetchDeposit($_POST['email']);
    }

    if($_POST['action'] == "vHomeFetchReferral"){
        $client = new clientView();
        echo $client->vHomeFetchReferral($_POST['email']);
    }

    if($_POST['action'] == "vHomeFetchAll"){
        $client = new clientView();
        echo $client->vHomeFetchAll($_POST['email']);
    }
    
    if($_POST['action'] == "vHomeFetchLink"){
        $client = new clientView();
        echo $client->vHomeFetchLink($_POST['email']);
    }

    if($_POST['action'] == "vWithdrawFetchAll"){
        $client = new clientView();
        echo $client->vWithdrawFetchAll($_POST['email']);
    }

    if($_POST['action'] == "vDepositFetchAll" ){
        $client = new clientView();
        echo $client->vDepositFetchAll($_POST['email']);
    }

    if($_POST['action'] == "vinvestmentFetch" ){
        $client = new clientView();
        echo $client->vinvestmentFetch($_POST['email']);
    }
}
getFunction();

?>