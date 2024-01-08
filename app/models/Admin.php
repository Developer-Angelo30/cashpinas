<?php
include_once('../database/connection.php');
date_default_timezone_set('Asia/Manila');
class admin extends DB{

    protected function mLogin($_username , $_password){
        $username = mysqli_real_escape_string($this->database() , $_username);
        $password = md5(mysqli_real_escape_string($this->database() , $_password));
        
        if(!$username == "" && !$password == "" ){
            $sql = "SELECT `adminUsername`,`adminPassword` FROM `admins` WHERE `adminUsername` = '$username' AND `adminPassword` = '$password' ";
            $result = $this->database()->query($sql) ;
            if($result->num_rows > 0){
                $admins = $result->fetch_assoc();
                $_SESSION['adminLog'] = $admins['adminUsername'];
                return json_encode(array("status"=>"success"));
            }
            else{
                return json_encode(array("status"=>"failed", "message"=>"Username and password not matched." ));
            }
        }
        else{
            return json_encode(array("status"=>"failed" , "message"=>"Please fill all required fields." ));
        }
    }

    protected function mDeposit($_email , $_amount ){
        $email = mysqli_real_escape_string($this->database() , $_email );
        $amount = mysqli_real_escape_string($this->database() , $_amount );
        $date = Date('Y-m-d');

        if(!$email == "" && !$amount == "" ){
           if($amount >= 500){
            $sqlEmail = "SELECT * FROM `users` WHERE `userEmail`= '$email' ";
            $sqlEmailResult = $this->database()->query($sqlEmail);

            if($sqlEmailResult->num_rows > 0){
                $check_referral_query = "SELECT rc.rcEmail AS friendEmail , r.refEmail AS ownerEmail , r.refStatus AS status , a.amountTotal AS ownerAmount FROM users u INNER JOIN referrals r ON u.userEmail = r.refEmail INNER JOIN referralcode rc ON r.refCode = rc.rcCode INNER JOIN amounts a ON u.userEmail = a.amountEmail WHERE r.refStatus = 'unactive' AND u.userEmail = '$email'";
                $check_referral_result = $this->database()->query($check_referral_query);
                $check_referral_row = $check_referral_result->fetch_assoc();
                if($check_referral_result->num_rows > 0){
                 #ownerDeposit
                    $insertDeposit_query = "INSERT INTO `deposits`(`depositAmount`, `depositAdd`, `depositDate`, `depositEmail`) VALUES ('$amount' , 'Deposit' , '$date' , '$email' ) ";
                    $insertDeposit_result = $this->database()->query($insertDeposit_query);
                    if($insertDeposit_result){
                        #ownerAddDeposit in amounts
                        $ownerAmount = $check_referral_row['ownerAmount'] + $amount;
                        $updateAmount_query  = "UPDATE `amounts` SET  `amountTotal` =  '$ownerAmount' WHERE `amountEmail`= '$email' ";
                        $updateAmount_result = $this->database()->query($updateAmount_query);
                        if($updateAmount_result){
                            $friendEmail = $check_referral_row['friendEmail'];
                            $friendsAmount_query = "SELECT `amountTotal` FROM `amounts` WHERE `amountEmail` = '$friendEmail' ";
                            $friendsAmount_result = $this->database()->query($friendsAmount_query);
                            $friendAmount_row = $friendsAmount_result->fetch_assoc();
                            $friendAmount = $amount * 0.2;
                            $insertCommision_query = "INSERT INTO `deposits` (depositAmount, depositAdd, depositDate, depositEmail) VALUES ( '$friendAmount' , 'Invite' , '$date' , '$friendEmail' )";
                            $insertCommision_result = $this->database()->query($insertCommision_query);
                            if($insertCommision_result){
                                $commisionAmount = $friendAmount_row['amountTotal'] + ($amount * 0.2 );
                                $commsionAddAmount_query = "UPDATE `amounts` SET `amountTotal` = '$commisionAmount' WHERE `amountEmail` = '$friendEmail'  ";
                                $commisionAddAmount_result = $this->database()->query($commsionAddAmount_query);
                                if($commisionAddAmount_result){
                                    $referralUpdate_query = "UPDATE `referrals` SET `refStatus`='active' WHERE `refEmail`= '$email' ";
                                    $referralUpdate_result = $this->database()->query($referralUpdate_query);
                                    if($referralUpdate_result){
                                        return json_encode(array('status'=>'success' ,"message"=>'Successfully Deposited.'));
                                    }
                                }
                            }
                        }
                    }
                }
                else{
                    $check_referral_query = "SELECT `amountTotal` FROM `amounts` WHERE `amountEmail` = '$email' ";
                    $check_referral_result = $this->database()->query($check_referral_query);
                    $check_referral_row = $check_referral_result->fetch_assoc();
                    if($check_referral_result->num_rows > 0){
                    #ownerDeposit
                    $insertDeposit_query = "INSERT INTO `deposits`(`depositAmount`, `depositAdd`, `depositDate`, `depositEmail`) VALUES ('$amount' , 'Deposit' , '$date' , '$email' ) ";
                    $insertDeposit_result = $this->database()->query($insertDeposit_query);
                    if($insertDeposit_result){
                        #ownerAddDeposit in amounts
                        $ownerAmount = $check_referral_row['amountTotal'] + $amount;
                        $updateAmount_query  = "UPDATE `amounts` SET  `amountTotal` =  '$ownerAmount' WHERE `amountEmail`= '$email' ";
                        $updateAmount_result = $this->database()->query($updateAmount_query);
                        if($updateAmount_result){
                            return json_encode(array('status'=>'success' ,"message"=>'Successfully Deposited.'));
                        }
                }
                    }
                }
            }else{
                return json_encode(array('status'=>'failed', "message"=>"Not Found in Database."));
            }#endcheck email existing
           }
           else{
            return json_encode(array('status'=>'failed', "message"=>"Minimum Deposit is P500."));
           }
        }
        else{
            return json_encode(array('status'=>'failed', "message"=>"Please fill all required fields."));
        }

    }

    protected function mFetchDeposit(){
        $sql = "SELECT `depositAmount` , `depositAdd`, `depositEmail` , `depositDate` FROM `deposits` ORDER BY `depositDate` DESC LIMIT 100  ";
        $result = $this->database()->query($sql);
        $depo = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push ($depo, "<tr>
                            <td>".$row['depositAmount']."</td>
                            <td>".$row['depositAdd']."</td>
                            <td>".$row['depositEmail']."</td>
                            <td>".$row['depositDate']."</td>
                        </tr>");
            }

            return json_encode($depo);
        }
    }

    protected function mWithdrawVerified($_email){
        $email = mysqli_real_escape_string($this->database() , $_email );

        $verified_query = "UPDATE `withdraws` SET `withdrawStatus`= 'verified' WHERE `withdrawEmail` = '$email' ";
        $verified_result = $this->database()->query($verified_query);
        if($verified_result){
            return json_encode(array('status'=>'success' , 'message'=>"Successfully verified"));
        }

    }

    protected function mFetchWithdraw(){
        $sql = "SELECT SUM(w.withdrawAmount) AS `withdrawTotal` , w.withdrawEmail, u.userPhone FROM withdraws w INNER JOIN users u WHERE w.withdrawEmail = u.userEmail AND w.withdrawStatus = 'pending' GROUP BY w.withdrawEmail";
        $result = $this->database()->query($sql);
        $withdraw = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($withdraw , "
                    <tr>
                        <td>".$row['withdrawTotal']."</td>
                        <td>".$row['withdrawEmail']."</td>
                        <td>".$row['userPhone']."</td>
                        <td>
                            <button class='btn btn-success fa fa-check' data-amount ='".$row['withdrawTotal']."' id='btn-verified' value='".$row['withdrawEmail']."' ></button>
                        </td>
                    </tr>
                ");
            }
            return json_encode($withdraw);
        }
    }

    protected function minvestmentFetch(){
        $sql = "SELECT `investAmount` , `investDate`, `investEnd` , `investStatus` , `investEmail` FROM `investments` ORDER BY `investStatus` = 'Pending' DESC LIMIT 100  ";
        $result = $this->database()->query($sql);
        $depo = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push ($depo, "<tr>
                            <td>".$row['investAmount']."</td>
                            <td>".$row['investDate']."</td>
                            <td>".$row['investEnd']."</td>
                            <td>".$row['investEmail']."</td>
                            <td>".$row['investStatus']."</td>
                        </tr>");
            }

            return json_encode($depo);
        }
    }

    protected function mupdateUsername($_username , $_password){
        $username = mysqli_real_escape_string($this->database() , $_username );
        $password = md5(mysqli_real_escape_string($this->database() , $_password ));

        if(!$username == "" && !$_password == ""){
            $sql = "UPDATE `admins` SET `adminUsername`='$username'  WHERE `adminPassword`='$password' ";
            $result = $this->database()->query($sql);
            if($result){
                return json_encode(array('status'=>"success" , 'message'=>"" ));
            }
        }
        else{
            return json_encode(array('status'=>"failed" , 'message'=>"Please Fill All Required Fields." ));
        }
    }

    protected function mupdatePassword( $_username , $_cpassword , $_npassword){
        $username = mysqli_real_escape_string($this->database() , $_username );
        $cpassword = md5(mysqli_real_escape_string($this->database() , $_cpassword ));
        $npassword = md5(mysqli_real_escape_string($this->database() , $_npassword ));

        if(!$cpassword == "" && !$npassword == ""){
            $check_query = "SELECT `adminUsername`, `adminPassword` FROM `admins` WHERE `adminUsername` = '$username' AND `adminPassword`='$cpassword' ";
            $check_result = $this->database()->query($check_query);
            if($check_result->num_rows > 0){
                $sql = "UPDATE `admins` SET `adminPassword`='$npassword'  WHERE `adminUsername`='$username'  ";
                $result = $this->database()->query($sql);
                if($result){
                    return json_encode(array('status'=>"success" , 'message'=>"" ));
                }
            }
            else{
                return json_encode(array('status'=>"failed" , 'message'=>"Please Check Your Password." ));
            }
        }
        else{
            return json_encode(array('status'=>"failed" , 'message'=>"Please Fill All Required Fields." ));
        }
    }

}

?>