@extends('admin.layouts.app')

@section('title', 'Data Fasilitas - Admin')

@section('content')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/datasekolah.css') }}">
@endpush


{{-- =========================================================
    HEADER
========================================================= --}}

<div class="page-header">

    <div>
        <h1>Data Fasilitas</h1>

        <p>
            Kelola data fasilitas sekolah.
        </p>
    </div>

    <button
        type="button"
        class="btn btn-primary"
        onclick="openModal('modalTambahFasilitas')">
        + Tambah Fasilitas
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

                    <th>Nama Fasilitas</th>

                    <th>Aksi</th>

                </tr>

            </thead>


            <tbody>

                @forelse($fasilitas as $item)

                    <tr>

                        {{-- NO --}}

                        <td>
                            {{ $loop->iteration }}
                        </td>


                        {{-- GAMBAR --}}

                        <td>

                            @if($item->gambar)

                                <img
                                    src="{{ asset('image/fasilitas/' . basename($item->gambar)) }}"
                                    alt="{{ $item->nama_fasilitas }}"
                                    class="table-image"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">

                                <span
                                    class="no-image"
                                    style="display: none;">
                                    Gambar tidak ditemukan
                                </span>

                            @else

                                <span class="no-image">
                                    Tidak ada gambar
                                </span>

                            @endif

                        </td>


                        {{-- NAMA FASILITAS --}}

                        <td>
                            {{ $item->nama_fasilitas }}
                        </td>


                        {{-- AKSI --}}

                        <td>

                            <div class="action-buttons">

                                {{-- EDIT --}}

                                <button
                                    type="button"
                                    class="btn btn-warning"
                                    onclick="openModal('editFasilitas{{ $item->id }}')">
                                    Edit
                                </button>


                                {{-- HAPUS --}}

                                <form
                                    action="{{ route('admin.fasilitas.destroy', $item->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus fasilitas ini? Gambar yang terkait juga akan dihapus.')">

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
                            colspan="4"
                            class="empty-data">

                            Belum ada data fasilitas.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- =========================================================
    MODAL EDIT FASILITAS
========================================================= --}}

@foreach($fasilitas as $item)

    <div
        class="modal"
        id="editFasilitas{{ $item->id }}">

        <div class="modal-content">


            {{-- HEADER MODAL --}}

            <div class="modal-header">

                <h2>
                    Edit Fasilitas
                </h2>

                <button
                    type="button"
                    class="modal-close"
                    onclick="closeModal('editFasilitas{{ $item->id }}')">

                    &times;

                </button>

            </div>


            {{-- FORM EDIT --}}

            <form
                action="{{ route('admin.fasilitas.update', $item->id) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                @method('PUT')


                {{-- NAMA FASILITAS --}}

                <div class="form-group">

                    <label for="nama_fasilitas_{{ $item->id }}">
                        Nama Fasilitas
                    </label>

                    <input
                        type="text"
                        id="nama_fasilitas_{{ $item->id }}"
                        name="nama_fasilitas"
                        value="{{ $item->nama_fasilitas }}"
                        placeholder="Contoh: Laboratorium Komputer"
                        required>

                </div>


                {{-- GAMBAR SAAT INI --}}

                <div class="form-group">

                    <label>
                        Gambar Saat Ini
                    </label>

                    @if($item->gambar)

                        <img
                            src="{{ asset('image/fasilitas/' . basename($item->gambar)) }}"
                            class="preview-image"
                            alt="{{ $item->nama_fasilitas }}"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">

                        <span
                            class="no-image"
                            style="display: none;">
                            Gambar tidak ditemukan
                        </span>

                    @else

                        <span class="no-image">
                            Belum ada gambar.
                        </span>

                    @endif

                </div>


                {{-- GANTI GAMBAR --}}

                <div class="form-group">

                    <label for="gambar_{{ $item->id }}">
                        Ganti Gambar
                    </label>

                    <input
                        type="file"
                        id="gambar_{{ $item->id }}"
                        name="gambar"
                        accept=".jpg,.jpeg,.png,.webp">

                    <small>
                        Kosongkan jika tidak ingin mengganti gambar.
                    </small>

                </div>


                {{-- FOOTER MODAL --}}

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        onclick="closeModal('editFasilitas{{ $item->id }}')">

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
    MODAL TAMBAH FASILITAS
========================================================= --}}

<div
    class="modal"
    id="modalTambahFasilitas">

    <div class="modal-content">


        {{-- HEADER MODAL --}}

        <div class="modal-header">

            <h2>
                Tambah Fasilitas
            </h2>

            <button
                type="button"
                class="modal-close"
                onclick="closeModal('modalTambahFasilitas')">

                &times;

            </button>

        </div>


        {{-- FORM TAMBAH --}}

        <form
            action="{{ route('admin.fasilitas.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf


            {{-- NAMA FASILITAS --}}

            <div class="form-group">

                <label for="nama_fasilitas">
                    Nama Fasilitas
                </label>

                <input
                    type="text"
                    id="nama_fasilitas"
                    name="nama_fasilitas"
                    placeholder="Contoh: Laboratorium Komputer"
                    required>

            </div>


            {{-- GAMBAR --}}

            <div class="form-group">

                <label for="gambar">
                    Gambar
                </label>

                <input
                    type="file"
                    id="gambar"
                    name="gambar"
                    accept=".jpg,.jpeg,.png,.webp"
                    required>

                <small>
                    Format yang didukung: JPG, JPEG, PNG, WEBP.
                    Maksimal 2 MB.
                </small>

            </div>


            {{-- FOOTER MODAL --}}

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    onclick="closeModal('modalTambahFasilitas')">

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
    JAVASCRIPT MODAL
========================================================= --}}

<script>

function openModal(id) {

    const modal = document.getElementById(id);

    if (modal) {

        modal.classList.add('show');

    }

}


function closeModal(id) {

    const modal = document.getElementById(id);

    if (modal) {

        modal.classList.remove('show');

    }

}


window.addEventListener('click', function(event) {

    if (event.target.classList.contains('modal')) {

        event.target.classList.remove('show');

    }

});

</script>

@endsection
