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
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel główny</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Profil
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('me.profile') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Mój profil</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Zmiana hasła</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Usuwanie konta</span></a>
    </li>
    {{-- UCZEŃ --}}
    <div class="sidebar-heading">
        Uczeń
    </div>

    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Oceny</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Statystyki</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Plan lekcji</span></a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Zadania domowe</span></a>
    </li> --}}
    {{-- NAUCZYCIEL --}}
    <div class="sidebar-heading">
        Nauczyciel
    </div>

    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Wystawianie ocen</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Plan lekcji</span></a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Tworzenie zadań</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Sprawdzanie zadań</span></a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Tworzenie postów</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Statystyki</span></a>
    </li>

       {{-- ADMINISTRATOR --}}
    <div class="sidebar-heading">
        Administrator
    </div>

    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Zarządzanie użytkownikami</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('adminPanel.class_names.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Zarządzanie klasami</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('adminPanel.subjects.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Tworzenie przedmiotów</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('adminPanel.class_names.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Tworzenie klas</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Tworzenie planu lekcji</span></a>
    </li>











    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
