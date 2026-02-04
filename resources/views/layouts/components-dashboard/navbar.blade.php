<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center" style="position: relative;">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" id="global-search" class="form-control border-0 shadow-none" placeholder="Search..."
                    autocomplete="off" style="width: 250px;" />

                <div id="search-results" class="dropdown-menu shadow-lg border-0 mt-2"
                    style="display: none; position: absolute; top: 100%; left: 0; width: 350px; max-height: 400px; overflow-y: auto; z-index: 1000;">
                    <div id="results-content"></div>
                </div>
            </div>
        </div>

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ Auth::user()?->photo ? asset('storage/' . Auth::user()->photo) : asset('assets/img/avatars/1.png') }}"
                            class="w-px-40 h-auto rounded-circle" style="aspect-ratio: 1/1; object-fit: cover;" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <div class="dropdown-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ Auth::user()?->photo ? asset('storage/' . Auth::user()->photo) : asset('assets/img/avatars/1.png') }}"
                                            class="w-px-40 h-auto rounded-circle"
                                            style="aspect-ratio: 1/1; object-fit: cover;" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ Auth::user()?->name ?? 'Guest' }}</span>
                                    <small class="text-muted">
                                        <a class="dropdown-item" href="{{ route('dashboard.profile.index') }}">Admin</a>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>

                    @auth
                    <li>
                        <a class="dropdown-item" href="{{ route('dashboard.profile.index') }}">
                            <i class="bx bx-user me-2"></i> Profil
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('dashboard.pengaturan.index') }}">
                            <i class="bx bx-cog me-2"></i> Pengaturan
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off me-2"></i> Keluar
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @endauth
                </ul>
            </li>
        </ul>
    </div>
</nav>

<script>
    const searchInput = document.getElementById('global-search');
    const resultsBox = document.getElementById('search-results');
    const resultsContent = document.getElementById('results-content');

    searchInput.addEventListener('input', function() {
        let query = this.value;

        if (query.length < 2) {
            resultsBox.style.display = 'none';
            return;
        }

        fetch(`/dashboard/search/api?q=${query}`)
            .then(res => res.json())
            .then(data => {
                let html = '';
                
                if (data.categories && data.categories.length > 0) {
                    html += '<h6 class="dropdown-header text-primary fw-bold">Kategori</h6>';
                    data.categories.forEach(item => {
                        html += `<a class="dropdown-item" href="/dashboard/category"><i class="bx bx-category me-2"></i> ${item.name}</a>`;
                    });
                }

                if (data.products && data.products.length > 0) {
                    html += '<h6 class="dropdown-header text-success fw-bold">Produk</h6>';
                    data.products.forEach(item => {
                        html += `<a class="dropdown-item" href="/dashboard/product/${item.id}/edit"><i class="bx bx-package me-2"></i> ${item.name}</a>`;
                    });
                }

                if (html === '') {
                    html = '<div class="dropdown-item text-muted small py-2">Data tidak ditemukan...</div>';
                }

                resultsContent.innerHTML = html;
                resultsBox.style.display = 'block';
            })
            .catch(err => console.error("Error Fetch:", err));
    });

    // Menutup hasil search jika klik di luar area
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !resultsBox.contains(e.target)) {
            resultsBox.style.display = 'none';
        }
    });
</script>