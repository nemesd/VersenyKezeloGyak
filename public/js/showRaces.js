showRaces();
function showRaces(){
    let racesDiv = $('#racesHere');
    $.ajax({
        type: 'GET',
        url: '/showRaces/',
        success: function (data) {
            if(data.races.length != 0){
                $('#racesTitle').show();
                racesDiv.empty();
                $.each(data.races, function (index, race) {
                    racesDiv.append( // Versenyek kilistázásához a html kód
                        ' <li class="list-group-item">'+
                        '<div class="row justify-content-between m-2">'+
                            '<div class="col-8 race-li" id="race'+race.id+'">'+
                                race.name+' ('+race.year+')'+
                            '</div>'+
                            '<input type="button" class="btn btn-primary col-4 newRoundBtn" value="Új forduló" data-bs-toggle="modal" data-bs-target="#roundModal" onclick="getRaceId('+race.id+')">'+
                        '</div>'+
                        '<ul id="roundsOf'+race.id+'">'
                    );
                    showRounds(race.id);
                    racesDiv.append('</ul>\n</li>');
                });
            }
        }
    });
}