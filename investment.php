<?php
session_start();
if(!isset($_SESSION['userLog'])){
    header('location: ./index.php');
}

//$tomorrow = date("Y-m-d", time() + 1036800);

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Invest</title>
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
        <div id="content" class=" container mt-5 mb-5">
            <nav class="navbar navbar bg-white shadow">
                <div class="container-fluid">
                    <span class="text-dark fw-bolder" >INVEST</span>
                    <div>
                        <small id="loguser" data-email="<?php echo $_SESSION['userLog']; ?>" ><?php echo $_SESSION['userLog']; ?>&nbsp;<i class="fa fa-user" >&nbsp;</i></small>
                        <button type="button" id="sidebarCollapse" class="btn btn-primary">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                </div>
            </nav>
            <div class="box table-holder shadow p-3 mt-3 ">
                <div class="text-end mt-3">
                    <button type="button" class="btn btn-primary w-50" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD INVESTMENT</button>
                </div>
            <div class="mt-3 mb-3">
                <span>PENDING INVESTMENT</span>
            </div>
            <table class="table table-borderless bg-white " >
                <thead class="bg-secondary text-white" >
                    <tr>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="pendingInvestment" >

                </tbody>
            </table>
            </div>
        </div>
	</div>
    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD AMOUNT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close" ></i></button>
      </div>
        <div class="modal-body">
            <form id="investForm">
                <small class="text-muted">Note: Minimum Investment is 500.</small><hr>
                <input type="hidden" name="action" value="cInvestment" >
                <input type="hidden" name="email" value="<?php echo $_SESSION['userLog']; ?>" >
                <div class="form-group">
                    <input type="number" name="amount" class="form-control">
                </div>
                <div class="form-group mt-3 ">
                    <button type="submit" class="btn btn-primary w-100" >Submit</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/c91a97da7b.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./assets/js/client.js"></script>
    <script src="./assets/js/main-dashboard.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>
