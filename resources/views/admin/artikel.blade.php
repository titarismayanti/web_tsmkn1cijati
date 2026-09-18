@extends('admin.layouts.app')

@section('title', 'Data Artikel - Admin')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/datasekolah.css') }}">
@endpush
<div class="page-header"> <div> <h1>Data Artikel</h1> <p>Kelola berita dan kegiatan sekolah.</p> </div>
<button
    type="button"
    class="btn btn-primary"
    onclick="openModal('modalTambahArtikel')">
    + Tambah Artikel
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
                <th>Judul</th>
                <th>Slug</th>
                <th>Isi</th>
                <th>Gambar</th>
                <th>Tanggal Publish</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse($artikels as $artikel)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                    <strong>{{ $artikel->judul }}</strong>
                </td>

                <td>
                    {{ $artikel->slug }}
                </td>

                <td>
                    {{ \Illuminate\Support\Str::limit(strip_tags($artikel->isi ?? ''), 100) }}
                </td>

                {{-- GAMBAR --}}
                <td>
                    @if(!empty($artikel->gambar))

                        <img
                            src="{{ asset('image/artikel/' . basename($artikel->gambar)) }}"
                            alt="{{ $artikel->judul }}"
                            class="table-image"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">

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

                {{-- TANGGAL --}}
                <td>
                    @if($artikel->tanggal_publish)
                        {{ \Carbon\Carbon::parse($artikel->tanggal_publish)->format('d-m-Y') }}
                    @else
                        -
                    @endif
                </td>

                {{-- KATEGORI --}}
                <td>
                    {{ $artikel->kategori->nama_kategori ?? '-' }}
                </td>

                {{-- AKSI --}}
                <td>
                    <div class="action-buttons">

                        <button
                            type="button"
                            class="btn btn-warning"
                            onclick="openModal('editArtikel{{ $artikel->id }}')">
                            Edit
                        </button>

                        <form
                            action="{{ route('admin.artikel.destroy', $artikel->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus artikel ini? Gambar yang terkait juga akan dihapus.')">

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
                <td colspan="8" class="empty-data">
                    Belum ada data artikel.
                </td>
            </tr>

        @endforelse

        </tbody>
    </table>

</div>

</div>
{{-- =====================================================
MODAL EDIT ARTIKEL
====================================================== --}}

@foreach($artikels as $artikel)

<div class="modal" id="editArtikel{{ $artikel->id }}">
<div class="modal-content">

    <div class="modal-header">

        <h2>Edit Artikel</h2>

        <button
            type="button"
            class="modal-close"
            onclick="closeModal('editArtikel{{ $artikel->id }}')">
            &times;
        </button>

    </div>

    <form
        action="{{ route('admin.artikel.update', $artikel->id) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- JUDUL --}}
        <div class="form-group">

            <label for="judul_{{ $artikel->id }}">
                Judul Artikel
            </label>

            <input
                type="text"
                id="judul_{{ $artikel->id }}"
                name="judul"
                value="{{ $artikel->judul }}"
                required>

        </div>

        {{-- SLUG --}}
        <div class="form-group">

            <label>
                Slug
            </label>

            <input
                type="text"
                value="{{ $artikel->slug }}"
                readonly>

            <small>
                Slug dibuat otomatis dari judul.
            </small>

        </div>

        {{-- ISI --}}
        <div class="form-group">

            <label for="isi_{{ $artikel->id }}">
                Isi Artikel
            </label>

            <textarea
                id="isi_{{ $artikel->id }}"
                name="isi"
                rows="8"
                required>{{ $artikel->isi }}</textarea>

        </div>

        {{-- KATEGORI --}}
        <div class="form-group">

            <label for="kategori_{{ $artikel->id }}">
                Kategori
            </label>

            <select
                id="kategori_{{ $artikel->id }}"
                name="kategori_artikel_id"
                required>

                <option value="">
                    -- Pilih Kategori --
                </option>

                @foreach($kategoriArtikels as $kategori)

                    <option
                        value="{{ $kategori->id }}"
                        {{ $artikel->kategori_artikel_id == $kategori->id ? 'selected' : '' }}>

                        {{ $kategori->nama_kategori }}

                    </option>

                @endforeach

            </select>

        </div>

        {{-- TANGGAL PUBLISH --}}
        <div class="form-group">

            <label for="tanggal_{{ $artikel->id }}">
                Tanggal Publish
            </label>

            <input
                type="date"
                id="tanggal_{{ $artikel->id }}"
                name="tanggal_publish"
                value="{{ $artikel->tanggal_publish ? \Carbon\Carbon::parse($artikel->tanggal_publish)->format('Y-m-d') : '' }}"
                required>

        </div>

        {{-- GAMBAR SAAT INI --}}
        <div class="form-group">

            <label>
                Gambar Saat Ini
            </label>

            @if(!empty($artikel->gambar))

                <img
                    src="{{ asset('image/artikel/' . basename($artikel->gambar)) }}"
                    class="preview-image"
                    alt="{{ $artikel->judul }}"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">

                <span
                    class="no-image"
                    style="display:none;">
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

            <label for="gambar_{{ $artikel->id }}">
                Ganti Gambar
            </label>

            <input
                type="file"
                id="gambar_{{ $artikel->id }}"
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
                onclick="closeModal('editArtikel{{ $artikel->id }}')">
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

{{-- =====================================================
MODAL TAMBAH ARTIKEL
====================================================== --}}

<div class="modal" id="modalTambahArtikel">
<div class="modal-content">

    <div class="modal-header">

        <h2>Tambah Artikel</h2>

        <button
            type="button"
            class="modal-close"
            onclick="closeModal('modalTambahArtikel')">
            &times;
        </button>

    </div>

    <form
        action="{{ route('admin.artikel.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        {{-- JUDUL --}}
        <div class="form-group">

            <label for="judul">
                Judul Artikel
            </label>

            <input
                type="text"
                id="judul"
                name="judul"
                placeholder="Contoh: Kegiatan Sekolah"
                required>

        </div>

        {{-- SLUG --}}
        <div class="form-group">

            <label>
                Slug
            </label>

            <input
                type="text"
                value="Otomatis dibuat dari judul"
                readonly>

            <small>
                Slug akan dibuat otomatis ketika artikel disimpan.
            </small>

        </div>

        {{-- ISI --}}
        <div class="form-group">

            <label for="isi">
                Isi Artikel
            </label>

            <textarea
                id="isi"
                name="isi"
                rows="8"
                placeholder="Tulis isi artikel..."
                required></textarea>

        </div>

        {{-- KATEGORI --}}
        <div class="form-group">

            <label for="kategori_artikel_id">
                Kategori
            </label>

            <select
                id="kategori_artikel_id"
                name="kategori_artikel_id"
                required>

                <option value="">
                    -- Pilih Kategori --
                </option>

                @foreach($kategoriArtikels as $kategori)

                    <option value="{{ $kategori->id }}">
                        {{ $kategori->nama_kategori }}
                    </option>

                @endforeach

            </select>

        </div>

        {{-- TANGGAL --}}
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

        {{-- GAMBAR --}}
        <div class="form-group">

            <label for="gambar">
                Gambar
            </label>

            <input
                type="file"
                id="gambar"
                name="gambar"
                accept=".jpg,.jpeg,.png,.webp">

            <small>
                Format yang didukung: JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
            </small>

        </div>

        <div class="modal-footer">

            <button
                type="button"
                class="btn btn-secondary"
                onclick="closeModal('modalTambahArtikel')">
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

<script> function openModal(id) { const modal = document.getElementById(id); if (modal) { modal.classList.add('show'); } } function closeModal(id) { const modal = document.getElementById(id); if (modal) { modal.classList.remove('show'); } } window.addEventListener('click', function(event) { if (event.target.classList.contains('modal')) { event.target.classList.remove('show'); } }); </script>
@endsection