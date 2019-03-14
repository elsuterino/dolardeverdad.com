@if (Auth::guest())--}}
<a class="navbar-item " href="{{ route('login') }}">Login</a>
<a class="navbar-item " href="{{ route('register') }}">Register</a>
@else
    <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="#">{{ Auth::user()->name }}</a>

        <div class="navbar-dropdown">
            <a class="navbar-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endif