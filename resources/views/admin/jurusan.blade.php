@extends('admin.layouts.app')

@section('title', 'Data Jurusan - Admin')

@section('content')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/datasekolah.css') }}">
@endpush


<div class="page-header">

    <div>
        <h1>Data Jurusan</h1>
        <p>Kelola data jurusan sekolah.</p>
    </div>

    <button
        type="button"
        class="btn btn-primary"
        onclick="openModal('modalTambahJurusan')">
        + Tambah Jurusan
    </button>

</div>


{{-- =========================================================
     SUCCESS
========================================================= --}}

@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


{{-- =========================================================
     ERROR
========================================================= --}}

@if($errors->any())

    <div class="alert alert-danger">

        <ul>

            @foreach($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif



{{-- =========================================================
     TABLE
========================================================= --}}

<div class="card">

    <div class="table-wrapper">

        <table>

            <thead>

                <tr>

                    <th>No</th>

                    <th>Gambar</th>

                    <th>Nama Jurusan</th>

                    <th>Kepala Program</th>

                    <th>Singkatan</th>

                    <th>Deskripsi</th>

                    <th>Aksi</th>

                </tr>

            </thead>


            <tbody>

            @forelse($jurusans as $jurusan)

                <tr>

                    {{-- NO --}}
                    <td>
                        {{ $loop->iteration }}
                    </td>


                    {{-- =================================================
                         GAMBAR
                    ================================================= --}}

                    <td>

                        @if($jurusan->gambar)

                            <img
                                src="{{ asset('image/jurusan/' . basename($jurusan->gambar)) }}"
                                alt="{{ $jurusan->nama_jurusan }}"
                                class="table-image"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';"
                            >

                            <span
                                class="no-image"
                                style="display:none;">
                                Gambar tidak ditemukan
                            </span>

                        @else

                            <span class="no-image">
                                Tidak ada gambar
                            </span>

                        @endif

                    </td>



                    {{-- NAMA JURUSAN --}}
                    <td>
                        {{ $jurusan->nama_jurusan }}
                    </td>


                    {{-- =================================================
                         KEPALA PROGRAM
                    ================================================= --}}

                    <td>

                        @if($jurusan->kepalaProgram)

                            {{ $jurusan->kepalaProgram->nama_guru }}

                        @else

                            <span class="no-image">
                                Belum dipilih
                            </span>

                        @endif

                    </td>


                    {{-- SINGKATAN --}}
                    <td>
                        {{ $jurusan->singkatan }}
                    </td>


                    {{-- DESKRIPSI --}}
                    <td>
                        {{ $jurusan->deskripsi ?? '-' }}
                    </td>


                    {{-- =================================================
                         AKSI
                    ================================================= --}}

                    <td>

                        <div class="action-buttons">


                            {{-- EDIT --}}

                            <button
                                type="button"
                                class="btn btn-warning"
                                onclick="openModal('editJurusan{{ $jurusan->id }}')">

                                Edit

                            </button>



                            {{-- HAPUS --}}

                            <form
                                action="{{ route('admin.jurusan.destroy', $jurusan->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus jurusan ini beserta gambar dan fotonya?')">

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger">

                                    Hapus

                                </button>

                            </form>


                        </div>

                    </td>

                </tr>


            @empty

                <tr>

                    <td
                        colspan="8"
                        class="empty-data">

                        Belum ada data jurusan.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>



{{-- =========================================================
     MODAL EDIT
========================================================= --}}

@foreach($jurusans as $jurusan)

<div
    class="modal"
    id="editJurusan{{ $jurusan->id }}">

    <div class="modal-content">


        {{-- HEADER --}}

        <div class="modal-header">

            <h2>
                Edit Jurusan
            </h2>

            <button
                type="button"
                class="modal-close"
                onclick="closeModal('editJurusan{{ $jurusan->id }}')">

                &times;

            </button>

        </div>



        {{-- FORM --}}

        <form
            action="{{ route('admin.jurusan.update', $jurusan->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            @method('PUT')



            {{-- =====================================================
                 NAMA JURUSAN
            ===================================================== --}}

            <div class="form-group">

                <label>
                    Nama Jurusan
                </label>

                <input
                    type="text"
                    name="nama_jurusan"
                    value="{{ $jurusan->nama_jurusan }}"
                    required>

            </div>



            {{-- =====================================================
                 KEPALA PROGRAM
            ===================================================== --}}

            <div class="form-group">

                <label>
                    Kepala Program
                </label>

                <select
                    name="guru_id"
                    required>

                    <option value="">
                        -- Pilih Kepala Program --
                    </option>


                    @foreach($gurus as $guru)

                        <option
                            value="{{ $guru->id }}"
                            {{ old('guru_id', $jurusan->guru_id) == $guru->id ? 'selected' : '' }}>

                            {{ $guru->nama_guru }}

                        </option>

                    @endforeach

                </select>

            </div>



            {{-- =====================================================
                 SINGKATAN
            ===================================================== --}}

            <div class="form-group">

                <label>
                    Singkatan
                </label>

                <input
                    type="text"
                    name="singkatan"
                    value="{{ $jurusan->singkatan }}"
                    required>

            </div>



            {{-- =====================================================
                 DESKRIPSI
            ===================================================== --}}

            <div class="form-group">

                <label>
                    Deskripsi
                </label>

                <textarea
                    name="deskripsi"
                    rows="4">{{ $jurusan->deskripsi }}</textarea>

            </div>



            {{-- =====================================================
                 GAMBAR SAAT INI
            ===================================================== --}}

            <div class="form-group">

                <label>
                    Gambar Saat Ini
                </label>


                @if($jurusan->gambar)

                    <img
                        src="{{ asset('image/jurusan/' . basename($jurusan->gambar)) }}"
                        class="preview-image"
                        alt="Gambar {{ $jurusan->nama_jurusan }}"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                    >

                    <span
                        class="no-image"
                        style="display:none;">

                        File gambar tidak ditemukan.

                    </span>

                @else

                    <span class="no-image">
                        Belum ada gambar.
                    </span>

                @endif

            </div>



            {{-- =====================================================
                 GANTI GAMBAR
            ===================================================== --}}

            <div class="form-group">

                <label>
                    Ganti Gambar
                </label>

                <input
                    type="file"
                    name="gambar"
                    accept=".jpg,.jpeg,.png,.webp">

                <small>
                    Kosongkan jika tidak ingin mengganti gambar.
                    Maksimal 2 MB.
                </small>

            </div>




            {{-- =====================================================
                 FOOTER
            ===================================================== --}}

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    onclick="closeModal('editJurusan{{ $jurusan->id }}')">

                    Batal

                </button>


                <button
                    type="submit"
                    class="btn btn-primary">

                    Simpan Perubahan

                </button>

            </div>


        </form>

    </div>

</div>

@endforeach



{{-- =========================================================
     MODAL TAMBAH
========================================================= --}}

<div
    class="modal"
    id="modalTambahJurusan">

    <div class="modal-content">


        {{-- HEADER --}}

        <div class="modal-header">

            <h2>
                Tambah Jurusan
            </h2>

            <button
                type="button"
                class="modal-close"
                onclick="closeModal('modalTambahJurusan')">

                &times;

            </button>

        </div>



        {{-- FORM --}}

        <form
            action="{{ route('admin.jurusan.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf



            {{-- =====================================================
                 NAMA JURUSAN
            ===================================================== --}}

            <div class="form-group">

                <label>
                    Nama Jurusan
                </label>

                <input
                    type="text"
                    name="nama_jurusan"
                    value="{{ old('nama_jurusan') }}"
                    placeholder="Contoh: Rekayasa Perangkat Lunak"
                    required>

            </div>



            {{-- =====================================================
                 KEPALA PROGRAM
            ===================================================== --}}

            <div class="form-group">

                <label>
                    Kepala Program
                </label>

                <select
                    name="guru_id"
                    required>

                    <option value="">
                        -- Pilih Kepala Program --
                    </option>


                    @foreach($gurus as $guru)

                        <option
                            value="{{ $guru->id }}"
                            {{ old('guru_id') == $guru->id ? 'selected' : '' }}>

                            {{ $guru->nama_guru }}

                        </option>

                    @endforeach

                </select>

            </div>



            {{-- =====================================================
                 SINGKATAN
            ===================================================== --}}

            <div class="form-group">

                <label>
                    Singkatan
                </label>

                <input
                    type="text"
                    name="singkatan"
                    value="{{ old('singkatan') }}"
                    placeholder="Contoh: RPL"
                    required>

            </div>



            {{-- =====================================================
                 DESKRIPSI
            ===================================================== --}}

            <div class="form-group">

                <label>
                    Deskripsi
                </label>

                <textarea
                    name="deskripsi"
                    rows="4"
                    placeholder="Deskripsi jurusan">{{ old('deskripsi') }}</textarea>

            </div>



            {{-- =====================================================
                 GAMBAR
            ===================================================== --}}

            <div class="form-group">

                <label>
                    Gambar
                </label>

                <input
                    type="file"
                    name="gambar"
                    accept=".jpg,.jpeg,.png,.webp">

                <small>
                    Format: JPG, JPEG, PNG, atau WEBP.
                    Maksimal 2 MB.
                </small>

            </div>


            {{-- =====================================================
                 FOOTER
            ===================================================== --}}

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    onclick="closeModal('modalTambahJurusan')">

                    Batal

                </button>


                <button
                    type="submit"
                    class="btn btn-primary">

                    Simpan

                </button>

            </div>


        </form>

    </div>

</div>



{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script>

function openModal(id)
{
    const modal = document.getElementById(id);

    if (modal) {

        modal.classList.add('show');

    }
}


function closeModal(id)
{
    const modal = document.getElementById(id);

    if (modal) {

        modal.classList.remove('show');

    }
}


/*
|--------------------------------------------------------------------------
| Klik di luar modal
|--------------------------------------------------------------------------
*/

window.addEventListener('click', function(event)
{
    if (event.target.classList.contains('modal')) {

        event.target.classList.remove('show');

    }
});


/*
|--------------------------------------------------------------------------
| Tombol ESC
|--------------------------------------------------------------------------
*/

window.addEventListener('keydown', function(event)
{
    if (event.key === 'Escape') {

        document
            .querySelectorAll('.modal.show')
            .forEach(function(modal) {

                modal.classList.remove('show');

            });

    }
});

</script>


@endsection