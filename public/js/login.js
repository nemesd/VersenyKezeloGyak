let loginDetails="";
$('#emailLogin').val('');
$('#pwdLogin').val('');

$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    type: 'POST',
    url: '/loggedIn',
    success: function (data) {
        if (data.success) {
            loginDetails = {
                'name': data.name,
                'email': data.email,
                'birthyear': data.birthyear,
                'gender': data.gender,
                'admin': data.admin
            };
            $('#loggedOut').hide();
            $('#loggedIn').show();
            $('#userDetails').text(loginDetails['name']);
        } else {
            loginDetails = "";
        }
    },
    error: function (error) {
        console.log('AJAX error:', error);
        newPopUpAlert('Hiba történt!', 'danger');
    }
});

$('#emailLogin, #pwdLogin').keypress(function (e){ // Enter gombal elküldés
    if(e.which === 13){
        login();
    }
});

// Bejelentkezés kezelése
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
                    'gender': data.gender,
                    'admin': data.admin
                };

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
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/logOut',
        success: function (data) {
            if (data.success) {
                console.log('siker');
            } else {
                
            }
        },
        error: function (error) {
            console.log('AJAX error:', error);
            newPopUpAlert('Hiba történt!', 'danger');
        }
    });

    $('#loggedOut').show();
    $('#loggedIn').hide();
    $('#newRace').empty();
    loginDetails="";
    admin();

    //Versenyek újra listázása
    showRaces();
    newPopUpAlert('Kijelentkezve!');
}

//Megnézi hogy admin e user és ha igen beépíti az admin által használható gombokat ha nem akkor eltávolítja
function admin(){
    if(loginDetails['admin'] === 1){
        $('#newRaceBtn').append('<input type="button" value="Új verseny" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#raceModal">');
    } else {
        $('#newRaceBtn').empty();
    }
}