<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<script src="{{ asset('js/addRace.js') }}" defer></script>
<script src="{{ asset('js/addRound.js') }}" defer></script>
<script src="{{ asset('js/alert.js') }}" defer></script>
<script src="{{ asset('js/showRaces.js') }}" defer></script>
<script src="{{ asset('js/showRounds.js') }}" defer></script>
<meta name="csrf-token" content="{{ csrf_token() }}">