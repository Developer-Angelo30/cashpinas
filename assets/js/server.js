$(document).ready(function(){
    login()
    deposit()
    depositFetch()
    withdrawFetch()
    WithdrawVerified()

    investmentFetch()

    updateUsername()
    updatePassword()
    
});

const login = () =>{

    $(document).on('submit' , '#loginForm' , (e)=>{
        e.preventDefault();

        $.ajax({
            url: "./views/AdminView.php",
            method: "POST",
            data: $('#loginForm').serialize(),
            dataType: "JSON",
            success: (response)=>{
                if(response.status == "success"){
                    location.href = "../app/investment.php";
                }
                else{
                    $('#adminLogError').removeClass('d-none')
                    $('#adminLogError').text(response.message)
                }
            }
        })

    })

}

const deposit = () =>{
    $(document).on('submit' , '#depositForm' , (e)=>{
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, deposit it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "./controllers/AdminController.php",
                    method: "POST",
                    data: $('#depositForm').serialize(),
                    dataType: "JSON",
                    success: (response)=>{
                        if(response.status == "success"){
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message ,
                              })
                            $('#depositForm')[0].reset()
                            depositFetch()
                            $('#exampleModal').modal('hide')
                        }
                        else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message ,
                              })
                            $('#depositForm')[0].reset()
                        }
                    }
                })
            }
          })
    })
}

const depositFetch = ()=>{
    $.ajax({
        url: "./views/AdminView.php",
        method: "POST",
        data: { 'action':'vFetchDeposit'},
        dataType: "JSON",
        success: (response)=>{
            $('#tableDeposit').text("")
            $('#tableDeposit').append(response)
        }
    })
}

const withdrawFetch = () =>{
    $.ajax({
        url: "./views/AdminView.php",
        method: "POST",
        data: { 'action':'vFetchWithdraw'},
        dataType: "JSON",
        success: (response)=>{
            $('#tableWithdraw').text('')
            $('#tableWithdraw').append(response)
        }
    })
}

const WithdrawVerified = () =>{
    $(document).on('click', '#btn-verified' ,function(){
        var email = $(this).val()
        var amount = $(this).attr('data-amount')

        Swal.fire({
            title: 'Are you sure?',
            text: "The withdrawal money must be sent in Gcash Phone numbers beforehand.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Verify!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "./controllers/AdminController.php",
                    method: "POST",
                    data: { 'email':email , 'amount':amount , 'action':'cWithdrawVerified'},
                    dataType: "JSON",
                    success: (response)=>{
                        if(response.status == "success"){
                              location.reload()
                        }
                    }
                })
            }
          })
    })
}

const investmentFetch = () =>{
    $.ajax({
        url: "./views/AdminView.php",
        method: "POST",
        data: { 'action':'vinvestmentFetch'},
        dataType: "JSON",
        success: (response)=>{
            $('#tableInvestment').text('')
            $('#tableInvestment').append(response)
        }
    }) 
}

const updateUsername = () =>{
    $(document).on('submit' , '#usernameForm' , (e)=>{
        e.preventDefault()

        Swal.fire({
            title: 'Update Username',
            text: "are you sure?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: "./controllers/AdminController.php",
                    data: $('#usernameForm').serialize(),
                    dataType: "JSON",
                    success: (response)=>{
                        if(response.status == "success"){
                            location.href="logout.php"
                        }
                        else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message
                              })
                        }
                    }
                })
            }
          })
    } )
}

const updatePassword = () =>{
    $(document).on('submit' , '#passwordForm' , (e)=>{
        e.preventDefault()

        Swal.fire({
            title: 'Update Password',
            text: "are you sure?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: "./controllers/AdminController.php",
                    data: $('#passwordForm').serialize(),
                    dataType: "JSON",
                    success: (response)=>{
                        if(response.status == "success"){
                            location.href="logout.php"
                        }
                        else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                              })
                        }
                    }
                })
            }
          })
    } )
}