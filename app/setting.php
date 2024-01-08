<?php
    session_start();
    if(!isset($_SESSION['adminLog'])){
        header('location: ./index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<title>Setting | Administrator</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">	
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	    <link rel="stylesheet" href="../assets/css/admin-style.css">
        <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon">
    </head>
    <body>
	<div class="wrapper d-flex align-items-stretch">
		<nav id="sidebar" class="active">
            <ul class="list-unstyled components mb-5">
                <li>
                    <a href="#"><img src="../assets/img/logo.png" height="40px" width="40px" class="mt-2 ms-2"  alt=""> <b class="mt-2" >CashPinas</b> </a>
                </li>
                <li>
                    <a href="investment.php"><span class="fa fa-bar-chart"></span> Invest</a>
                </li>
                <li >
                    <a href="withdraw.php"><span class="fa fa-money"></span> Withdraw</a>
                </li>
                <li>
                    <a href="deposit.php"><span class="fa fa-credit-card"></span> Deposit</a>
                </li>
                <li>
                    <a href="setting.php"><span class="fa fa-cogs"></span> Setting</a>
                </li>
                <li>
                    <a href="logout.php"><span class="fa fa-sign-out"></span> Sign Out</a>
                </li>
            </ul>
            <div class="footer">
        	    <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script></p>
            </div>
    	</nav>
        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">
            <nav class="navbar navbar bg-white shadow">
                <div class="container-fluid">
                    <span class="text-dark fw-bolder" >SETTING</span>
                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
            </nav>
            <div class=" p-2 mt-3 shadow bg-white ">
                <div class="containe">
                    <div class="row">
                        <div class="col-sm-6">
                            <form id="usernameForm">
                                <h6 class="fw-bold text-muted" >UPDATE USERNAME</h6>
                                <div id="errorUsername"></div>
                                <input type="hidden" name="action" id="action" value="cupdateUsername">
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" placeholder="New Username" name="username" id="username">
                                </div>
                                <div class="form-group mt-3">
                                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                                </div>
                                <div class="mt form-group">
                                    <button class="btn btn-primary w-100" type='submit' >UPDATE</button>
                                </div>
                            </form>
                            <hr>
                        </div>
                        <div class="col-sm-6">
                            <form id="passwordForm">
                                <h6 class="fw-bold text-muted" >UPDATE PASSWORD</h6>
                                <div id="errorPassword" class="d-none" ></div>
                                <input type="hidden" name="owner-username" value="<?php echo $_SESSION['adminLog']; ?>">
                                <input type="hidden" name="action" value="cupdatePassword">
                                <div class="form-group mt-3">
                                    <input type="password" class="form-control" placeholder="Current Password" name="cpassword" id="cpassword">
                                </div>
                                <div class="form-group mt-3">
                                    <input type="password" class="form-control" placeholder="New Password" name="npassword" id="npassword">
                                </div>
                                <div class="mt form-group">
                                    <button class="btn btn-primary w-100" type='submit' >UPDATE</button>
                                </div>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
	</div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/c91a97da7b.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../assets/js/server.js"></script>
    <script src="../assets/js/main-dashboard.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>