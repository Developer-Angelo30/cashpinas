<?php
include_once('../database/connection.php');
date_default_timezone_set('Asia/Manila');

class Client extends DB {

    protected function mCreate($_email , $_fname , $_lname , $_phone , $_password, $_referral){
        $email = strtolower(mysqli_real_escape_String($this->database(), $_email));
        $fname = ucwords(mysqli_real_escape_string($this->database() , $_fname));
        $lname = ucwords( mysqli_real_escape_string($this->database() , $_lname));
        $phone = mysqli_real_escape_string($this->database() , $_phone);
        $password = md5(mysqli_real_escape_string($this->database() , $_password));
        $referral = mysqli_real_escape_string($this->database(), $_referral);

        $xcode = md5($email);

        if(!$email == "" && !$fname == ""  && !$lname == "" && !$phone == "" && !$password == "" ){
            if(strpos($email, '@gmail.com')){
                if(strlen($_password)  >= 8 ){
                    #check email
                    $checkEmail_query = "SELECT `userEmail` FROM `users` WHERE `userEmail` =  '$email' ";
                    $checkEmail_result = $this->database()->query($checkEmail_query);
                    if($checkEmail_result->num_rows > 0){
                        return json_encode(array('status'=>'failed' , 'message'=>"Email already registered"));
                    }
                    else{
                        #check phone
                        $checkPhone_query = "SELECT `userPhone` FROM `users` WHERE `userPhone` =  '$phone' ";
                        $checkPhone_result = $this->database()->query($checkPhone_query);
                        if($checkPhone_result->num_rows > 0){
                            return json_encode(array('status'=>'failed' , 'message'=>"Phone Number already registered"));
                        }
                        else{
                            #insert users
                            $insertUser_query = "INSERT INTO `users` (`userEmail`, `userFname`, `userLname`, `userPhone`, `userPassword`)VALUES('$email' , '$fname', '$lname', '$phone', '$password')";
                            $insertUser_result = $this->database()->query($insertUser_query);
                            if($insertUser_result){
                                #insert users own referral code
                                $insertRefCode_query = "INSERT INTO `referralCode` (`rcCode`, `rcEmail`)VALUES('$xcode', '$email')";
                                $insertRefCode_result = $this->database()->query($insertRefCode_query);
                                if($insertRefCode_result){
                                    if(!$referral == ""){
                                        #with referral code
                                        $insertRef_ref_query = "INSERT INTO `referrals`(`refCode`, `refStatus`, `refEmail`) VALUES('$referral', 'unactive' , '$email' )";
                                        $insertRef_ref_result = $this->database()->query($insertRef_ref_query);
                                        if($insertRef_ref_result){
                                            $insertAmount_query = "INSERT INTO `amounts` (`amountTotal`, `amountEmail`)VALUES('0', '$email') ";
                                            $insertAmount_result = $this->database()->query($insertAmount_query);
                                            if($insertAmount_result){
                                                return json_encode(array('status'=>'success' , 'message'=>"Successfully registered."));
                                            }
                                        }
                                    }
                                    else{
                                        #without referral code
                                        $insertRef_ref_query = "INSERT INTO `referrals`(`refCode`, `refStatus`, `refEmail`) VALUES('', 'active' , '$email' )";
                                        $insertRef_ref_result = $this->database()->query($insertRef_ref_query);
                                        if($insertRef_ref_result){
                                            $insertAmount_query = "INSERT INTO `amounts` (`amountTotal`, `amountEmail`)VALUES('0', '$email') ";
                                            $insertAmount_result = $this->database()->query($insertAmount_query);
                                            if($insertAmount_result){
                                                return json_encode(array('status'=>'success' , 'message'=>"Successfully registered."));
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }else{
                    return json_encode(array('status'=>'failed' , 'message'=>"Password must be atleast 12."));
                }
            }
            else{
                return json_encode(array('status'=>'failed' , 'message'=>"Please input valid email account."));
            }
        }else{
            return json_encode(array('status'=>'failed' , 'message'=>"Please fill all required fileid."));
        }

    }

    protected function mLogin($_email, $_password){
        $email = strtolower(mysqli_real_escape_String($this->database(), $_email));
        $password =  md5(mysqli_real_escape_string($this->database() ,$_password));
        
        if(!$email == "" && !$password == "" ){
            if(strpos($email , "@gmail.com")){
                $sql = "SELECT * FROM `users` WHERE `userEmail`= '$email' AND `userPassword` = '$password' ";
                $result = $this->database()->query($sql);
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $_SESSION['userLog'] = $row['userEmail'];
                    return json_encode(array('status'=>"success" , 'message'=>"success" ));
                }
                else{
                    return json_encode(array('status'=>"failed" , 'message'=>"Email and password are not matched." ));
                }
            }
            else{
                return json_encode(array('status'=>"failed" , 'message'=>"Please input valid email address." ));
            } 
        }
        else{
            return json_encode(array('status'=>"failed" , 'message'=>"Please fill all required filieds." ));
        }
    } 

    protected function mHomeFetchAmount($_email){
        $email = strtolower(mysqli_real_escape_String($this->database(), $_email));
        $sql="SELECT `amountTotal` FROM `amounts` WHERE `amountEmail` = '$email'  ";
        $result = $this->database()->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $total = $row['amountTotal'];
            return json_encode(array('status'=>"success" , "message"=>$total ));
        }
        else{
            return json_encode(array('status'=>"success" , "message"=>"Someting Wrong." ));
        }
    }

    protected function mHomeFetchWidthdraw($_email){
        $email = strtolower(mysqli_real_escape_String($this->database(), $_email));
        $sql="SELECT SUM(withdrawAmount) as widthdrawTotal FROM `withdraws` WHERE `withdrawEmail` = '$email' AND `withdrawStatus` = 'verified' ";
        $result = $this->database()->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $total = $row['widthdrawTotal'];
            if(!$total == 0){
                return json_encode(array('status'=>"success" , "message"=>$total ));
            }
            else{
                return json_encode(array('status'=>"success" , "message"=>"0" ));
            } 
        }
    }

    protected function mHomeFetchDeposit($_email){
        $email = strtolower(mysqli_real_escape_String($this->database(), $_email));
        $sql="SELECT SUM(depositAmount) AS depositTotal  FROM `deposits` WHERE `depositEmail` = '$email' AND `depositAdd` = 'deposit' ";
        $result = $this->database()->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $total = $row['depositTotal'];
            if(!$total == 0){
                return json_encode(array('status'=>"success" , "message"=>$total ));
            }
            else{
                return json_encode(array('status'=>"success" , "message"=>"0" ));
            } 
        }
    }

    protected function mHomeFetchReferral($_email){
        $email = strtolower(mysqli_real_escape_String($this->database(), $_email));
        $sql="SELECT SUM(depositAmount) AS depositReferral  FROM `deposits` WHERE `depositEmail` = '$email' AND `depositAdd` = 'invite' ";
        $result = $this->database()->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $total = $row['depositReferral'];
            if(!$total == 0){
                return json_encode(array('status'=>"success" , "message"=>$total ));
            }
            else{
                return json_encode(array('status'=>"success" , "message"=>"0" ));
            } 
        }
    }

    protected function mHomeFetchAll($_email){
        $email = strtolower(mysqli_real_escape_String($this->database(), $_email));
        $sql="SELECT `withdrawAmount`, `withdrawDate` FROM `withdraws` WHERE `withdrawEmail` = '$email' AND `withdrawStatus` = 'verified' ";
        $result = $this->database()->query($sql);
        $withdrawData = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($withdrawData , "
                    <tr>
                        <td>".$row['withdrawAmount']."</td>
                        <td>".$row['withdrawDate']."</td>
                    </tr>
                ");
            }
            return json_encode($withdrawData);
        }
        else{
            array_push($withdrawData , "
                    <tr class='text-center text-muted'  colspan='2' >
                        <td></td>
                        <td></td>
                    </tr>
                ");

            return json_encode($withdrawData);
        }
    }

    protected function mHomeFetchLink($_email){
        $email = strtolower(mysqli_real_escape_String($this->database(), $_email));
        $sql = "SELECT `rcCode` FROM `referralcode` WHERE  `rcEmail` = '$email' ";
        $result = $this->database()->query($sql);
        $row = $result->fetch_assoc();
        $_GET['refcode'] = "http://localhost/cashpinas/index.php?refcode=".$row['rcCode']."";
        return json_encode(array('status'=>'success' , 'message'=>"http://localhost/cashpinas/index.php?refcode=".$row['rcCode']."" ));
    }

    protected function cWithdrawFetchAll($_email){
        $email = strtolower(mysqli_real_escape_String($this->database(), $_email));
        $sql="SELECT `withdrawAmount`, `withdrawDate` FROM `withdraws` WHERE `withdrawEmail` = '$email' AND `withdrawStatus` = 'pending' ";
        $result = $this->database()->query($sql);
        $withdrawData = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($withdrawData , "
                    <tr>
                        <td>".$row['withdrawAmount']."</td>
                        <td>".$row['withdrawDate']."</td>
                    </tr>
                ");
            }
            return json_encode($withdrawData);
        }
        else{
            array_push($withdrawData , "
                    <tr class='text-center text-muted'  colspan='2' >
                        <td></td>
                        <td></td>
                    </tr>
                ");

            return json_encode($withdrawData);
        }
    }

    protected function mWithdrawRequest($_email , $_amount){
        $email = strtolower(mysqli_real_escape_String($this->database(), $_email));
        $amount = mysqli_real_escape_string($this->database() , $_amount);
        $date = Date('Y-m-d');

        if($amount >= 500){
            $checkAmount_query = "SELECT `amountTotal` FROM `amounts` WHERE `amountEmail` = '$email'  ";
            $checkAmount_result = $this->database()->query($checkAmount_query);
            $row = $checkAmount_result->fetch_assoc();
            $currentAmount = $row['amountTotal'];
            if($amount <= $currentAmount){
                $insert_query = "INSERT INTO `withdraws`(`withdrawAmount`, `withdrawEmail` , `withdrawStatus` , `withdrawDate`)VALUES('$amount' , '$email' , 'pending' , '$date' ) ";
                $insert_result = $this->database()->query($insert_query);
                if($insert_result){
                    $updateAmount = $currentAmount - $amount;
                    $update_query = "UPDATE `amounts` SET `amountTotal` = '$updateAmount' WHERE `amountEmail` = '$email' ";
                    $update_result = $this->database()->query($update_query);
                    if($update_result){
                        return json_encode(array('status'=>"success" , 'message'=>"Successfully Requested." ));
                    }
                }
            }
            else{
                return json_encode(array('status'=>"failed" , 'message'=>"You dont have enough balanced." ));
            }
        }
        else{
            return json_encode(array('status'=>"failed" , 'message'=>"Minimum withdrawal is 500." ));
        }

    }

    protected function mDepositFetchAll($_email){
        $email = strtolower(mysqli_real_escape_String($this->database(), $_email));
        $sql="SELECT `depositAmount`, `depositAdd` ,`depositDate` FROM `deposits` WHERE `depositEmail` = '$email' ";
        $result = $this->database()->query($sql);
        $depositData = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($depositData , "
                    <tr>
                        <td>".$row['depositAmount']."</td>
                        <td>".$row['depositAdd']."</td>
                        <td>".$row['depositDate']."</td>
                    </tr>
                ");
            }
            return json_encode($depositData);
        }
        else{
            array_push($depositData , "
                    <tr class='text-center text-muted'  colspan='2' >
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                ");

            return json_encode($depositData);
        }
    }

    protected function mSettingUpdateInformation($_email , $_fname , $_lname){
        $email = strtolower(mysqli_real_escape_String($this->database(), $_email));
        $fname = ucwords(mysqli_real_escape_String($this->database(), $_fname));
        $lname = ucwords(mysqli_real_escape_String($this->database(), $_lname));

        if(!$email == "" && !$fname == "" && !$lname == "" ){
            $sql = "UPDATE `users` SET `userFname`='$fname',`userLname`='$lname'  WHERE `userEmail` = '$email' ";
            $result = $this->database()->query($sql);
            if($result){
                return json_encode(array('status'=>"success" , 'message'=>"Updated Successfully."));
            }
        }
        else{
            return json_encode(array("status"=>"failed" , "message"=>"Please Fill Required Fields." ));
        }

    }

    protected function mSettingUpdatePhone($_email ,$_phone){
        $email = strtolower(mysqli_real_escape_String($this->database(), $_email));
        $phone = mysqli_real_escape_String($this->database(), $_phone);

        if(!$email == "" && !$phone == "" ){
            $check_query = "SELECT `userPhone` FROM `users` WHERE `userPhone` = '$phone' ";
            $check_result = $this->database()->query($check_query);
            if($check_result->num_rows > 0){
                return json_encode(array('status'=>"failed" , 'message'=>"This Phone Number is already used."));
            }
            else{
                $sql = "UPDATE `users` SET `userPhone`='$phone'  WHERE `userEmail` = '$email' ";
                $result = $this->database()->query($sql);
                if($result){
                    return json_encode(array('status'=>"success" , 'message'=>"Updated Successfully."));
                }
            }
        }
        else{
            return json_encode(array("status"=>"failed" , "message"=>"Please Fill Required Fields." ));
        }

    }

    protected function mSettingUpdatePassword($_email , $_opassword , $_npassword , $_cpassword){
        $email = strtolower(mysqli_real_escape_String($this->database(), $_email));
        $opassword = md5(mysqli_real_escape_String($this->database(), $_opassword));
        $npassword = md5(mysqli_real_escape_String($this->database(), $_npassword));
        $cpassword = md5(mysqli_real_escape_String($this->database(), $_cpassword));

        if(!$opassword == "" && !$npassword == "" && !$cpassword == "" ){
            if($npassword == $cpassword){
                $check_query = "SELECT `userPassword` FROM `users` WHERE `userEmail` = '$email' AND `userPassword` = '$opassword' ";
                $check_result = $this->database()->query($check_query);
                if($check_result->num_rows > 0){
                    $sql = "UPDATE `users` SET `userPassword`='$npassword'  WHERE `userEmail` = '$email' ";
                    $result = $this->database()->query($sql);
                    if($result){
                        return json_encode(array('status'=>"success" , 'message'=>"Updated Successfully."));
                    }else{
                        return json_encode(array('status'=>"success" , 'message'=>"something wrong call developers."));
                    }
                }
                else{
                    return json_encode(array('status'=>"failed" , 'message'=>"Incorrect Password"));
                }  
            }
            else{
                return json_encode(array('status'=>"failed" , 'message'=>"Please Confirm your password."));
            }
        }
        else{
            return json_encode(array("status"=>"failed" , "message"=>"Please Fill Required Fields." ));
        }

    }

    protected function mInvestment($_email , $_amount){
        $email = strtolower(mysqli_real_escape_String($this->database(), $_email));
        $amount = mysqli_real_escape_string($this->database() , $_amount);
        $start = date("Y-m-d");
        $end = date("Y-m-d", time() + 1036800);

        if(!$email == "" && !$amount == "" ){
            if($amount >= 500){
                $checkAmount_query = "SELECT `amountTotal` FROM `amounts` WHERE `amountEmail` = '$email' ";
                $checkAmount_result = $this->database()->query($checkAmount_query);
                if($checkAmount_result->num_rows > 0){
                    $row = $checkAmount_result->fetch_assoc();
                    $currentAmount = $row['amountTotal'];
                    if($currentAmount >= $amount ){
                        $updateAmount = $currentAmount - $amount;
                        $insertInvest_query = "INSERT INTO `investments` (`investAmount`, `investDate`, `investEnd`,  `investStatus`, `investEmail`) VALUES ('$amount','$start','$end', 'Pending' ,'$email')";
                        $insertInvest_result = $this->database()->query($insertInvest_query);
                        if($insertInvest_result){
                            $updateAmount_query = "UPDATE `amounts` SET `amountTotal`= '$updateAmount'  WHERE `amountEmail` = '$email' ";
                            $updateAmount_result = $this->database()->query($updateAmount_query);
                            if($updateAmount_result){
                                return json_encode(array('status'=>"success" , 'message'=>'Successfully Invested.' ));
                            }
                        }
                    }
                    else{
                        return json_encode(array('status'=>"failed" , 'message'=>'You dont have enough balanced.' ));
                    }
                }
            }else{
                return json_encode(array('status'=>"failed" , 'message'=>'500 is minimum investment.' ));
            }
        }
        else{
            return json_encode(array('status'=>"failed" , 'message'=>'Please fill all required fields.' ));
        }
    }

    protected function minvestmentFetch($_email){
        $email = strtolower(mysqli_real_escape_String($this->database(), $_email));
        $investData = array();
        $sql = "SELECT * FROM `investments` WHERE `investEmail` = '$email' ORDER BY `investStatus` = 'Pending' DESC ";
        $result = $this->database()->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if(strtotime(Date('Y-m-d')) < strtotime($row['investEnd'])){
                    array_push($investData , "
                    <tr>
                        <td>".$row['investAmount']."</td>
                        <td>".$row['investDate']."</td>
                        <td>".$row['investEnd']."</td>
                        <td>".$row['investStatus']."</td>
                    </tr>
                    ");
                }
                else{
                    if($row['investStatus'] == "Done"){
                        array_push($investData , "
                        <tr>
                            <td>".$row['investAmount']."</td>
                            <td>".$row['investDate']."</td>
                            <td>".$row['investEnd']."</td>
                            <td>Claimed</td>
                        </tr>
                        ");
                    }
                    else{
                        array_push($investData , "
                        <tr>
                            <td>".$row['investAmount']."</td>
                            <td>".$row['investDate']."</td>
                            <td>".$row['investEnd']."</td>
                            <td>
                                <button class='btn btn-success fa fa-check ' id='claim' data-id='".$row['id']."'  ></buton>
                            </td>
                        </tr>
                        ");
                    }
                }
            }
            return json_encode($investData);
        }
    }

    protected function minvestClaim($_email , $_id){
        $email = strtolower(mysqli_real_escape_String($this->database(), $_email));
        $id = mysqli_real_escape_String($this->database(), $_id);
        
        $sql_date_invest_query = "SELECT `investAmount` , `investEnd` FROM `investments` WHERE `id` = '$id' ";
        $sql_date_invest_result = $this->database()->query($sql_date_invest_query);
        if($sql_date_invest_result->num_rows > 0){

            $row = $sql_date_invest_result->fetch_assoc();
            $date = Date('Y-m-d');

            if($date >= $row['investEnd']){
                $sql_update_status_query = "UPDATE `investments` SET `investStatus`='Done' WHERE `id`='$id' ";
                $sql_update_status_result = $this->database()->query($sql_update_status_query);
                if($sql_update_status_result){
                    $sql_amount_query = "SELECT `amountTotal` FROM `amounts` WHERE `amountEmail` = '$email' ";
                    $sql_amout_result = $this->database()->query($sql_amount_query);
                    if($sql_amout_result->num_rows > 0){
                        $amount_row = $sql_amout_result->fetch_assoc();
                        $updateAmount = $amount_row['amountTotal'] + ($row['investAmount'] + ($row['investAmount']/2));
                        $sql_update_amount_query = "UPDATE `amounts` SET `amountTotal`='$updateAmount' WHERE `amountEmail`='$email' ";
                        $sql_update_amount_result = $this->database()->query($sql_update_amount_query);
                        return json_encode(array('status'=>'success' , 'message'=>'success'));
                    }
                }
            }
            
        }

    }
}

?>