function showRounds(raceid){
    let roundsDiv = $('#roundsOf'+raceid);
    $.ajax({
        type: 'GET',
        url: '/showRounds/' + raceid,
        success: function (data) {
            //let roundsDiv = $('#race'+raceid);
            roundsDiv.empty();

            $.each(data.rounds, function (index, round) {
                roundsDiv.append( // Versenyek kilistázásához a html kód
                '<li class="list-group-item">'+
                    '<div class="row">'+
                        '<div class="col-2 round-li" id="round'+round.id+'}}"'+ 'data-roundid="'+round.id+'">'+
                            round.name+
                        '</div>'+
                    '</div>'+
                '</li>'
                );
            });
        }
    });
}