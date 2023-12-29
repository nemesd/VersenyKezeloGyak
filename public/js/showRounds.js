function showRounds(raceid){
    let roundsDiv = $('#roundsOf'+raceid);
    $.ajax({
        type: 'GET',
        url: '/showRounds/' + raceid,
        success: function (data) {
            if(data.rounds.length != 0){
                roundsDiv.empty();
                $.each(data.rounds, function (index, round) {
                    if(getCookie('admin') == 1){
                        roundsDiv.append( // Fordulók kilistázásához a html kód
                        '<li class="list-group-item">'+
                            '<div class="row">'+
                                '<div class="col-4 round-li infoModal" id="round'+round.id+'}}"'+ 'data-roundid="'+round.id+'" data-bs-toggle="modal" data-bs-target="#infoModal" onclick="infoRound('+round.id+')">'+
                                    round.name+
                                '</div>'+
                                '<div class="col-4">'+
                                    '<input type="button" class="btn btn-primary mx-1" value="Új versenyző" data-bs-toggle="modal" data-bs-target="#compModal" onclick="getRoundIdForNewComp('+round.id+')">'+
                                '</div>'+
                            '</div>'+
                            '<ul>'+
                                '<div id="competitorsOf'+round.id+'"></div>'+
                            '</ul>'+
                        '</li>'
                        );
                    } else {
                        roundsDiv.append( // Fordulók kilistázásához a html kód
                        '<li class="list-group-item">'+
                            '<div class="row">'+
                                '<div class="col-4 round-li infoModal" id="round'+round.id+'}}"'+ 'data-roundid="'+round.id+'" data-bs-toggle="modal" data-bs-target="#infoModal" onclick="infoRound('+round.id+')">'+
                                    round.name+
                                '</div>'+
                                '<div class="col-4">'+
                                '</div>'+
                            '</div>'+
                            '<ul>'+
                                '<div id="competitorsOf'+round.id+'"></div>'+
                            '</ul>'+
                        '</li>'
                        );
                    }
                    showCompetitors(round.id);
                });
            }
        }
    });
}