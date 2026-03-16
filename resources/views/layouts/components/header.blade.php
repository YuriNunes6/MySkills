<header>
    <nav class="navbar">
        <div class="navbar-brand">
            <a href="{{ route('login') }}"><img src="{{ asset('images/MySkills-logo.png') }}" alt="myskills-logo"><h1>MySkills</h1></a>
        </div>
        <ul class="navbar-links">
            @auth
                @php $user = auth()->user(); @endphp

                @if($user->role === 'admin')
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.users.index') }}">Usuários</a></li>
                    <li><a href="{{ route('admin.skills.index') }}">Skills</a></li>
                @else
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('user.skills.index') }}">Minhas Skills</a></li>
                    <li><a href="{{ route('sessions.index') }}">Minhas Sessões</a></li>
                @endif

                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-logout">Sair</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('cadastro') }}">Cadastro</a></li>
            @endauth
        </ul>
    </nav>
</header>