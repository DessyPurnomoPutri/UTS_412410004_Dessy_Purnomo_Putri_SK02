
<header class="topbar">

    <div class="topbar-left">
        <div class="breadcrumb">
            <span>Observatorium</span>
            <span class="breadcrumb-separator">/</span>
            <strong>@yield('page-title', 'Dashboard')</strong>
        </div>

        <p class="topbar-subtitle">
            Sistem Informasi Pengelolaan Observatorium Langit Gelap
        </p>
    </div>

    <div class="topbar-right">

        <div class="topbar-date">
            <span class="date-icon">◷</span>
            <span>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</span>
        </div>

        <div class="admin-profile">
            <div class="admin-avatar">A</div>
            <div class="admin-info">
                <strong>Administrator</strong>
                <span>Admin Observatorium</span>
            </div>
        </div>

    </div>

</header>
