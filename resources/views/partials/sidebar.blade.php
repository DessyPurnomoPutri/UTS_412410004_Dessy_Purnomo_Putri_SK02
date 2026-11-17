
<aside class="sidebar">

    <div class="sidebar-brand">
        <div class="brand-icon">✦</div>
        <div class="brand-text">
            <h2>OBSERVATORIUM</h2>
            <span>LANGIT GELAP</span>
        </div>
    </div>

    <div class="sidebar-divider"></div>

    <div class="sidebar-section">
        <span class="section-label">MENU UTAMA</span>

        <a href="{{ route('dashboard') }}"
           class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="menu-icon">⌂</span>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('lokasi.index') }}"
           class="sidebar-link {{ request()->routeIs('lokasi.*') ? 'active' : '' }}">
            <span class="menu-icon">◎</span>
            <span>Lokasi Observasi</span>
        </a>

        <a href="{{ route('kegiatan.index') }}"
           class="sidebar-link {{ request()->routeIs('kegiatan.*') ? 'active' : '' }}">
            <span class="menu-icon">✧</span>
            <span>Kegiatan Observasi</span>
        </a>

        <a href="{{ route('peserta.index') }}"
           class="sidebar-link {{ request()->routeIs('peserta.*') ? 'active' : '' }}">
            <span class="menu-icon">♧</span>
            <span>Data Peserta</span>
        </a>

        <a href="{{ route('perlengkapan.index') }}"
           class="sidebar-link {{ request()->routeIs('perlengkapan.*') ? 'active' : '' }}">
            <span class="menu-icon">⌕</span>
            <span>Perlengkapan</span>
        </a>
    </div>

    <div class="sidebar-bottom">
        <div class="sidebar-divider"></div>
        <div class="sidebar-note">
            <span class="note-icon">✦</span>
            <p>Explore the universe,<br>discover the unknown.</p>
        </div>
        <span class="sidebar-version">OBSERVATORIUM • ADMIN</span>
    </div>

</aside>
