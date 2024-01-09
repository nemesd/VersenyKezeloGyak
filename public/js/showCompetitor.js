function showCompetitors(roundid){
    let compDiv = $('#competitorsOf'+roundid);
    $.ajax({
        type: 'GET',
        url: '/showComp/' + roundid,
        success: function (data) {
            if(data.users.length != 0){
                compDiv.empty();
                $.each(data.users, function (index, user) {
                    if(getCookie('name') === user.name){
                        compDiv.append( // Versenyzők kilistázásához a html kód
                        '<li class="list-group-item">'+
                            '<div class="comp-li infoModal text-primary" id="round'+user.id+'" data-bs-toggle="modal" data-bs-target="#infoModal" onclick="infoComp('+user.id+')">'+
                            user.name+
                            '</div>'+
                        '</li>'
                        );
                    } else {
                        compDiv.append( // Versenyzők kilistázásához a html kód
                        '<li class="list-group-item">'+
                            '<div class="comp-li infoModal" id="round'+user.id+'" data-bs-toggle="modal" data-bs-target="#infoModal" onclick="infoComp('+user.id+')">'+
                            user.name+
                            '</div>'+
                        '</li>'
                        );
                    }
                });
            }
        }
    });
}