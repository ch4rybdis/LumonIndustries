<header class="navbar sticky-top flex-md-nowrap p-0 shadow" data-bs-theme="dark">
    <a class="navbar-brand p-0 bg-transparent" href="#">
        <img src="images/st_small_507x507-pad_600x600_f8f8f8-removebg-preview.png" alt="Lumon" width="250"
            height="150">
    </a>


    <h1 style="font-family: 'severance', sans-serif; color:rgb(20, 67, 130)">{{ $pageName ?? 'Default Page' }}</h1>

    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="--bs-bg-opacity: 0;">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{ route('profile') }}" class="nav-link">
                            <p>{{ $fullName }}</p>
                            <img src="{{ $imageLink }}" alt="image" width="100px" height="100px"
                                class="bg-transparent">
                        </a>
                    </li>
                </ul>
                <!-- Sayfa Adı Gösterimi -->

            </div>
        </div>
    </nav>
</header>
