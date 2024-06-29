<x-modal title="Form Hari Libur" size="md" action="{{ $action }}">

    @if ($data->id)
        @method('PUT')
    @endif

    <div class="row">

        <div class="col-md-12">
            <x-forms.input label="Nama" name="nama" value="{{ $data->nama }}" />
        </div>

        <div class="col-md-12">
            <x-forms.datepicker-range label="Tanggal Libur" data_name1="tanggal_awal" data_name2="tanggal_akhir"
                data_value1="{{ convertDate($data->tanggal_awal, 'd-m-Y') }}"
                data_value2="{{ convertDate($data->tanggal_akhir, 'd-m-Y') }}" />
        </div>

    </div>
</x-modal>
