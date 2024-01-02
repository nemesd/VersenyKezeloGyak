let roundId;
let compSelect = $('#competitors');

function getRoundIdForNewComp(id){
    roundId = id;
    listCompetitors();
}

//Versenyzők kiválasztásához lista
function listCompetitors(){
    $.ajax({
        type: 'GET',
        url: '/listComp/',
        success: function (data) {
            compSelect.empty();
            $.each(data.users, function (index, user) {
                if(user.admin == 0){
                    compSelect.append( // Versenyzők kilistázásához a html kód
                        '<option value="'+user.id+'">'+user.name+'</option>'
                    );
                }
            });
        }
    });
}

//VEresenyző hozzáadása
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
            if(response.type == 'danger'){
                newInLineAlert(response.message, response.type);
            } else {
                showCompetitors(roundId);
                $('#compModal').modal('hide');
                newPopUpAlert(response.message);
            }
            hideInLineAlert();
        },
        error: function(error) {
            console.error('Error:', error);
            newInLineAlert('Sikertelen felvétel ', 'danger');
        }
    });
}