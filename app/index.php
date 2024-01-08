<?php
    session_start();
    if(isset($_SESSION['adminLog'])){
        header('location: ./investment.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>CashPinas</title>
</head>
<body>
    <div id="wrapper-admin" class="d-flex justify-content-center align-items-center " >
        <div class="box-admin bg-white shadow ">
            <form id="loginForm" >
                <h5 class="text-center fw-bolder " >ADMINISTRATOR</h5><hr>
                <div class="alert alert-danger text-center d-none" id="adminLogError" ></div>
                <input type="hidden" name="action" value="vLogin" >
                <div class="form-group mt-3">
                    <input type="text" name="username"  placeholder="Username" class="form-control">
                </div>
                <div class="form-group mt-3">
                    <input type="password" name="password"  placeholder="Password" class="form-control">
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="text-uppercase fw-bold  w-75 btn btn-primary" >LOG IN</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/c91a97da7b.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../assets/js/server.js"></script>
</body>
</html>