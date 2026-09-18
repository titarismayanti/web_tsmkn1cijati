@extends('admin.layouts.app')

@section('title', 'Data Siswa - Admin')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/datasekolah.css') }}">
@endpush
<div class="page-header"> <div> <h1>Data Siswa</h1> <p>Kelola jumlah siswa sekolah.</p> </div>

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
                <th>Total Siswa</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($siswas as $siswa)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        <strong>
                            {{ number_format($siswa->total_siswa, 0, ',', '.') }}
                        </strong>
                        siswa
                    </td>

                    <td>
                        <div class="action-buttons">

                            {{-- EDIT --}}
                            <button
                                type="button"
                                class="btn btn-warning"
                                onclick="openModal('editSiswa{{ $siswa->id }}')">
                                Edit
                            </button>

                            {{-- HAPUS --}}
                            <form
                                action="{{ route('admin.siswa.destroy', $siswa->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')">

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
                    <td colspan="3" class="empty-data">
                        Belum ada data siswa.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

</div>
{{-- MODAL EDIT SISWA --}}
@foreach($siswas as $siswa)

<div
    class="modal"
    id="editSiswa{{ $siswa->id }}">

    <div class="modal-content">

        <div class="modal-header">
            <h2>Edit Data Siswa</h2>

            <button
                type="button"
                class="modal-close"
                onclick="closeModal('editSiswa{{ $siswa->id }}')">
                &times;
            </button>
        </div>

        <form
            action="{{ route('admin.siswa.update', $siswa->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="total_siswa_{{ $siswa->id }}">
                    Total Siswa
                </label>

                <input
                    type="number"
                    id="total_siswa_{{ $siswa->id }}"
                    name="total_siswa"
                    value="{{ $siswa->total_siswa }}"
                    min="0"
                    required>
            </div>

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    onclick="closeModal('editSiswa{{ $siswa->id }}')">
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

{{-- MODAL TAMBAH SISWA --}}

<div class="modal" id="modalTambahSiswa">
<div class="modal-content">

    <div class="modal-header">
        <h2>Tambah Data Siswa</h2>

        <button
            type="button"
            class="modal-close"
            onclick="closeModal('modalTambahSiswa')">
            &times;
        </button>
    </div>

    <form
        action="{{ route('admin.siswa.store') }}"
        method="POST">

        @csrf

        <div class="form-group">
            <label for="total_siswa">
                Total Siswa
            </label>

            <input
                type="number"
                id="total_siswa"
                name="total_siswa"
                placeholder="Masukkan total siswa"
                min="0"
                required>
        </div>

        <div class="modal-footer">
            <button
                type="button"
                class="btn btn-secondary"
                onclick="closeModal('modalTambahSiswa')">
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