function addRace(){
    const name = $('#raceName').val();
    const year = $('#raceYear').val();
    const cat = $('#raceCat').val();
    const desc = $('#raceDesc').val();
    if(name == '' || year == '' || cat == '' || desc == ''){
        newInLineAlert('Adj meg minden adatot!');
        return;
    } else if(!$.isNumeric(year)){
        newInLineAlert('Az év csak számot tartalmazhat!')
        return;
    } else if(!(year >= 2023 && year <= 2050)){
        newInLineAlert('Verseny éve csak 2023-tól 2050-ig lehet!');
        return;
    }
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/addRace',
        type: 'POST',
        data: {
            name: name,
            year: year,
            category: cat,
            description: desc,
        },
        success: function(response) {
            if(response.type == 'danger'){
                newInLineAlert(response.message, response.type);
            } else {
                $('#raceModal').modal('hide');
                $('#raceName').val('');
                $('#raceYear').val('');
                hideInLineAlert();
                newPopUpAlert(response.message);
            }
            showRaces();
        },
        error: function(error) {
            console.error('Error:', error);
            newInLineAlert('Sikertelen felvétel AJAX', 'danger');
        }
    })
}