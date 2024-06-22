@props(['id' => 'id-datepicker', 'label' => null, 'format' => 'dd-mm-yyyy'])

<div class="mb-2 form-wrapper">

    @if ($label)
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    @endif

    <div class="input-group input-append date" data-date-format="{{ $format }}">
        <input {{ $attributes->merge(['class' => 'form-control']) }} id="{{ $id }}" type="text" readonly=""
            autocomplete="off">
        <button class="btn btn-outline-secondary" type="button">
            <i class="far fa-calendar-alt"></i>
        </button>
    </div>
</div>
