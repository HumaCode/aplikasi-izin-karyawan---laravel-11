@props(['label', 'id' => 'id-switch' . rand()])
<div class="form-wrapper mb-2">
    <div class="form-check form-switch">
        <input class="form-check-input" {{ $attributes->merge() }} type="checkbox" id="{{ $id }}">
        <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
    </div>
</div>
