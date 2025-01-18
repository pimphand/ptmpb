@foreach($teams as $key => $team)
    <div class="wt-col-5 team-col-five">
        <div class="wt-team-five">
            <div class="wt-team-media">
                <a href="javacript:void(0)">
                    @if($team->photo)
                        <img src="{{asset('storage/'.$team->photo)}}" alt="" >
                    @else
                        <img src="{{asset('team/pic'.$key + 1)}}.png" alt="" >
                    @endif
                </a>
            </div>
            <div class="wt-team-info">
                <div class="p-a20 site-bg-primary ">
                    <h4 class="wt-team-title text-uppercase m-a0 m-b10"><a href="javacript:void(0)">{{$team->name}}</a></h4>
                    <div class="wt-team-position" style="color: #fff">{{$team->position}}</div>
                </div>

            </div>
        </div>
    </div>
@endforeach
