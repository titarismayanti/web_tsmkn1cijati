@extends('admin.layouts.app')


@section('title', 'Data Kontak - Admin')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/datasekolah.css') }}">
@endpush
<div class="page-header">
<div>
    <h1>Data Kontak</h1>
    <p>Kelola pesan dan informasi kontak dari pengunjung.</p>
</div>

</div>
{{-- SUCCESS ALERT --}}
@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif

{{-- ERROR ALERT --}}
@if($errors->any())

<div class="alert alert-danger">

    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

</div>

@endif

{{-- DATA TABLE --}}

<div class="card">
<div class="table-wrapper">

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Pesan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse($kontaks as $kontak)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $kontak->nama }}
                </td>

                <td>
                    {{ $kontak->email }}
                </td>

                <td>
                    {{ \Illuminate\Support\Str::limit($kontak->pesan, 150) }}
                </td>

                <td>

                    <div class="action-buttons">

                        {{-- EDIT --}}
                        <button
                            type="button"
                            class="btn btn-warning"
                            onclick="openModal('editKontak{{ $kontak->id }}')">
                            Edit
                        </button>

                        {{-- HAPUS --}}
                        <form
                            action="{{ route('admin.kontak.destroy', $kontak->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus pesan kontak ini?')">

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
                    colspan="5"
                    class="empty-data">
                    Belum ada pesan kontak.
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

</div>
{{-- =================================================
MODAL EDIT KONTAK
================================================= --}}

@foreach($kontaks as $kontak)

<div class="modal" id="editKontak{{ $kontak->id }}">
<div class="modal-content">

    <div class="modal-header">

        <h2>Edit Kontak</h2>

        <button
            type="button"
            class="modal-close"
            onclick="closeModal('editKontak{{ $kontak->id }}')">
            &times;
        </button>

    </div>

    <form
        action="{{ route('admin.kontak.update', $kontak->id) }}"
        method="POST">

        @csrf
        @method('PUT')

        <div class="form-group">

            <label>
                Nama
            </label>

            <input
                type="text"
                name="nama"
                value="{{ $kontak->nama }}"
                required>

        </div>

        <div class="form-group">

            <label>
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ $kontak->email }}"
                required>

        </div>

        <div class="form-group">

            <label>
                Pesan
            </label>

            <textarea
                name="pesan"
                rows="6"
                required>{{ $kontak->pesan }}</textarea>

        </div>

        <div class="modal-footer">

            <button
                type="button"
                class="btn btn-secondary"
                onclick="closeModal('editKontak{{ $kontak->id }}')">
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

{{-- =================================================
MODAL TAMBAH KONTAK
================================================= --}}

<div class="modal" id="modalTambahKontak">
<div class="modal-content">

    <div class="modal-header">

        <h2>Tambah Kontak</h2>

        <button
            type="button"
            class="modal-close"
            onclick="closeModal('modalTambahKontak')">
            &times;
        </button>

    </div>

    <form
        action="{{ route('admin.kontak.store') }}"
        method="POST">

        @csrf

        <div class="form-group">

            <label>
                Nama
            </label>

            <input
                type="text"
                name="nama"
                placeholder="Nama pengirim"
                required>

        </div>

        <div class="form-group">

            <label>
                Email
            </label>

            <input
                type="email"
                name="email"
                placeholder="contoh@email.com"
                required>

        </div>

        <div class="form-group">

            <label>
                Pesan
            </label>

            <textarea
                name="pesan"
                rows="6"
                placeholder="Tulis pesan..."
                required></textarea>

        </div>

        <div class="modal-footer">

            <button
                type="button"
                class="btn btn-secondary"
                onclick="closeModal('modalTambahKontak')">
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
{{-- =================================================
JAVASCRIPT MODAL
================================================= --}}

<script> function openModal(id) { const modal = document.getElementById(id); if (modal) { modal.classList.add('show'); } } function closeModal(id) { const modal = document.getElementById(id); if (modal) { modal.classList.remove('show'); } } window.addEventListener('click', function(event) { if (event.target.classList.contains('modal')) { event.target.classList.remove('show'); } }); </script>
@endsection