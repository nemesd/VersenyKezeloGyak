function showRaces() {
    const racesDiv = $('#racesHere');

    $.ajax({
        type: 'GET',
        url: '/showRaces/',
        success: function(data) {
            if (data.races.length !== 0) {
                racesDiv.empty();
                $('#racesTitle').text('Versenyek:');

                $.each(data.races, function(index, race) {
                    const isAdmin = parseInt(loginDetails['admin']) === 1;

                    racesDiv.append(buildRaceItem(race, isAdmin));
                    showRoundsAndCompetitors(data, race, isAdmin);
                    racesDiv.append('</ul>\n</li>');
                });
            }
        },
        error: function(error) {
            racesDiv.append('Error:', error.responseText);
            newPopUpAlert('Hiba történt!', 'danger');
            console.error('Error:', error);
        }
    });
}

function buildRaceItem(race, isAdmin) {
    return `
        <li class="list-group-item">
            <div class="row justify-content-between m-2">
                <div class="col-8 race-li" id="race${race.id}">
                    <div class="infoModal" data-bs-toggle="modal" data-bs-target="#infoModal" onclick="infoRace(${race.id})">
                        ${race.name} (${race.year})
                    </div>
                </div>
                ${isAdmin ? `<input type="button" class="btn btn-primary col-4 newRoundBtn" value="Új forduló" data-bs-toggle="modal" data-bs-target="#roundModal" onclick="getRaceId(${race.id})">` : ''}
            </div>
            <ul id="roundsOf${race.id}">
    `;
}

function showRoundsAndCompetitors(data, race, isAdmin) {
    $.each(data.rounds, function(index, round) {
        if (round.race_id === race.id) {
            const roundsDiv = $(`#roundsOf${race.id}`);
            roundsDiv.append(buildRoundItem(round, isAdmin));

            $.each(data.comps, function(index, comp) {
                if (comp.round_id === round.id) {
                    $.each(data.users, function(index, user){
                        if(user.id === comp.user_id){
                            let compDiv = $(`#competitorsOf${round.id}`);
                            compDiv.append(buildCompetitorItem(user, isAdmin));
                        }
                    });
                }
            });
        }
    });
}

function buildRoundItem(round, isAdmin) {
    return `
        <li class="list-group-item">
            <div class="row">
                <div class="col-4 round-li infoModal" id="round${round.id}" data-roundid="${round.id}" data-bs-toggle="modal" data-bs-target="#infoModal" onclick="infoRound(${round.id})">
                    ${round.name}
                </div>
                <div class="col-4">
                    ${isAdmin ? `<input type="button" class="btn btn-primary mx-1" value="Új versenyző" data-bs-toggle="modal" data-bs-target="#compModal" onclick="listCompetitors(${round.id})">` : ''}
                </div>
            </div>
            <ul>
                <div id="competitorsOf${round.id}"></div>
            </ul>
        </li>
    `;
}

function buildCompetitorItem(user, isAdmin) {
    const compClass = (loginDetails['name'] === user.name) ? 'text-primary' : '';
    return `
        <li class="list-group-item">
            <div class="comp-li infoModal ${compClass}" id="round${user.id}" data-bs-toggle="modal" data-bs-target="#infoModal" onclick="infoComp(${user.id})">
                ${user.name}
            </div>
        </li>
    `;
}