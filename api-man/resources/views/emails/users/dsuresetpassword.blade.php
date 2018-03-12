@component('mail::message')

{{-- Greeting --}}
@if (! empty($greeting))
    # {{ $greeting }}
@else
    @if ($level == 'error')
        # Whoops!
    @else
        # Buna!
    @endif
@endif

{{-- Body --}}
@if (! empty($body_message))
{{ $body_message }}
@endif

{{-- Action Button --}}
@isset($actionText)
<?php
switch ($level) {
    case 'success':
        $color = 'green';
        break;
    case 'error':
        $color = 'red';
        break;
    default:
        $color = 'blue';
}
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}<br>{{ $signature }}
@else
Toate cele bune,<br>{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
{{ $subcopy_content }}<br>{{ $actionUrl }}
@endcomponent
@endisset

@endcomponent