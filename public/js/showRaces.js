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
                    if(getCookie('admin') == 1){
                        racesDiv.append( // Versenyek kilistázásához a html kód
                            '<li class="list-group-item">'+
                            '<div class="row justify-content-between m-2">'+
                                '<div class="col-8 race-li" id="race'+race.id+'">'+
                                    '<div class="infoModal" data-bs-toggle="modal" data-bs-target="#infoModal" onclick="infoRace('+race.id+')">'+
                                        race.name+' ('+race.year+')'+
                                    '</div>'+
                                '</div>'+
                                '<input type="button" class="btn btn-primary col-4 newRoundBtn" value="Új forduló" data-bs-toggle="modal" data-bs-target="#roundModal" onclick="getRaceId('+race.id+')">'+
                            '</div>'+
                            '<ul id="roundsOf'+race.id+'">'
                        );
                    } else {
                        racesDiv.append( // Versenyek kilistázásához a html kód
                            '<li class="list-group-item">'+
                            '<div class="row justify-content-between m-2">'+
                                '<div class="col-8 race-li" id="race'+race.id+'">'+
                                    '<div class="infoModal" data-bs-toggle="modal" data-bs-target="#infoModal" onclick="infoRace('+race.id+')">'+
                                        race.name+' ('+race.year+')'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<ul id="roundsOf'+race.id+'">'
                        );
                    }
                    showRounds(race.id);
                    racesDiv.append('</ul>\n</li>');
                });
            }
        },
        error: function(error) {
            racesDiv.append('Error:', error.responseText);
            console.error('Error:', error);
        }
    });
}