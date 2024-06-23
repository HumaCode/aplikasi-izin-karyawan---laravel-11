<x-modal title="Form Divisi" size="md" action="{{ $action }}">

    @if ($data->id)
        @method('PUT')
    @endif

    <div class="row">

        <div class="col-md-12">
            <x-forms.input label="Nama Divisi" name="nama" value="{{ $data->nama }}" />
        </div>

    </div>
</x-modal>
