let loginDetails="";
$('#emailLogin').val('');
$('#pwdLogin').val('');
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

$('#emailLogin, #pwdLogin').keypress(function (e){
    if(e.which === 13){
        login();
    }
});

function login(){
    let email = $('#emailLogin').val();
    let pwd = $('#pwdLogin').val();
    if( email === '' ||  pwd === ''){
        newInLineAlert('Add meg az emailt és jelszót is!');
        return;
    }
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
                newPopUpAlert('Sikeres bejelentezés');

                loginDetails = {
                    'name': data.name,
                    'email': data.email,
                    'birthyear': data.birthyear,
                    'gender': data.name,
                    'admin': data.admin
                };

                //Cookiek beálítása a user adatokkal
                setCookie('name', data.name, 1);
                setCookie('email', data.email, 1);
                setCookie('birthyear', data.birthyear, 1);
                setCookie('gender', data.gender, 1);
                setCookie('admin', data.admin, 1);

                

                admin();
                showRaces();
            } else {
                newInLineAlert('Hibás email vagy jelszó', 'danger');
            }
        },
        error: function (error) {
            console.log('AJAX error:', error);
            newInLineAlert('Hiba történt!', 'danger');
        }
    });
}

//Kijelentkezés
function logout(){
    $('#loggedOut').show();
    $('#loggedIn').hide();

    //User adatok törlése a cookiekból
    delCookie('name');
    delCookie('email');
    delCookie('birthyear');
    delCookie('gender');
    delCookie('admin');
    $('#newRace').empty();

    //User adatok törlése a js változóból
    loginDetails="";
    admin();

    //Versenyek újra listázása
    showRaces();
    newPopUpAlert('Kijelentkezve!');
}

//Megnézi hogy admin e user és ha igen beépíti az admin által használható gombokat ha nem akkor eltávolítja
function admin(){
    if(getCookie('admin') === 1){
        $('#newRaceBtn').append('<input type="button" value="Új verseny" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#raceModal">');
    } else {
        $('#newRaceBtn').empty();
    }
}