<x-modal title="Form User" action="{{ $action }}">

    @if ($data->id)
        @method('PUT')
    @endif

    <div class="row">

        <div class="col-md-6">
            <x-forms.input label="Nama" name="nama" value="{{ $data->nama }}" />
        </div>

        <div class="col-md-6">
            <x-forms.input label="Email" name="email" value="{{ $data->email }}" />
        </div>

        <div class="col-md-6">
            <x-forms.input type="password" label="Password" name="password" />
        </div>

        <div class="col-md-6">
            <x-forms.input type="password" label="Password Confirmation" name="password_confirmation" />
        </div>

        <div class="col-md-12">
            <x-forms.radio value="{{ $data->karyawan?->jenis_kelamin }}" :options="$jenisKelamin" label="Jenis Kelamin"
                name="jenis_kelamin" />
        </div>

        <div class="col-md-6">
            <x-forms.select name="divisi" label="Divisi">
                <option selected disabled>-- Choose --</option>
                @foreach ($divisi as $item)
                    <option value="{{ $item->id }}" @selected($data->karyawan?->divisi_id == $item->id)>{{ $item->nama }}</option>
                @endforeach
            </x-forms.select>
        </div>

        <div class="col-md-6">
            <x-forms.select name="status_karyawan" label="Status Karyawan">
                <option selected disabled>-- Choose --</option>
                @foreach (['Tetap' => 'tetap', 'Kontrak' => 'kontrak', 'Training' => 'training'] as $key => $value)
                    <option value="{{ $value }}" @selected($data->karyawan?->status_karyawan == $value)>{{ $key }}</option>
                @endforeach
            </x-forms.select>
        </div>

        <div class="col-md-6">
            <x-forms.datepicker label="Tanggal Masuk" name="tanggal_masuk"
                value="{{ $data->karyawan?->tanggal_masuk }}" />
        </div>

        <hr class="my-3" />

        <div class="col 12">
            <button type="button" class="btn btn-info add-atasan mb-3"
                data-action="{{ route('users.list-atasan') }}">Tambah
                Atasan</button>


            <table class="table">
                <thead>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                </thead>

                <tbody id="listAtasan">

                    @foreach ($data->atasan as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <input type="text" class="form-control" name="atasan[{{ $item->id }}]"
                                    value="{{ $item->pivot->level }}">
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</x-modal>
