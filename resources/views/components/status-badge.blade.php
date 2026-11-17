
@props(['status'])

@php
    $statusClass = match ($status) {
        'aktif', 'baik', 'selesai' => 'success',
        'berlangsung' => 'info',
        'direncanakan' => 'warning',
        'nonaktif', 'dibatalkan', 'rusak_berat' => 'danger',
        'rusak_ringan' => 'warning',
        default => 'secondary',
    };

    $statusLabel = str_replace('_', ' ', $status);
@endphp

<span class="badge badge-{{ $statusClass }}">
    {{ ucfirst($statusLabel) }}
</span>
