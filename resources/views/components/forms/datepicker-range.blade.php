@props(['label' => null, 'data_name1' => '', 'data_name2' => '', 'data_value1' => '', 'data_value2' => ''])
<div class="form-wrapper mb-2">
    @if ($label)
        <label for="" class="form-label">{{ $label }}</label>
    @endif

    <div class="input-group mb-3 input-daterange datepicker date" data-date-format="dd-mm-yyyy">
        <input class="form-control" required="" type="text" id="{{ $data_name1 }}" name="{{ $data_name1 }}"
            value="{{ $data_value1 }}">
        <span class="bg-primary text-light px-3 justify-content-center align-items-center d-flex">to</span>
        <input class="form-control" required="" type="text" id="{{ $data_name2 }}" name="{{ $data_name2 }}"
            value="{{ $data_value2 }}">
    </div>
</div>
