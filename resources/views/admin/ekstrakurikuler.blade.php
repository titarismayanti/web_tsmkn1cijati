@extends('admin.layouts.app')

@section('title', 'Data Ekstrakurikuler - Admin')

@section('content')

@push('styles')

<link rel="stylesheet" href="{{ asset('css/admin/datasekolah.css') }}"> @endpush
{{-- =========================================================
HEADER
========================================================= --}}

<div class="page-header">
<div>
    <h1>Data Ekstrakurikuler</h1>

    <p>
        Kelola data ekstrakurikuler SMK Negeri 1 Cijati.
    </p>
</div>

<button
    type="button"
    class="btn btn-primary"
    onclick="openModal('modalTambahEskul')">

    + Tambah Ekstrakurikuler

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

                <th>Logo</th>

                <th>Nama Ekstrakurikuler</th>

                <th>Pembina</th>

                <th>Deskripsi</th>

                <th>Aksi</th>

            </tr>

        </thead>

        <tbody>

            @forelse($ekstrakurikulers as $ekskul)

                <tr>

                    {{-- NO --}}
                    <td>
                        {{ $loop->iteration }}
                    </td>

                    {{-- =================================================
                        LOGO
                    ================================================= --}}

                    <td>

                        @if($ekskul->logo)

                            <img
                                src="{{ asset('image/ekskul/' . basename($ekskul->logo)) }}"
                                alt="{{ $ekskul->nama_eskul }}"
                                class="table-image"
                                onerror="
                                    this.style.display='none';
                                    this.nextElementSibling.style.display='inline';
                                "
                            >

                            <span
                                class="no-image"
                                style="display:none;">
                                Logo tidak ditemukan
                            </span>

                        @else

                            <span class="no-image">
                                Tidak ada logo
                            </span>

                        @endif

                    </td>

                    {{-- =================================================
                        NAMA EKSTRAKURIKULER
                    ================================================= --}}

                    <td>

                        <strong>
                            {{ $ekskul->nama_eskul }}
                        </strong>

                    </td>

                    {{-- =================================================
                        PEMBINA DARI RELASI GURU
                    ================================================= --}}

                    <td>

                        @if($ekskul->guru)

                            {{ $ekskul->guru->nama_guru }}

                        @else

                            <span class="no-image">
                                Belum ada pembina
                            </span>

                        @endif

                    </td>

                    {{-- =================================================
                        DESKRIPSI
                    ================================================= --}}

                    <td>

                        {{ \Illuminate\Support\Str::limit(
                            $ekskul->deskripsi ?? '-',
                            100
                        ) }}

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
                                onclick="openModal('editEskul{{ $ekskul->id }}')">

                                Edit

                            </button>

                            {{-- HAPUS --}}
                            <form
                                action="{{ route(
                                    'admin.ekstrakurikuler.destroy',
                                    $ekskul->id
                                ) }}"
                                method="POST"
                                onsubmit="
                                    return confirm(
                                        'Yakin ingin menghapus ekstrakurikuler ini?'
                                    )
                                "
                            >

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
                        colspan="6"
                        class="empty-data">

                        Belum ada data ekstrakurikuler.

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

@foreach($ekstrakurikulers as $ekskul)

<div class="modal" id="editEskul{{ $ekskul->id }}">
<div class="modal-content">

    {{-- HEADER --}}
    <div class="modal-header">

        <h2>
            Edit Ekstrakurikuler
        </h2>

        <button
            type="button"
            class="modal-close"
            onclick="closeModal('editEskul{{ $ekskul->id }}')">

            &times;

        </button>

    </div>

    {{-- FORM --}}
    <form
        action="{{ route(
            'admin.ekstrakurikuler.update',
            $ekskul->id
        ) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        @method('PUT')

        {{-- NAMA --}}
        <div class="form-group">

            <label for="nama_eskul_{{ $ekskul->id }}">
                Nama Ekstrakurikuler
            </label>

            <input
                type="text"
                id="nama_eskul_{{ $ekskul->id }}"
                name="nama_eskul"
                value="{{ old(
                    'nama_eskul',
                    $ekskul->nama_eskul
                ) }}"
                required>

        </div>

        {{-- PEMBINA --}}
        <div class="form-group">

            <label for="guru_id_{{ $ekskul->id }}">
                Pembina
            </label>

            <select
                id="guru_id_{{ $ekskul->id }}"
                name="guru_id"
                required>

                <option value="">
                    -- Pilih Guru --
                </option>

                @foreach($gurus as $guru)

                    <option
                        value="{{ $guru->id }}"
                        {{ $ekskul->guru_id == $guru->id
                            ? 'selected'
                            : '' }}>

                        {{ $guru->nama_guru }}

                    </option>

                @endforeach

            </select>

        </div>

        {{-- DESKRIPSI --}}
        <div class="form-group">

            <label for="deskripsi_{{ $ekskul->id }}">
                Deskripsi
            </label>

            <textarea
                id="deskripsi_{{ $ekskul->id }}"
                name="deskripsi"
                rows="5"
                placeholder="Deskripsi ekstrakurikuler">{{ old(
                    'deskripsi',
                    $ekskul->deskripsi
                ) }}</textarea>

        </div>

        {{-- =================================================
            LOGO SAAT INI
        ================================================= --}}

        <div class="form-group">

            <label>
                Logo Saat Ini
            </label>

            @if($ekskul->logo)

                <img
                    src="{{ asset(
                        'image/ekskul/' .
                        basename($ekskul->logo)
                    ) }}"
                    alt="{{ $ekskul->nama_eskul }}"
                    class="preview-image"
                    onerror="
                        this.style.display='none';
                        this.nextElementSibling.style.display='inline';
                    "
                >

                <span
                    class="no-image"
                    style="display:none;">

                    Logo tidak ditemukan

                </span>

            @else

                <span class="no-image">
                    Belum ada logo.
                </span>

            @endif

        </div>

        {{-- =================================================
            GANTI LOGO
        ================================================= --}}

        <div class="form-group">

            <label for="logo_{{ $ekskul->id }}">
                Ganti Logo
            </label>

            <input
                type="file"
                id="logo_{{ $ekskul->id }}"
                name="logo"
                accept=".jpg,.jpeg,.png,.webp">

            <small>
                Kosongkan jika tidak ingin mengganti logo.
            </small>

        </div>

        {{-- FOOTER --}}
        <div class="modal-footer">

            <button
                type="button"
                class="btn btn-secondary"
                onclick="closeModal('editEskul{{ $ekskul->id }}')">

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

<div class="modal" id="modalTambahEskul">
<div class="modal-content">

    {{-- HEADER --}}
    <div class="modal-header">

        <h2>
            Tambah Ekstrakurikuler
        </h2>

        <button
            type="button"
            class="modal-close"
            onclick="closeModal('modalTambahEskul')">

            &times;

        </button>

    </div>

    {{-- FORM --}}
    <form
        action="{{ route(
            'admin.ekstrakurikuler.store'
        ) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        {{-- NAMA --}}
        <div class="form-group">

            <label for="nama_eskul">
                Nama Ekstrakurikuler
            </label>

            <input
                type="text"
                id="nama_eskul"
                name="nama_eskul"
                value="{{ old('nama_eskul') }}"
                placeholder="Contoh: Pramuka"
                required>

        </div>

        {{-- PEMBINA --}}
        <div class="form-group">

            <label for="guru_id">
                Pembina
            </label>

            <select
                id="guru_id"
                name="guru_id"
                required>

                <option value="">
                    -- Pilih Guru --
                </option>

                @foreach($gurus as $guru)

                    <option
                        value="{{ $guru->id }}"
                        {{ old('guru_id') == $guru->id
                            ? 'selected'
                            : '' }}>

                        {{ $guru->nama_guru }}

                    </option>

                @endforeach

            </select>

        </div>

        {{-- DESKRIPSI --}}
        <div class="form-group">

            <label for="deskripsi">
                Deskripsi
            </label>

            <textarea
                id="deskripsi"
                name="deskripsi"
                rows="5"
                placeholder="Deskripsi ekstrakurikuler">{{ old('deskripsi') }}</textarea>

        </div>

        {{-- LOGO --}}
        <div class="form-group">

            <label for="logo">
                Logo
            </label>

            <input
                type="file"
                id="logo"
                name="logo"
                accept=".jpg,.jpeg,.png,.webp">

            <small>
                Format: JPG, JPEG, PNG, WEBP.
                Maksimal 2 MB.
            </small>

        </div>

        {{-- FOOTER --}}
        <div class="modal-footer">

            <button
                type="button"
                class="btn btn-secondary"
                onclick="closeModal('modalTambahEskul')">

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

window.addEventListener('click', function(event)
{
if (event.target.classList.contains('modal')) {

    event.target.classList.remove('show');

}

});

</script>
@endsection