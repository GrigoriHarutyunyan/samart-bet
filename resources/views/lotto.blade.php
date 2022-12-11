<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Lotto Machine</title>
    <meta content="" name="Nutraville Amylguard">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <!--    <link href="/assets/img/favicon.png" rel="icon">-->
    <!--    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">-->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">

    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>
<body>
<main class="main">
    <h1>Lotto Game Configurations</h1>
    <div class="drawn-row-wrapper">
        <div class="drawn-row-column">
            <div class="lotto-configs-wrapper">
                <form id="config-form">
                    <div class="form-field">
                        <label for="machine-balls">Machine Balls:</label>

                        <select name="machine-balls" id="machine-balls">
                            <option value="40" selected="selected">40</option>
                            <option value="49">49</option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label for="lotto-config">Lotto config:</label>

                        <select name="lotto-config" id="lotto-config">
                            <option value="5" selected="selected">5</option>
                            <option value="7">7</option>
                        </select>
                    </div>

                    <button class="btn" type="submit">Generate Lotto</button>
                </form>

                <div id="lottery-table"></div>
            </div>

            <p class="error-message">Please choose correct values!!!</p>
            @if(count($errors))
                @foreach ($errors->all() as $error)
                    <p class="error-message-back">{{$error}}</p>
                @endforeach
            @endif

            <div class="drawn-row-item">
                <form action="{{route('play-lotto')}}" method="POST" id="play-game-form">
                    @csrf
                    <button class="btn btn__play" disabled>Play New Game</button>
                </form>

                <div class="heading">Last Lotto Play</div>

                @if(Session::has('emptyBoard'))
                    <p class="result-row"><b>empty board: </b>

                        @for($i = 1; $i <= Session::get('emptyBoard'); $i++)
                            {{$i}}{{$i != Session::get('emptyBoard') ? ',' : ''}}
                        @endfor
                        @endif
                    </p>

                    @if(Session::get('machineBalls'))
                        <p class="result-row"><b>Machine balls drawn : </b>
                            @forelse(Session::get('machineBalls') ?? [] as $machineBall)
                                {{$machineBall}}
                            @empty
                            @endforelse
                        </p>
                    @endif
                    @if(Session::has('userBalls'))
                        <p class="result-row"><b>User balls : </b>
                            @forelse(Session::get('userBalls') ?? [] as $userBall)
                                {{$userBall}}
                            @empty
                            @endforelse
                        </p>
                    @endif

                    @if(Session::has('matchedBalls'))
                        <p class="result-row"><b>Matches board balls : </b>
                            @forelse(Session::get('matchedBalls') ?? [] as $matchedBall)
                                {{$matchedBall}}
                            @empty
                                no matches
                            @endforelse
                        </p>
                    @endif
                    @if(Session::has('result'))
                        <p class="result-row"><b>win: </b>
                            <span class="{{Session::get('result') == 0 ? 'text-red' : "text-green"}}">{{\Illuminate\Support\Facades\Session::get('result') == 0 ? 'Lose!' : "Win!"}}</span>
                        </p>
                    @endif
            </div>
        </div>
        <div class="drawn-row-column">
            <h3 class="heading"><b>last 10 draws: </b></h3>
            @forelse ($lastTenPlays  ?? [] as $play)

                <div class="drawn-row-item">
                    <p class="result-row"><b>ID </b> {{$play->id}}</p>
                    <p class="result-row"><b>Machine balls : </b> {{collect($play->machine_balls)->implode(',')}}</p>
                    <p class="result-row"><b>User balls : </b> {{collect($play->user_balls)->implode(',')}}</p>
                    <p class="result-row"><b>Created At : </b> {{$play->created_at}}</p>
                </div>
            @empty
                <p>No Plays</p>
            @endforelse


        </div>
    </div>
</main>

<script src="{{asset('js/main.js')}}"></script>
</body>
</html>
