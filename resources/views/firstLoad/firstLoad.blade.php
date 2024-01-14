@foreach($races as $race)
<li class="list-group-item">
    <div class="row justify-content-between m-2">
        <div class="col-8 race-li" id="race{{$race->id}}">
            <div class="infoModal" data-bs-toggle="modal" data-bs-target="#infoModal" onclick="infoRace({{$race->id}})">
                {!!$race->name!!} ({!!$race->year!!})
            </div>
        </div>
        @if($admin == 1)
            <input type="button" class="btn btn-primary col-4 newRoundBtn" value="Új forduló" data-bs-toggle="modal" data-bs-target="#roundModal" onclick="getRaceId({{$race->id}})">
        @endif
    </div>
    <ul id="roundsOf{{$race->id}}">
        @foreach($race->rounds as $round)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-4 round-li infoModal" id="round{{$round->id}}" data-roundid="{{$round->id}}" data-bs-toggle="modal" data-bs-target="#infoModal" onclick="infoRound({{$round->id}})">
                        {!!$round->name!!}
                    </div>
                    <div class="col-4">
                        @if($admin == 1)
                            <input type="button" class="btn btn-primary mx-1" value="Új versenyző" data-bs-toggle="modal" data-bs-target="#compModal" onclick="listCompetitors({{$round->id}})">
                        @endif
                    </div>
                </div>
                <ul>
                    <div id="competitorsOf'{{$round->id}}'">
                    @foreach($round->competitors as $competitor)
                        @foreach($users as $user)
                            @if($user->id == $competitor->user_id)
                                <li class="list-group-item">
                                    @if($name == $user->name)
                                        <div class="comp-li infoModal text-primary" id="round{{$user->id}}" data-bs-toggle="modal" data-bs-target="#infoModal" onclick="infoComp({{$user->id}})">
                                    @else
                                        <div class="comp-li infoModal" id="round{{$user->id}}" data-bs-toggle="modal" data-bs-target="#infoModal" onclick="infoComp({{$user->id}})">
                                    @endif
                                    {!!$user->name!!}
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    @endforeach
                    </div>
                </ul>
            </li>
        @endforeach
    </ul>
</li>
@endforeach