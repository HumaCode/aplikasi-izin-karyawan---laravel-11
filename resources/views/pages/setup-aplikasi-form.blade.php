<x-modal title="Form Setup Aplikasi" size="md" action="{{ $action }}">

    @if ($data->id)
        @method('PUT')
    @endif

    <div class="row">

        <div class="col-md-12">
            <x-forms.input label="H min cuti" name="hmin_cuti" value="{{ $data->hmin_cuti }}" />
        </div>

        <div class="col-md-12">
            <x-forms.select label="Hari kerja" name="hari_kerja[]" multiple data-placeholder="Pilih Hari Kerja"
                class="select2">

                @foreach ($hariKerja as $key => $hari)
                    <option value="{{ $hari }}">{{ $key }}</option>
                @endforeach

            </x-forms.select>
        </div>

    </div>
</x-modal>
