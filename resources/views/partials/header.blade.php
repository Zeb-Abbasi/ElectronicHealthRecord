<header class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('homepage') }}">
            <h1 class="text-success">EHR</h1>
        </a>

        <!-- Collapsible Menu -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav text-center">
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="{{ route('homepage') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="{{ route('homepage') }}#our-features">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="{{ route('homepage') }}#about-us">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="{{ route('homepage') }}#gallery">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="{{ route('homepage') }}#logins">Logins</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="{{ route('homepage') }}#contact">Contact</a>
                </li>
            </ul>
            <div class="d-flex align-items-center  justify-content-center d-block d-md-none">
                <a href="{{ route('loginForm') }}" class="btn btn-success">Book an Appointment</a>

            </div>
        </div>

        <!-- Button -->
        <div class="d-flex align-items-center d-none d-md-block">
            <a href="{{ route('loginForm') }}" class="btn btn-success">Book an Appointment</a>
        </div>
    </div>
</header>
