<x-modal title="Form Divisi" action="{{ $action }}">

    @if ($data->id)
        @method('PUT')
    @endif

    <div class="row">

        <div class="col-md-6">
            <x-forms.input label="Total" name="total" value="{{ $data->total }}" />
        </div>

        <div class="col-md-6">
            <x-forms.datepicker label="Tahun" name="tahun" value="{{ $data->tahun }}" />
        </div>

        <div class="col-md-6">
            <input type="hidden" name="user_id" value="{{ $data->user_id }}" />
            <x-forms.input readonly id="user_name" data-action="{{ route('users.list-atasan') }}" label="User Name"
                name="user_name" value="{{ $data->user?->nama }}" />
        </div>


    </div>
</x-modal>
