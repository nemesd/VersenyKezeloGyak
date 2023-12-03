let raceid;

function getRaceId(id){
    raceid = id;
}

function addRound(){
    const name = $('#roundName').val();
    if(raceName == ''){
        newInLineAlert('Adj meg adatot!');
        return;
    }
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/addRound',
        type: 'POST',
        data: {
            name: name,
            race_id: raceid,
        },
        success: function(response) {
            if(response.type == 'danger'){
                newInLineAlert(response.message, response.type);
            } else {
                showRounds(raceid);
                $('#roundModal').modal('hide');
                $('#roundName').val('');
                newPopUpAlert(response.message);
            }
        },
        error: function(error) {
            console.error('Error:', error);
            newInLineAlert('Sikertelen felvétel', 'danger');
        }
    })
}