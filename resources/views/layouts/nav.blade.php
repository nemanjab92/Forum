
<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>




        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Browse<span class="caret"></span></a>
                        
                        <ul class="dropdown-menu">
                            <li><a href="/threads"> All Threads</a></li>
                            @if(auth()->check())
                            <li><a href="/threads?by={{auth()->user()->name}}">My Threads</a></li>
                            @endif
                            <li><a href="/threads?popular=1">Popular Threads All Time</a></li>
                            <li><a href="/threads?unanswered=1">Unanswered Threads</a></li>
                        </ul>
                      </li>

                &nbsp;&nbsp;&nbsp;

                <li>
                    <a href="/threads/create">New Thread</a>
                  </li>

                &nbsp;&nbsp;&nbsp; 

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Channels<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      @foreach ($channels as $channel)
                        <li><a href="/threads/{{$channel->slug}}"> {{$channel->name}}</a></li>
                      @endforeach
                    </ul>
                  </li>
                  
            </ul>
            <!-- Right Side Of Navbar -->
    <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @else
                <user-notifications></user-notifications>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('profile', Auth::user()) }}">My Profile</a>
                        </li>

                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>

</nav>