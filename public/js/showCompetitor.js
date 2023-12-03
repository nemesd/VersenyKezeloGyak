function showCompetitors(roundid){
    let compDiv = $('#competitorsOf'+roundid);
    $.ajax({
        type: 'GET',
        url: '/showComp/' + roundid,
        success: function (data) {
            if(data.users.length != 0){
                compDiv.empty();
                $.each(data.users, function (index, user) {
                    compDiv.append( // Versenyzők kilistázásához a html kód
                    '<li class="list-group-item">'+
                        '<div class="comp-li" id="round'+user.id+'}}">'+
                        user.name+
                        '</div>'+
                    '</li>'
                    );
                });
            }
        }
    });
}