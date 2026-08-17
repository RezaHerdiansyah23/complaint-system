@props(['variant' => 'primary'])

@php
    $variantClass = match($variant) {
        'primary'   => 'btn-primary',
        'secondary' => 'btn-secondary',
        'success'   => 'btn-success',
        'danger'    => 'btn-danger',
        'outline'   => 'btn-outline',
        default     => 'btn-primary',
    };
@endphp

<button {{ $attributes->merge(['class' => $variantClass]) }}>
    {{ $slot }}
</button>
