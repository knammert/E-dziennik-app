<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">

            <i class="fas fa-school"></i>
        </div>
        <div class="sidebar-brand-text mx-3">E-dziennik</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('mainPage') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel główny</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-user"></i>
            <span>Zarządzanie profilem</span>
        </a>
        <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('me.index') }}">Mój profil</a>
                <a class="collapse-item" href="{{route('me.edit',Auth::user()->id)}}">Edycja danych</a>
                <a class="collapse-item" href="{{ route('changePasswordIndex') }}">Zmiana hasła</a>
                <a class="collapse-item" href="{{ route('deleteAccountIndex') }}">Usuwanie konta</a>
        </div>
    </li>
    @if ( auth()->user()->role == 1)
        {{-- UCZEŃ --}}
        <div class="sidebar-heading">
            Uczeń
        </div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('studentPanel.grades.index') }}">
                <i class="fas fa-book-open"></i>
                <span>Oceny</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('calendarIndex') }}">
                <i class="fas fa-calendar"></i>
                <span>Plan lekcji</span></a>
        </li>

    @endif
    @if ( auth()->user()->role == 2)
        {{-- NAUCZYCIEL --}}
        <div class="sidebar-heading">
            Nauczyciel
        </div>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('teacherPanel.grades.index') }}">
                <i class="fas fa-book-open"></i>
                <span>Oceny</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('calendarIndex') }}">
                <i class="fas  fa-calendar"></i>
                <span>Plan lekcji</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.create') }}">
                <i class="fas fa-envelope"></i>
                <span>Tworzenie postów</span></a>
        </li>
    @endif
    @if ( auth()->user()->role == 3)
        {{-- ADMINISTRATOR --}}
        <div class="sidebar-heading">
            Administrator
        </div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('adminPanel.') }}">
                <i class="fas fa-users"></i>
                <span>Zarządzanie użytkownikami</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas  fa-folder-open"></i>
                <span>Zarządzanie lekcjami</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('adminPanel.class_names.index') }}">Klasy</a>
                    <a class="collapse-item" href="{{ route('adminPanel.subjects.index') }}">Przedmioty</a>
                    <a class="collapse-item" href="{{ route('adminPanel.activities.index') }}">Zajęcia</a>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('calendarIndex') }}">
                <i class="fas  fa-calendar"></i>
                <span>Plan lekcji</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
