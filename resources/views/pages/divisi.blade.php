<x-master-layout>

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4 class="d-inline ">List Divisi</h4>

                <div class="float-end ">
                    <button class="btn btn-primary action" data-action="{{ route('divisi.create') }}">Tambah Data</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">


                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>



    @push('jsModule')
        @vite(['resources/js/pages/divisi.js'])
    @endpush

    @push('js')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush

</x-master-layout>
