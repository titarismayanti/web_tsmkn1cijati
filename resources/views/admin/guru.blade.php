@extends('admin.layouts.app')

@section('title', 'Data Guru - Admin')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/datasekolah.css') }}">
@endpush
{{-- PAGE HEADER --}}
<div class="page-header">

    <div>
        <h1>Data Guru</h1>
        <p>Kelola data guru sekolah.</p>
    </div>

    <button
        type="button"
        class="btn btn-primary"
        onclick="openModal('modalTambahGuru')">
        + Tambah Guru
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
<div class="card">

    <div class="table-wrapper">

        <table>

            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Guru</th>
                    <th>Jabatan</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($gurus as $guru)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $guru->nip }}
                    </td>

                    <td>
                        {{ $guru->nama_guru }}
                    </td>

                    <td>

                        @if(strtolower($guru->jabatan) === 'kepala sekolah')

                            <div class="guru-profile">

                                <img
                                    src="{{ asset('image/kepsek.jpg') }}"
                                    alt="Kepala Sekolah"
                                    class="guru-photo">

                                <span>
                                    {{ $guru->jabatan }}
                                </span>

                            </div>

                        @else

                            {{ $guru->jabatan }}

                        @endif

                    </td>

                    <td>

                        @if($guru->jenis_kelamin === 'L')
                            Laki-laki
                        @else
                            Perempuan
                        @endif

                    </td>

                    <td>

                        <div class="action-buttons">

                            {{-- EDIT --}}
                            <button
                                type="button"
                                class="btn btn-warning"
                                onclick="openModal('editGuru{{ $guru->id }}')">
                                Edit
                            </button>


                            {{-- HAPUS --}}
                            <form
                                action="{{ route('admin.guru.destroy', $guru->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus data guru ini?')">

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
                        Belum ada data guru.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- =====================================================
     MODAL EDIT GURU
====================================================== --}}

@foreach($gurus as $guru)

    <div
        class="modal"
        id="editGuru{{ $guru->id }}">

        <div class="modal-content">

            <div class="modal-header">

                <h2>Edit Data Guru</h2>

                <button
                    type="button"
                    class="modal-close"
                    onclick="closeModal('editGuru{{ $guru->id }}')">
                    &times;
                </button>

            </div>


            <form
                action="{{ route('admin.guru.update', $guru->id) }}"
                method="POST">

                @csrf
                @method('PUT')


                <div class="form-group">

                    <label>NIP</label>

                    <input
                        type="text"
                        name="nip"
                        value="{{ $guru->nip }}"
                        required>

                </div>


                <div class="form-group">

                    <label>Nama Guru</label>

                    <input
                        type="text"
                        name="nama_guru"
                        value="{{ $guru->nama_guru }}"
                        required>

                </div>


                <div class="form-group">

                    <label>Jabatan</label>

                    <input
                        type="text"
                        name="jabatan"
                        value="{{ $guru->jabatan }}"
                        required>

                </div>


                <div class="form-group">

                    <label>Jenis Kelamin</label>

                    <select
                        name="jenis_kelamin"
                        required>

                        <option
                            value="L"
                            {{ $guru->jenis_kelamin === 'L' ? 'selected' : '' }}>
                            Laki-laki
                        </option>

                        <option
                            value="P"
                            {{ $guru->jenis_kelamin === 'P' ? 'selected' : '' }}>
                            Perempuan
                        </option>

                    </select>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        onclick="closeModal('editGuru{{ $guru->id }}')">
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
     MODAL TAMBAH GURU
====================================================== --}}

<div
    class="modal"
    id="modalTambahGuru">

    <div class="modal-content">

        <div class="modal-header">

            <h2>Tambah Guru</h2>

            <button
                type="button"
                class="modal-close"
                onclick="closeModal('modalTambahGuru')">
                &times;
            </button>

        </div>


        <form
            action="{{ route('admin.guru.store') }}"
            method="POST">

            @csrf


            <div class="form-group">

                <label>NIP</label>

                <input
                    type="text"
                    name="nip"
                    placeholder="Masukkan NIP"
                    required>

            </div>


            <div class="form-group">

                <label>Nama Guru</label>

                <input
                    type="text"
                    name="nama_guru"
                    placeholder="Masukkan nama guru"
                    required>

            </div>


            <div class="form-group">

                <label>Jabatan</label>

                <input
                    type="text"
                    name="jabatan"
                    placeholder="Contoh: Guru / Kepala Sekolah"
                    required>

            </div>


            <div class="form-group">

                <label>Jenis Kelamin</label>

                <select
                    name="jenis_kelamin"
                    required>

                    <option value="">
                        -- Pilih --
                    </option>

                    <option value="L">
                        Laki-laki
                    </option>

                    <option value="P">
                        Perempuan
                    </option>

                </select>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    onclick="closeModal('modalTambahGuru')">
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

@endsection

{{-- JAVASCRIPT MODAL --}}
@push('scripts')

<script> function openModal(id) { const modal = document.getElementById(id); if (modal) { modal.classList.add('show'); } } function closeModal(id) { const modal = document.getElementById(id); if (modal) { modal.classList.remove('show'); } } window.addEventListener('click', function(event) { if (event.target.classList.contains('modal')) { event.target.classList.remove('show'); } }); </script>
@endpush