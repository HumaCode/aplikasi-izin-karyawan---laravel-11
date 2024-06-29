<x-master-layout>

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4 class="d-inline ">Setup Aplikasi</h4>

                <div class="float-end ">
                    <button class="btn btn-primary action" data-action="{{ route('setup-aplikasi.create') }}">Tambah
                        Data</button>
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
        @vite(['resources/js/pages/setup-aplikasi.js'])
    @endpush

    @push('js')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush

</x-master-layout>
