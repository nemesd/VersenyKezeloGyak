const modalLabel = $('#infoModalLabel');
const modalBody = $('#infoModalBody');

// INFO MODAL ADATAINEK KITÖLTÉSE

//Versenyhez adatok
function infoRace(raceId){
    $.ajax({
        type: 'GET',
        url: '/infoRace/' + raceId,
        success: function (data) {
            modalLabel.empty();
            modalLabel.append('Verseny:');
            modalBody.empty()
            modalBody.append(
            '<div class="pb-3"><strong>Neve:</strong> '+data.race.name+'</div>'+
            '<div class="pb-3"><strong>Éve:</strong> '+data.race.year+'</div>'+
            '<div class="pb-3"><strong>Kategória:</strong> '+data.race.category+'</div>'+
            '<div class="pb-3"><strong>Leírás:</strong> '+data.race.description+'</div>'
            );
        }
    });
}

//Fordulókhoz adatok
function infoRound(roundId){
    $.ajax({
        type: 'GET',
        url: '/infoRound/' + roundId,
        success: function (data) {
            modalLabel.empty();
            modalLabel.append('Forduló:');
            modalBody.empty()
            modalBody.append(
            '<div class="pb-3"><strong>Neve:</strong> '+data.round.name+'</div>'
            );
        }
    });
}

//Versenyzőkhőz adat
function infoComp(compId){
    $.ajax({
        type: 'GET',
        url: '/infoComp/' + compId,
        success: function (data) {
            modalLabel.empty();
            modalLabel.append('Versenyző:');
            modalBody.empty()
            modalBody.append(
            '<div class="pb-3"><strong>Neve:</strong> '+data.competitor.name+'</div>'+
            '<div class="pb-3"><strong>E-mail:</strong> '+data.competitor.email+'</div>'+
            '<div class="pb-3"><strong>Születési éve:</strong> '+data.competitor.birthyear+'</div>'
            );
            if(data.competitor.gender == 1){
                modalBody.append(
                    '<div class="pb-3"><strong>Neme:</strong> Nő</div>'
                );
            } else {
                modalBody.append(
                    '<div class="pb-3"><strong>Neme:</strong> Férfi</div>'
                );
            }
        }
    });
}

//Felhasználói adatok
function infoUser(){
    modalLabel.empty();
    modalLabel.append('Felhasználó:');
    modalBody.empty()
    modalBody.append(
    '<div class="pb-3"><strong>Neve:</strong> '+loginDetails.name+'</div>\n'+
    '<div class="pb-3"><strong>E-mail:</strong> '+loginDetails.email+'</div>\n'+
    '<div class="pb-3"><strong>Születési éve:</strong> '+loginDetails.birthyear+'</div>\n'
    );
    if(loginDetails.gender == 1){
        modalBody.append('<div class="pb-3"><strong>Neme:</strong> Nő</div>');
    } else {
        modalBody.append('<div class="pb-3"><strong>Neme:</strong> Férfi</div>');
    }
    if(loginDetails.admin == 1){
        modalBody.append('<div class="pb-3 text-success">ADMIN<div>')
    }
}

