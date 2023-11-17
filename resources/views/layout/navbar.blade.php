<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a href="#" class="navbar-brand d-flex align-items-center">
            <i class="fa-solid fa-building"></i>
            <strong class="ps-3">Web App</strong>
        </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" aria-current="page" href="/home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" aria-current="page" href="/about">About</a>
            </li>
        </ul>
    </div>
</nav>