let roundId;
let compSelect = $('#competitors');

//Versenyzők kiválasztásához lista
function listCompetitors(round){
    roundId = round;
    $.ajax({
        type: 'GET',
        url: '/listComp/'+round,
        success: function (data) {
            compSelect.empty();
            $.each(data.users, function (index, user) {
                if(user.admin === 0){
                    compSelect.append( // Versenyzők kilistázásához a html kód
                        '<option value="'+user.id+'">'+user.name+'</option>'
                    );
                }
            });
        }
    });
}

//Veresenyző hozzáadása
function addCompetitor(){
    const competitorId = compSelect.val();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/addComp',
        type: 'POST',
        data: {
            user_id: competitorId,
            round_id: roundId,
        },
        success: function (response) {
            if(response.type === 'danger'){
                newInLineAlert(response.message);
            } else {
                showRaces();
                $('#compModal').modal('hide');
                newPopUpAlert(response.message);
            }
        },
        error: function(error) {
            console.error('Error:', error);
            newInLineAlert('Sikertelen felvétel ', 'danger');
        }
    });
}