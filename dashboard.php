<?php
session_start();
if(!isset($_SESSION['userLog'])){
    header('location: ./index.php');
}

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Home</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">	
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	    <link rel="stylesheet" href="./assets/css/admin-style.css">
        <link rel="shortcut icon" href="./assets/img/logo.png" type="image/x-icon">
    </head>
    <body>
	<div class="wrapper d-flex align-items-stretch">
		<nav id="sidebar" class="active">
            <ul class="list-unstyled components mb-5">
                <li>
                    <a href="#"><img src="./assets/img/logo.png" height="40px" width="40px" class="mt-2 ms-2"  alt=""> <b class="mt-2" >CashPinas</b> </a>
                </li>
                <li class="active">
                    <a href="dashboard.php"><span class="fa fa-home"></span> Home</a>
                </li>
                <li class="active">
                    <a href="investment.php"><span class="fa fa-bar-chart"></span> Invest</a>
                </li>
                <li>
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
        <div id="content" class=" container mt-5 mb-5 ">
            <nav class="navbar navbar bg-white shadow">
                <div class="container-fluid">
                    <span class="text-dark fw-bolder" >HOME</span>
                    <div>
                        <small id="loguser" data-email="<?php echo $_SESSION['userLog']; ?>" ><?php echo $_SESSION['userLog']; ?>&nbsp;<i class="fa fa-user" >&nbsp;</i></small>
                        <button type="button" id="sidebarCollapse" class="btn btn-primary">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                </div>
            </nav>
            <div class="row">
                <div class="col-sm-6 ">
                    <div class="shadow  box p-2 mt-3 ">
                         <h1 id="HomeTotalAmount" class="fw-bold text-center ">P0</h1>
                        <h6 class="text-muted" >TOTAL AMOUNT</h6>
                    </div>
                </div>
                <div class="col-sm-6 ">
                    <div class="shadow  box p-2 mt-3 ">
                         <h1 id="HomeTotalWithdraw" class="fw-bold text-center ">P0</h1>
                        <h6 class="text-muted" >TOTAL WITHDRAW</h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 ">
                    <div class="shadow  box p-2 mt-3 ">
                         <h1 id="HomeTotalDeposit" class="fw-bold text-center ">P0</h1>
                        <h6 class="text-muted" >TOTAL DEPOSIT</h6>
                    </div>
                </div>
                <div class="col-sm-6 ">
                    <div class="shadow  box p-2 mt-3 ">
                         <h1  id="HomeTotalReferral" class="fw-bold text-center ">P0</h1>
                        <h6 class="text-muted" >TOTAL REFERRAL EARN</h6>
                    </div>
                </div>
            </div>
            <div class="shadow mt-3 mb-3 p-3 ">
                <h5 >REFERRAL CODE </h5>
                <small class="text-muted" id="link" ></small>
            </div>
            <div class="box table-holder shadow p-3 mt-3 ">
                <div class="mt-3 mb-3">
                    <span>WITHDRAWAL HISTORY</span>
                </div>
                <table class="table table-borderless bg-white " >
                    <thead class="bg-secondary text-white" >
                        <tr>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="tableWithdraw" >

                    </tbody>
                </table>
            </div>
        </div>
	</div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/c91a97da7b.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./assets/js/client.js"></script>
    <script src="./assets/js/main-dashboard.js"></script>
  </body>
</html>
