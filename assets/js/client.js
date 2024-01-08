$(document).ready( ()=>{
    login()
    create_account()
    HomeFetchAmount()
    HomeFetchWidthdraw()
    HomeFetchDeposit()
    HomeFetchReferral()
    HomeFetchAll()
    HomeFetchLink()

    WithdrawRequest()
    WithdrawFetchAll()

    DepositFetchAll()

    SettingUpdateInformation()
    SettingUpdatePhone()
    SettingUpdatePassword()

    investment()
    investmentFetch()
    investmentClaim()
    
} )

const create_account = () =>{
    $(document).on('submit' , '#registerForm' , (e)=>{
        e.preventDefault()
        var email = $('#emailReg').val()
        var fname = $('#fnameReg').val()
        var lname = $('#lnameReg').val()
        var phone = $('#phoneReg').val()
        var password = $('#passwordReg').val()
        var cpassword = $('#cpasswordReg').val()
        var referral = $('#referralReg').val()
        if(password == cpassword ){
            $.ajax({
                type: "POST",
                url: "./app/controllers/ClientController.php",
                data: {'email':email , 'fname':fname , 'lname':lname , 'phone':phone , 'password':password , 'referral':referral, 'action':"cCreate" },
                dataType: "JSON",
                success: function (response) {
                    if(response.status == "success"){
                        $('#registerError').removeClass('d-none')
                        $('#registerError').addClass('alert alert-success text-center')
                        $('#registerError').text(response.message)
                        $('#emailReg').val('')
                        $('#fnameReg').val('')
                        $('#lnameReg').val('')
                        $('#phoneReg').val('')
                        $('#passwordReg').val('')
                        $('#cpasswordReg').val('')
                        $('#referralReg').val('')

                    }
                    else{
                        $('#registerError').removeClass('d-none')
                        $('#registerError').addClass('alert alert-danger text-center')
                        $('#registerError').text(response.message)
                    }
                }
            });
        }
        else{
            $('#registerError').removeClasss('d-none')
            $('#registerError').addClass('alert alert-danger')
            $('#registerError').text("Please Confirm your password.")
        }
    })
}

const login = () =>{
    $(document).on('submit', '#loginForm' , (e)=>{
        e.preventDefault()
        var email = $('#emailLog').val()
        var password = $('#passwordLog').val()
        
        $.ajax({
            url: "./app/views/ClientView.php",
            method: "POST",
            data: {'email':email , 'password':password , 'action':'vLogin' },
            dataType: "JSON",
            success: function(response){
                if(response.status == "success"){
                    location.href = "dashboard.php";
                }
                else{
                    $('#loginError').removeClass('d-none')
                    $('#loginError').addClass('alert alert-danger text-center')
                    $('#loginError').text(response.message)
                }
            }
        })

    } )
}

const HomeFetchLink  = ()=>{
    var email = $('#loguser').attr('data-email')
    $.ajax({
        type: "POST",
        url: "./app/views/ClientView.php",
        data: { 'email':email, 'action': "vHomeFetchLink" },
        dataType: "JSON",
        success: function (response) {
            if(response.status == "success"){
                $('#link').append("Copy Link: "+response.message)
            }
        }
    });
}

const HomeFetchAmount = ()=>{
    var email = $('#loguser').attr('data-email')
    $.ajax({
        type: "POST",
        url: "./app/views/ClientView.php",
        data: { 'email':email, 'action': "vHomeFetchAmount" },
        dataType: "JSON",
        success: function (response) {
            if(response.status == "success"){
                $('#HomeTotalAmount').text('P'+response.message)
            }
        }
    });
}

const HomeFetchWidthdraw = ()=>{
    var email = $('#loguser').attr('data-email')
    $.ajax({
        type: "POST",
        url: "./app/views/ClientView.php",
        data: { 'email':email, 'action': "vHomeFetchWidthdraw" },
        dataType: "JSON",
        success: function (response) {
            if(response.status == "success"){
                $('#HomeTotalWithdraw').text('P'+response.message)
            }
        }
    });
}

const HomeFetchDeposit = ()=>{
    var email = $('#loguser').attr('data-email')
    $.ajax({
        type: "POST",
        url: "./app/views/ClientView.php",
        data: { 'email':email, 'action': "vHomeFetchDeposit" },
        dataType: "JSON",
        success: function (response) {
            if(response.status == "success"){
                $('#HomeTotalDeposit').text('P'+response.message)
            }
        }
    });
}

const HomeFetchReferral = ()=>{
    var email = $('#loguser').attr('data-email')
    $.ajax({
        type: "POST",
        url: "./app/views/ClientView.php",
        data: { 'email':email, 'action': "vHomeFetchReferral" },
        dataType: "JSON",
        success: function (response) {
            if(response.status == "success"){
                $('#HomeTotalReferral').text('P'+response.message)
            }
        }
    });
}

const HomeFetchAll = ()=>{
    var email = $('#loguser').attr('data-email')
    $.ajax({
        type: "POST",
        url: "./app/views/ClientView.php",
        data: { 'email':email, 'action': "vHomeFetchAll" },
        dataType: "JSON",
        success: (response)=> {
            $('#tableWithdraw').text('')
            $('#tableWithdraw').append(response)
        }
    });
}

const investment = () =>{
    $(document).on('submit' , '#investForm' , (e)=>{
        e.preventDefault()
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Invest it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: "./app/controllers/ClientController.php",
                    data:$('#investForm').serialize() ,
                    dataType: "JSON",
                    success: (response)=> {
                        if(response.status == "success"){
                            Swal.fire({
                                icon: 'success',
                                title: 'Successfully invested. ',
                                text: response.message,
                              })
                            $('#investForm')[0].reset()
                            $('#exampleModal').modal('hide')
                            investmentFetch()
                        }
                        else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                              })
                            $('#investForm')[0].reset()
                        }
                        console.log(response)
                    }
                });
            }
          })
    })
}

const investmentFetch =()=>{
    var email = $('#loguser').attr('data-email')
    $.ajax({
        type: "POST",
        url: "./app/views/ClientView.php",
        data: { 'email':email, 'action': "vinvestmentFetch" },
        dataType: "JSON",
        success: (response)=> {
            $('#pendingInvestment').text('')
            $('#pendingInvestment').append(response)
        }
    });
}

const investmentClaim = ()=>{
    $(document).on('click', '#claim', function(){
        var email = $('#loguser').attr('data-email')
        var id = $(this).attr('data-id')

        Swal.fire({
            title: 'Calim Invest?',
            text: "are you sure?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, claim it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "./app/controllers/ClientController.php",
                    data: { 'email':email , 'id':id, 'action': "cinvestmentClaim" },
                    dataType: "JSON",
                    success: (response)=> {
                        if(response.status == "success"){
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                              })
                            investmentFetch()
                        }
                    }
                });
            }
          })
    })
}


const WithdrawRequest = ()=>{
    $(document).on('submit', '#withdrawForm' , (e)=>{
        e.preventDefault()

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, request it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "./app/controllers/ClientController.php",
                    data: $('#withdrawForm').serialize() ,
                    dataType: "JSON",
                    success: (response)=> {
                        if(response.status == "success"){
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                              })
                            $('#withdrawForm')[0].reset()
                            WithdrawFetchAll()
                            $('#exampleModal').modal('hide')
                        }
                        else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                              })
                            $('#withdrawForm')[0].reset()
                        }
                    }
                }); 
            }
          })
    })
}

const WithdrawFetchAll = ()=>{
    var email = $('#loguser').attr('data-email')
    $.ajax({
        type: "POST",
        url: "./app/views/ClientView.php",
        data: { 'email':email, 'action': "vWithdrawFetchAll" },
        dataType: "JSON",
        success: (response)=> {
            $('#PendingWithdraw').text('')
            $('#PendingWithdraw').append(response)
        }
    });
}

const DepositFetchAll = ()=>{
    var email = $('#loguser').attr('data-email')
    $.ajax({
        type: "POST",
        url: "./app/views/ClientView.php",
        data: { 'email':email, 'action': "vDepositFetchAll" },
        dataType: "JSON",
        success: (response)=> {
            $('#FetchDeposit').text('')
            $('#FetchDeposit').append(response)
        }
    });
}

const SettingUpdateInformation = ()=>{
    $(document).on('click', '#btn-info-update', ()=>{

        var email = $('#loguser').attr('data-email')
        var fname = $('#updateFname').val()
        var lname = $('#updateLname').val()

        Swal.fire({
            title: 'Update Information',
            text: "are you sure?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "./app/controllers/ClientController.php",
                    data: { 'email':email, 'fname':fname, 'lname':lname , 'action': "cSettingUpdateInformation" },
                    dataType: "JSON",
                    success: (response)=> {
                        if(response.status == "success"){
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                              })
                            $('#updateFname').val('')
                            $('#updateLname').val('')
        
                        }
                        else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Opps...',
                                text: response.message
                              })
                        }
                        
                    }
                });
            }
          })
    })
}

const SettingUpdatePhone = ()=>{
    $(document).on('click', '#btn-phone-update', ()=>{

        var email = $('#loguser').attr('data-email')
        var phone = $('#updatePhone').val()

        Swal.fire({
            title: 'Update Phone Number?',
            text: "are you sure?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "./app/controllers/ClientController.php",
                    data: { 'email':email, 'phone':phone, 'action': "cSettingUpdatePhone" },
                    dataType: "JSON",
                    success: (response)=> {
                        if(response.status == "success"){
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                              })
                            $('#updatePhone').val('')       
                        }
                        else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Opps...',
                                text: response.message,
                              })
                            $('#updatePhone').val('')
                        }
                        
                    }
                });
            }
          })
    })
}

const SettingUpdatePassword = ()=>{
    $(document).on('click', '#btn-password-update', ()=>{

        var email = $('#loguser').attr('data-email')
        var opassword = $('#oupdatePass').val()
        var npassword = $('#nupdatePass').val()
        var cpassword = $('#cupdatePass').val()

        Swal.fire({
            title: 'Update Phone Number?',
            text: "are you sure?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "./app/controllers/ClientController.php",
                    data: { 'email':email, 'opassword':opassword, 'npassword':npassword , 'cpassword':cpassword , 'action': "cSettingUpdatePassword" },
                    dataType: "JSON",
                    success: (response)=> {
                        if(response.status == "success"){
                            location.href = 'logout.php'
        
                        }
                        else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Opps',
                                text: response.message,
                            })
                            $('#oupdatePass').val()
                            $('#nupdatePass').val()
                            $('#cupdatePass').val()
                        }
                    }
                });
            }
          })
    })
}

