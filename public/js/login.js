let loginDetails="";
$('#emailLogin').val('');
$('#pwdLogin').val('');
console.log(document.cookie);
if(getCookie('name') != ""){
    $('#loggedOut').hide();
    $('#loggedIn').show();
    loginDetails = {
        'name': getCookie('name'),
        'email': getCookie('email'),
        'birthyear': getCookie('birthyear'),
        'gender': getCookie('gender'),
        'admin': getCookie('admin')
    }
    $('#loggedOut').hide();
    $('#loggedIn').show();
    $('#userDetails').text(loginDetails.name);
    admin();
}
function login(){
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/login',
        data: {
            'email': $('#emailLogin').val(),
            'password': $('#pwdLogin').val(),
        },
        success: function (data) {
            if (data.success) {
                // Handle successful login and display account details
                $('#loginModal').modal('hide');
                $('#emailLogin').val('');
                $('#pwdLogin').val('');

                $('#loggedOut').hide();
                $('#loggedIn').show();
                $('#userDetails').text(data.name);

                loginDetails = {
                    'name': data.name,
                    'email': data.email,
                    'birthyear': data.birthyear,
                    'gender': data.name,
                    'admin': data.admin
                };
                setCookie('name', data.name, 1);
                setCookie('email', data.email, 1);
                setCookie('birthyear', data.birthyear, 1);
                setCookie('gender', data.gender, 1);
                setCookie('admin', data.admin, 1);

                admin();
            } else {
                // Handle failed login
                console.log(data.message);
            }
        },
        error: function (error) {
            console.log('AJAX error:', error);
        }
    });
    showRaces();
    console.log(document.cookie);
}

function logout(){
    $('#loggedOut').show();
    $('#loggedIn').hide();
    delCookie('name');
    delCookie('email');
    delCookie('birthyear');
    delCookie('gender');
    delCookie('admin');
    $('#newRace').empty();
    loginDetails="";
    admin();
    showRaces();
}

function admin(){
    if(getCookie('admin') == 1){
        $('#newRaceBtn').append('<input type="button" value="Új verseny" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#raceModal">');
    } else {
        $('#newRaceBtn').empty();
    }
}