@extends('admin.layouts.app')

@section('title', 'Data Galeri - Admin')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/datasekolah.css') }}">
@endpush
<div class="page-header"> <div> <h1>Data Galeri</h1> <p>Kelola foto dan dokumentasi kegiatan sekolah.</p> </div>
<button
    type="button"
    class="btn btn-primary"
    onclick="openModal('modalTambahGaleri')">
    + Tambah Galeri
</button>

</div>
{{-- SUCCESS --}}
@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

{{-- ERROR --}}
@if($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

{{-- TABLE --}}

<div class="card"> <div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Tanggal Publish</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($galeris as $galeri)

                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>

                    {{-- GAMBAR --}}
                    <td>
                        @if($galeri->gambar)

                            <img
                                src="{{ asset('image/galeri/' . basename($galeri->gambar)) }}"
                                alt="{{ $galeri->judul }}"
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

                    {{-- JUDUL --}}
                    <td>
                        {{ $galeri->judul }}
                    </td>

                    {{-- DESKRIPSI --}}
                    <td>
                        {{ \Illuminate\Support\Str::limit($galeri->deskripsi ?? '-', 100) }}
                    </td>

                    {{-- TANGGAL --}}
                    <td>
                        {{ $galeri->tanggal_publish
                            ? $galeri->tanggal_publish->format('d-m-Y')
                            : '-' }}
                    </td>

                    {{-- AKSI --}}
                    <td>
                        <div class="action-buttons">

                            <button
                                type="button"
                                class="btn btn-warning"
                                onclick="openModal('editGaleri{{ $galeri->id }}')">
                                Edit
                            </button>

                            <form
                                action="{{ route('admin.galeri.destroy', $galeri->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus galeri ini? Gambar yang terkait juga akan dihapus.')">

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
                    <td colspan="6" class="empty-data">
                        Belum ada data galeri.
                    </td>
                </tr>

            @endforelse
        </tbody>
    </table>

</div>

</div>
{{-- MODAL EDIT GALERI --}}
@foreach($galeris as $galeri)

<div
    class="modal"
    id="editGaleri{{ $galeri->id }}">

    <div class="modal-content">

        <div class="modal-header">
            <h2>Edit Galeri</h2>

            <button
                type="button"
                class="modal-close"
                onclick="closeModal('editGaleri{{ $galeri->id }}')">
                &times;
            </button>
        </div>

        <form
            action="{{ route('admin.galeri.update', $galeri->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="judul_{{ $galeri->id }}">
                    Judul Galeri
                </label>

                <input
                    type="text"
                    id="judul_{{ $galeri->id }}"
                    name="judul"
                    value="{{ $galeri->judul }}"
                    required>
            </div>

            <div class="form-group">
                <label for="deskripsi_{{ $galeri->id }}">
                    Deskripsi
                </label>

                <textarea
                    id="deskripsi_{{ $galeri->id }}"
                    name="deskripsi"
                    rows="5"
                    placeholder="Deskripsi galeri">{{ $galeri->deskripsi }}</textarea>
            </div>

            <div class="form-group">
                <label for="tanggal_publish_{{ $galeri->id }}">
                    Tanggal Publish
                </label>

                <input
                    type="date"
                    id="tanggal_publish_{{ $galeri->id }}"
                    name="tanggal_publish"
                    value="{{ $galeri->tanggal_publish ? $galeri->tanggal_publish->format('Y-m-d') : '' }}"
                    required>
            </div>

            {{-- GAMBAR SAAT INI --}}
            <div class="form-group">
                <label>Gambar Saat Ini</label>

                @if($galeri->gambar)

                    <img
                        src="{{ asset('image/galeri/' . basename($galeri->gambar)) }}"
                        class="preview-image"
                        alt="{{ $galeri->judul }}"
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
                <label for="gambar_{{ $galeri->id }}">
                    Ganti Gambar
                </label>

                <input
                    type="file"
                    id="gambar_{{ $galeri->id }}"
                    name="gambar"
                    accept=".jpg,.jpeg,.png,.webp">

                <small>
                    Kosongkan jika tidak ingin mengganti gambar.
                </small>
            </div>

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    onclick="closeModal('editGaleri{{ $galeri->id }}')">
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

{{-- MODAL TAMBAH GALERI --}}

<div class="modal" id="modalTambahGaleri">
<div class="modal-content">

    <div class="modal-header">
        <h2>Tambah Galeri</h2>

        <button
            type="button"
            class="modal-close"
            onclick="closeModal('modalTambahGaleri')">
            &times;
        </button>
    </div>

    <form
        action="{{ route('admin.galeri.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="judul">
                Judul Galeri
            </label>

            <input
                type="text"
                id="judul"
                name="judul"
                placeholder="Contoh: Kegiatan Upacara Sekolah"
                required>
        </div>

        <div class="form-group">
            <label for="deskripsi">
                Deskripsi
            </label>

            <textarea
                id="deskripsi"
                name="deskripsi"
                rows="5"
                placeholder="Deskripsi foto atau kegiatan"></textarea>
        </div>

        <div class="form-group">
            <label for="tanggal_publish">
                Tanggal Publish
            </label>

            <input
                type="date"
                id="tanggal_publish"
                name="tanggal_publish"
                value="{{ date('Y-m-d') }}"
                required>
        </div>

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

        <div class="modal-footer">
            <button
                type="button"
                class="btn btn-secondary"
                onclick="closeModal('modalTambahGaleri')">
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
{{-- JAVASCRIPT MODAL --}}

<script> function openModal(id) { const modal = document.getElementById(id); if (modal) { modal.classList.add('show'); } } function closeModal(id) { const modal = document.getElementById(id); if (modal) { modal.classList.remove('show'); } } window.addEventListener('click', function (event) { if (event.target.classList.contains('modal')) { event.target.classList.remove('show'); } }); </script>
@endsection