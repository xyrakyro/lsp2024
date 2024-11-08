<x-layout>
    <header>
        <img class="header-image" src={{ asset('assets/images/smkn1cibinong.png') }} alt="">
        <div class="banner">Banner</div>
    </header>

    <div class="welcome">
        <div class="pages">
            @if (request()->is('teacher') || request()->is('teacher/edit'))
                List Raport
            @elseif (request()->is('teacher/create'))
                Input Raport
            @elseif (request()->is('student'))
                Nilai Raport
            @else
                Dashboard
            @endif
        </div>
        <div class="greet">Welcome, {{ session('username')}}</div>
    </div>
    <div class="main-container">
        <div class="sidebar-container">
            <aside class="sidebar">
                @if (session('user_type') == 'teacher')
                <ul>
                    <li><a href="/teacher"
                            class="{{ (request()->is('teacher') || request()->is('teacher/edit/*') || request()->is('teacher/view/*')) ? 'active' : '' }}">List
                            Raport</a></li>
                    <li><a href="/teacher/create"
                            class="{{ (request()->is('teacher/create')) ? 'active' : '' }}">Input Raport</a></li>
                </ul>
                <form action="{{ route('logout') }}" method="POST" class="logout-container"
                    style="display: inline; width: 100%;">
                    @csrf
                    <button type="submit" class="logout-button">Logout</button>
                </form>
                @elseif (session('user_type') == 'student')
                <ul>
                    <li><a href="/student" class="{{ (request()->is('student')) ? 'active' : '' }}">Nilai Raport</a></li>
                </ul>
                <form action="{{ route('logout') }}" method="POST" class="logout-container"
                    style="display: inline; width: 100%;">
                    @csrf
                    <button type="submit" class="logout-button">Logout</button>
                </form>
                @else
                <p>Silakan login untuk mengakses menu.</p>
                @endif
            </aside>
        </div>

        <main class="content">
            <div class="main">
                @yield('content')
            </div>
        </main>

        {{-- kalau ada yang ga ngerti bisa hubungi via wa yang ada di portofolionya :)) --}}
        <footer class="footer">
            <p>©&copy; 2024 E-RAPOR LSP. Created by <a href="https://habibmunakya.com" class="link-copy"
                    target="_blank">Habib Munakya</a> 11 RPL 2. All rights reserved.</p>
        </footer>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</x-layout>
