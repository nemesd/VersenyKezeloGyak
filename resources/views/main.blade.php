<!DOCTYPE html>
<html lang="hu">
<head>
    @include('header/head')
</head>
<body>
    @include('navbar/navbar')
    <div class="container">
        @if($admin == 1)
            <div id="newRaceBtn"><input type="button" value="Új verseny" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#raceModal"></div>
        @else
            <div id="newRaceBtn"></div>
        @endif
        <div class="pt-2">
            @if(count($races) == 0)
            <h2 class="pb-2" id="racesTitle">Nincsenek versenyek felvéve!</h2>
            @else
            <h2 class="pb-2" id="racesTitle">Versenyek:</h2>
            @endif
            <ul class="list-group">
                <div id="racesHere">
                    <!-- Versenyek helye -->
                    @include('firstLoad/firstLoad')
                </div>
            </ul>
        </div>


        
        <div id="alertContainer" class="position-fixed top-0 start-50 translate-middle-x  p-3">
            <!-- Értesítések helye -->
        </div>

        <!-- Felugró abalakok -->
        @include('modals/raceModal')
        @include('modals/roundModal')
        @include('modals/competitorModal')
        @include('modals/info')
        @include('modals/loginModal')
    </div>
</body>
</html>

























{{-- <div class="pt-2">
    <ul class="list-group">
        @foreach ($races as $race)
            <li class="list-group-item">
                <div class="row justify-content-between">
                    <div class="col-8 race-li" id="race{{$race->id}}" data-raceid="{{$race->id}}">
                        {{$race->name}} ({{$race->year}})
                    </div>
                    <input 
                        type="button" 
                        class="btn btn-primary col-4 newRoundBtn" 
                        value="Új forduló" 
                        data-bs-toggle="modal" 
                        data-bs-target="#roundModal">
                </div>
                <ul id="roundsOf{{$race->id}}">
                    @foreach($race->rounds as $round)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-2 round-li" id="round{{$round->id}}" data-roundid="{{$round->id}}">
                                {{$round->name}}
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div> --}}