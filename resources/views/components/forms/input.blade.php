@props(['id' => 'id' . rand(), 'type' => 'text', 'label' => null])

<div class="mb-2">
    @if ($label)
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" {{ $attributes->merge(['class' => 'form-control']) }} id="{{ $id }}">
</div>
