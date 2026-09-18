@extends('admin.layouts.app')

@section('title', 'Profil Sekolah - Admin')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/datasekolah.css') }}">
@endpush
<div class="page-header"> <div> <h1>Profil Sekolah</h1> <p>Kelola informasi profil SMK Negeri 1 Cijati.</p> </div> </div>
@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<div class="card profil-card">
<form
    action="{{ route('admin.profil.update') }}"
    method="POST"
    class="profil-form">

    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="nama_sekolah">Nama Sekolah</label>

        <input
            type="text"
            id="nama_sekolah"
            name="nama_sekolah"
            value="{{ old('nama_sekolah', $profil->nama_sekolah ?? '') }}"
            placeholder="Nama sekolah"
            required>
    </div>

    <div class="form-group">
        <label for="akreditasi">Akreditasi</label>

        <input
            type="text"
            id="akreditasi"
            name="akreditasi"
            value="{{ old('akreditasi', $profil->akreditasi ?? '') }}"
            placeholder="Contoh: A">
    </div>

    <div class="form-group">
        <label for="sejarah">Sejarah Sekolah</label>

        <textarea
            id="sejarah"
            name="sejarah"
            rows="8"
            placeholder="Masukkan sejarah sekolah">{{ old('sejarah', $profil->sejarah ?? '') }}</textarea>
    </div>

    <div class="form-group">
        <label for="visi">Visi</label>

        <textarea
            id="visi"
            name="visi"
            rows="5"
            placeholder="Masukkan visi sekolah">{{ old('visi', $profil->visi ?? '') }}</textarea>
    </div>

    <div class="form-group">
        <label for="misi">Misi</label>

        <textarea
            id="misi"
            name="misi"
            rows="8"
            placeholder="Masukkan misi sekolah">{{ old('misi', $profil->misi ?? '') }}</textarea>
    </div>

    <div class="form-group">
        <label for="alamat">Alamat</label>

        <textarea
            id="alamat"
            name="alamat"
            rows="4"
            placeholder="Alamat sekolah">{{ old('alamat', $profil->alamat ?? '') }}</textarea>
    </div>

    <div class="form-group">
        <label for="telephone">Telephone</label>

        <input
            type="text"
            id="telephone"
            name="telephone"
            value="{{ old('telephone', $profil->telephone ?? '') }}"
            placeholder="Nomor telephone">
    </div>

    <div class="form-group">
        <label for="email">Email</label>

        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $profil->email ?? '') }}"
            placeholder="Email sekolah">
    </div>

    <div class="modal-footer">
        <button
            type="submit"
            class="btn btn-primary">
            Simpan Profil
        </button>
    </div>

</form>

</div>
@endsection