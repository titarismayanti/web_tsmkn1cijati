<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\Artikel;
use App\Models\ArtikelKategori;
use App\Models\Galeri;
use App\Models\Kontak;
use App\Models\Fasilitas;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class DataSekolahController extends Controller
{
    // ==========================================================
    // HALAMAN
    // ==========================================================

    /*** Halaman Guru*/
    public function guru()
    {
        $gurus = Guru::orderBy('id', 'desc')->get();

        return view('admin.guru', compact('gurus'));
 }


    /*** Halaman Siswa*/
    public function siswa()
    {
        $siswas = Siswa::orderBy('id', 'desc')->get();

        return view('admin.siswa', compact('siswas'));
 }


    /**** Halaman Jurusan*/
    public function jurusan()
    {
        // Ambil data jurusan beserta relasi kepala program
        $jurusans = Jurusan::with('kepalaProgram')
            ->orderBy('id', 'desc')
            ->get();

        // Ambil semua guru untuk dropdown Kepala Program
        $gurus = Guru::orderBy('nama_guru', 'asc')->get();

        return view(
            'admin.jurusan',
            compact('jurusans', 'gurus')
        );
}


/*** Halaman Ekstrakurikuler */
public function ekstrakurikuler()
{
$ekstrakurikulers = Ekstrakurikuler::with('guru')
    ->orderBy('id', 'desc')
    ->get();

$gurus = Guru::orderBy('nama_guru', 'asc')->get();

return view(
    'admin.ekstrakurikuler',
    compact('ekstrakurikulers', 'gurus')
);
}


    /*** Halaman Artikel*/
    public function artikel()
    {
        $artikels = Artikel::with('kategori')
            ->orderBy('id', 'desc')
            ->get();

        $kategoriArtikels = ArtikelKategori::orderBy(
            'nama_kategori',
            'asc'
        )->get();

    return view(
        'admin.artikel', compact('artikels','kategoriArtikels')
    );
}

    /*** Halaman Galeri*/
    public function galeri()
    {
        $galeris = Galeri::orderBy('id', 'desc')->get();

    return view(
        'admin.galeri', compact('galeris')
    );
}

    /** * Halaman Kontak*/
    public function kontak()
    {
        $kontaks = Kontak::orderBy('id', 'desc')->get();

    return view(
        'admin.kontak',  compact('kontaks')
    );
 }

    /**
     * Menampilkan data fasilitas
     */
    public function fasilitas()
    {
        $fasilitas = Fasilitas::latest('id')->get();

        return view('admin.fasilitas', compact('fasilitas'));
    }

/**
 * Halaman Profil Sekolah
 */
public function profil()
{
    $profil = ProfilSekolah::first();

    return view(
        'admin.profil', compact('profil')
    );
}

    
    // ==========================================================
    // HELPER GAMBAR / LOGO
    // ==========================================================

    /**
     * Menghapus gambar/logo lama dari public/image/{folder}.
     *
     * @param string|null $path   Nama file yang tersimpan di database
     * @param string      $folder Subfolder di dalam public/image (misal: 'jurusan', 'ekskul')
     */
    private function deleteMedia(?string $path, string $folder = ''): void
    {
        if (!$path) {
            return;
        }

        $fileName = basename($path);

        $filePath = public_path(
            'image/' . ($folder ? $folder . '/' : '') . $fileName
        );

        if (File::exists($filePath)) {
            File::delete($filePath);
        }
    }


    /**
     * Menyimpan file upload ke public/image/{folder}.
     *
     * @param  $file
     * @param string $folder Subfolder tujuan (misal: 'jurusan', 'ekskul')
     */
    private function storeMedia($file, string $folder = ''): string
    {
        $namaFile =
            time() .
            '_' .
            uniqid() .
            '.' .
            $file->getClientOriginalExtension();

        $targetPath = public_path(
            'image/' . ($folder ? $folder . '/' : '')
        );

        if (!File::exists($targetPath)) {
            File::makeDirectory(
                $targetPath,
                0755,
                true
            );
        }

        $file->move(
            $targetPath,
            $namaFile
        );

        return $namaFile;
    }


 // ========================================================== // GURU// ==========================================================

    /**
     * Menyimpan guru baru.
     */
    public function storeGuru(Request $request)
    {
        $validated = $request->validate([
            'nip' => [
                'required',
                'string',
                'max:30',
                'unique:gurus,nip',
            ],

            'nama_guru' => [
                'required',
                'string',
                'max:100',
            ],

            'jabatan' => [
                'required',
                'string',
                'max:100',
            ],

            'jenis_kelamin' => [
                'required',
                'in:L,P',
            ],
        ], [
            'nip.required' =>
                'NIP wajib diisi.',

            'nip.unique' =>
                'NIP sudah digunakan.',

            'nama_guru.required' =>
                'Nama guru wajib diisi.',

            'jabatan.required' =>
                'Jabatan wajib diisi.',

            'jenis_kelamin.required' =>
                'Jenis kelamin wajib dipilih.',
        ]);

        Guru::create($validated);

        return redirect()
            ->route('admin.guru')
            ->with(
                'success',
                'Data guru berhasil ditambahkan.'
            );
    }


    /**
     * Mengubah guru.
     */
    public function updateGuru(
        Request $request,
        Guru $guru
    ) {
        $validated = $request->validate([
            'nip' => [
                'required',
                'string',
                'max:30',
                'unique:gurus,nip,' . $guru->id,
            ],

            'nama_guru' => [
                'required',
                'string',
                'max:100',
            ],

            'jabatan' => [
                'required',
                'string',
                'max:100',
            ],

            'jenis_kelamin' => [
                'required',
                'in:L,P',
            ],
        ], [
            'nip.required' =>
                'NIP wajib diisi.',

            'nip.unique' =>
                'NIP sudah digunakan oleh guru lain.',

            'nama_guru.required' =>
                'Nama guru wajib diisi.',

            'jabatan.required' =>
                'Jabatan wajib diisi.',

            'jenis_kelamin.required' =>
                'Jenis kelamin wajib dipilih.',
        ]);

        $guru->update($validated);

        return redirect()
            ->route('admin.guru')
            ->with(
                'success',
                'Data guru berhasil diperbarui.'
            );
    }


    /**
     * Menghapus guru.
     */
    public function destroyGuru(Guru $guru)
    {
        $guru->delete();

        return redirect()
            ->route('admin.guru')
            ->with(
                'success',
                'Data guru berhasil dihapus.'
            );
    }


// =========================================================// SISWA // ==========================================================

    /**
     * Menyimpan siswa.
     */
    public function storeSiswa(Request $request)
    {
        $validated = $request->validate([
            'total_siswa' => [
                'required',
                'integer',
                'min:0',
            ],
        ], [
            'total_siswa.required' =>
                'Total siswa wajib diisi.',

            'total_siswa.integer' =>
                'Total siswa harus berupa angka.',

            'total_siswa.min' =>
                'Total siswa tidak boleh kurang dari 0.',
        ]);

        Siswa::create($validated);

        return redirect()
            ->route('admin.siswa')
            ->with(
                'success',
                'Data siswa berhasil ditambahkan.'
            );
    }


    /**
     * Mengubah siswa.
     */
    public function updateSiswa(
        Request $request,
        Siswa $siswa
    ) {
        $validated = $request->validate([
            'total_siswa' => [
                'required',
                'integer',
                'min:0',
            ],
        ], [
            'total_siswa.required' =>
                'Total siswa wajib diisi.',

            'total_siswa.integer' =>
                'Total siswa harus berupa angka.',

            'total_siswa.min' =>
                'Total siswa tidak boleh kurang dari 0.',
        ]);

        $siswa->update($validated);

        return redirect()
            ->route('admin.siswa')
            ->with(
                'success',
                'Data siswa berhasil diperbarui.'
            );
    }


    /**
     * Menghapus siswa.
     */
    public function destroySiswa(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()
            ->route('admin.siswa')
            ->with(
                'success',
                'Data siswa berhasil dihapus.'
            );
    }


// ==========================================================// JURUSAN// ==========================================================

    /**
 * Menyimpan jurusan
 */
public function storeJurusan(Request $request)
{
    $validated = $request->validate([
        'nama_jurusan' => [
            'required',
            'string',
            'max:255',
        ],

        'guru_id' => [
            'required',
            'exists:gurus,id',
        ],

        'singkatan' => [
            'required',
            'string',
            'max:255',
        ],

        'deskripsi' => [
            'nullable',
            'string',
        ],

        'gambar' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],
    ], [
        'nama_jurusan.required' => 'Nama jurusan wajib diisi.',

        'guru_id.required' => 'Kepala program wajib dipilih.',
        'guru_id.exists' => 'Kepala program yang dipilih tidak valid.',

        'singkatan.required' => 'Singkatan wajib diisi.',

        'gambar.image' => 'File gambar harus berupa gambar.',
        'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
        'gambar.max' => 'Ukuran gambar maksimal 2 MB.',

    ]);


    /*
    |--------------------------------------------------------------------------
    | Upload Gambar
    |--------------------------------------------------------------------------
    */
    if ($request->hasFile('gambar')) {

        $validated['gambar'] = $this->storeMedia(
            $request->file('gambar'),
            'jurusan'
        );
    }



    /*
    |--------------------------------------------------------------------------
    | Simpan Database
    |--------------------------------------------------------------------------
    */
    Jurusan::create($validated);


    return redirect()
        ->route('admin.jurusan')
        ->with('success', 'Data jurusan berhasil ditambahkan.');
}


/**
 * Mengubah jurusan
 */
public function updateJurusan(
    Request $request,
    Jurusan $jurusan
) {
    $validated = $request->validate([
        'nama_jurusan' => [
            'required',
            'string',
            'max:255',
        ],

        'guru_id' => [
            'required',
            'exists:gurus,id',
        ],

        'singkatan' => [
            'required',
            'string',
            'max:255',
        ],

        'deskripsi' => [
            'nullable',
            'string',
        ],

        'gambar' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],
    ], [
        'nama_jurusan.required' => 'Nama jurusan wajib diisi.',

        'guru_id.required' => 'Kepala program wajib dipilih.',
        'guru_id.exists' => 'Kepala program yang dipilih tidak valid.',

        'singkatan.required' => 'Singkatan wajib diisi.',

        'gambar.image' => 'File gambar harus berupa gambar.',
        'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
        'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
    ]);


    /*
    |--------------------------------------------------------------------------
    | Ganti Gambar
    |--------------------------------------------------------------------------
    */
    if ($request->hasFile('gambar')) {

        // Hapus gambar lama
        if ($jurusan->gambar) {
            $this->deleteMedia(
                $jurusan->gambar,
                'jurusan'
            );
        }

        // Simpan gambar baru
        $validated['gambar'] = $this->storeMedia(
            $request->file('gambar'),
            'jurusan'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Database
    |--------------------------------------------------------------------------
    */
    $jurusan->update($validated);


    return redirect()
        ->route('admin.jurusan')
        ->with('success', 'Data jurusan berhasil diperbarui.');
}


/**
 * Menghapus jurusan
 */
public function destroyJurusan(
    Jurusan $jurusan
) {
    /*
    |--------------------------------------------------------------------------
    | Hapus Gambar
    |--------------------------------------------------------------------------
    */
    if ($jurusan->gambar) {
        $this->deleteMedia(
            $jurusan->gambar,
            'jurusan'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Hapus Data
    |--------------------------------------------------------------------------
    */
    $jurusan->delete();


    return redirect()
        ->route('admin.jurusan')
        ->with('success', 'Data jurusan, gambar, dan foto berhasil dihapus.');
}


// ==========================================================// EKSTRAKURIKULER// ==========================================================

// ==========================================================
// EKSTRAKURIKULER
// ==========================================================

 /* Menyimpan ekstrakurikuler baru.
 */
public function storeEkstrakurikuler(Request $request)
{
    $validated = $request->validate([
        'nama_eskul' => [
            'required',
            'string',
            'max:100',
        ],

        'guru_id' => [
            'required',
            'exists:gurus,id',
        ],

        'deskripsi' => [
            'nullable',
            'string',
        ],

        'logo' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],
    ], [
        'nama_eskul.required' =>
            'Nama ekstrakurikuler wajib diisi.',

        'guru_id.required' =>
            'Pembina wajib dipilih.',

        'guru_id.exists' =>
            'Guru yang dipilih tidak valid.',

        'logo.image' =>
            'File logo harus berupa gambar.',

        'logo.mimes' =>
            'Format logo harus JPG, JPEG, PNG, atau WEBP.',

        'logo.max' =>
            'Ukuran logo maksimal 2 MB.',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Upload logo
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('logo')) {

        $validated['logo'] = $this->storeMedia(
            $request->file('logo'),
            'ekskul'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan data
    |--------------------------------------------------------------------------
    */

    Ekstrakurikuler::create($validated);

    return redirect()
        ->route('admin.ekstrakurikuler')
        ->with(
            'success',
            'Data ekstrakurikuler berhasil ditambahkan.'
        );
}


/**
 * Mengubah ekstrakurikuler.
 */
public function updateEkstrakurikuler(
    Request $request,
    Ekstrakurikuler $ekstrakurikuler
) {
    $validated = $request->validate([
        'nama_eskul' => [
            'required',
            'string',
            'max:100',
        ],

        'guru_id' => [
            'required',
            'exists:gurus,id',
        ],

        'deskripsi' => [
            'nullable',
            'string',
        ],

        'logo' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],
    ], [
        'nama_eskul.required' =>
            'Nama ekstrakurikuler wajib diisi.',

        'guru_id.required' =>
            'Pembina wajib dipilih.',

        'guru_id.exists' =>
            'Guru yang dipilih tidak valid.',

        'logo.image' =>
            'File logo harus berupa gambar.',

        'logo.mimes' =>
            'Format logo harus JPG, JPEG, PNG, atau WEBP.',

        'logo.max' =>
            'Ukuran logo maksimal 2 MB.',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Jika ada logo baru
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('logo')) {

        $this->deleteMedia(
            $ekstrakurikuler->logo,
            'ekskul'
        );

        $validated['logo'] = $this->storeMedia(
            $request->file('logo'),
            'ekskul'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update data
    |--------------------------------------------------------------------------
    */

    $ekstrakurikuler->update($validated);

    return redirect()
        ->route('admin.ekstrakurikuler')
        ->with(
            'success',
            'Data ekstrakurikuler berhasil diperbarui.'
        );
}


/**
 * Menghapus ekstrakurikuler.
 */
public function destroyEkstrakurikuler(
    Ekstrakurikuler $ekstrakurikuler
) {
    /*
    |--------------------------------------------------------------------------
    | Hapus logo
    |--------------------------------------------------------------------------
    */

    $this->deleteMedia(
        $ekstrakurikuler->logo,
        'ekskul'
    );

    /*
    |--------------------------------------------------------------------------
    | Hapus data
    |--------------------------------------------------------------------------
    */

    $ekstrakurikuler->delete();

    return redirect()
        ->route('admin.ekstrakurikuler')
        ->with(
            'success',
            'Data ekstrakurikuler berhasil dihapus.'
        );
}


// ========================================================== // ARTIKEL // ==========================================================

/**
 * Menyimpan artikel baru.
 */
    public function storeArtikel(Request $request)
    {
        $validated = $request->validate([
        'judul' => [
            'required',
            'string',
            'max:255',
        ],

        'isi' => [
            'required',
            'string',
        ],

        'gambar' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],

        'tanggal_publish' => [
            'required',
            'date',
        ],

        'kategori_artikel_id' => [
            'required',
            'exists:artikel_kategoris,id',
        ],
    ], [
        'judul.required' =>
            'Judul artikel wajib diisi.',

        'isi.required' =>
            'Isi artikel wajib diisi.',

        'gambar.image' =>
            'File harus berupa gambar.',

        'gambar.mimes' =>
            'Format gambar harus JPG, JPEG, PNG, atau WEBP.',

        'gambar.max' =>
            'Ukuran gambar maksimal 2 MB.',

        'tanggal_publish.required' =>
            'Tanggal publish wajib diisi.',

        'kategori_artikel_id.required' =>
            'Kategori artikel wajib dipilih.',

        'kategori_artikel_id.exists' =>
            'Kategori artikel tidak valid.',
    ]);


    /*
    |--------------------------------------------------------------------------
    | Buat slug otomatis dari judul
    |--------------------------------------------------------------------------
    */

    $slug = Str::slug($request->judul);

    $slugAwal = $slug;
    $counter = 1;

    while (
        Artikel::where('slug', $slug)->exists()
    ) {
        $slug = $slugAwal . '-' . $counter;
        $counter++;
    }


    $validated['slug'] = $slug;


    /*
    |--------------------------------------------------------------------------
    | Upload gambar
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('gambar')) {

        $validated['gambar'] =
            $this->storeMedia(
                $request->file('gambar'),
                'artikel'
            );
    }


    Artikel::create($validated);


    return redirect()
        ->route('admin.artikel')
        ->with(
            'success',
            'Artikel berhasil ditambahkan.'
        );
}


/**
 * Mengubah artikel.
 */
    public function updateArtikel(
        Request $request,
        Artikel $artikel
    ) {
        $validated = $request->validate([
        'judul' => [
            'required',
            'string',
            'max:255',
        ],

        'isi' => [
            'required',
            'string',
        ],

        'gambar' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],

        'tanggal_publish' => [
            'required',
            'date',
        ],

        'kategori_artikel_id' => [
            'required',
            'exists:artikel_kategoris,id',
        ],
    ], [
        'judul.required' =>
            'Judul artikel wajib diisi.',

        'isi.required' =>
            'Isi artikel wajib diisi.',

        'gambar.image' =>
            'File harus berupa gambar.',

        'gambar.mimes' =>
            'Format gambar harus JPG, JPEG, PNG, atau WEBP.',

        'gambar.max' =>
            'Ukuran gambar maksimal 2 MB.',

        'tanggal_publish.required' =>
            'Tanggal publish wajib diisi.',

        'kategori_artikel_id.required' =>
            'Kategori artikel wajib dipilih.',

        'kategori_artikel_id.exists' =>
            'Kategori artikel tidak valid.',
    ]);


    /*
    |--------------------------------------------------------------------------
    | Buat slug baru berdasarkan judul
    |--------------------------------------------------------------------------
    */

    $slug = Str::slug($request->judul);

    $slugAwal = $slug;
    $counter = 1;

    while (
        Artikel::where('slug', $slug)
            ->where('id', '!=', $artikel->id)
            ->exists()
    ) {
        $slug = $slugAwal . '-' . $counter;
        $counter++;
    }


    $validated['slug'] = $slug;


    /*
    |--------------------------------------------------------------------------
    | Jika ada gambar baru
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('gambar')) {

        $this->deleteMedia(
            $artikel->gambar,
            'artikel'
        );

        $validated['gambar'] =
            $this->storeMedia(
                $request->file('gambar'),
                'artikel'
            );
    }


    $artikel->update($validated);


    return redirect()
        ->route('admin.artikel')
        ->with(
            'success',
            'Artikel berhasil diperbarui.'
        );
}


/**
 * Menghapus artikel.
 */
public function destroyArtikel(
    Artikel $artikel
) {
    /*
    |--------------------------------------------------------------------------
    | Hapus gambar artikel
    |--------------------------------------------------------------------------
    */

    $this->deleteMedia(
        $artikel->gambar,
        'artikel'
    );


    /*
    |--------------------------------------------------------------------------
    | Hapus data artikel
    |--------------------------------------------------------------------------
    */

    $artikel->delete();


    return redirect()
        ->route('admin.artikel')
        ->with(
            'success',
            'Artikel dan gambarnya berhasil dihapus.'
        );
}


// ========================================================== // GALERI ==================================================
/**
 * Menyimpan galeri baru.
 */
public function storeGaleri(Request $request)
{
    $validated = $request->validate([
        'judul' => [
            'required',
            'string',
            'max:255',
        ],

        'deskripsi' => [
            'nullable',
            'string',
        ],

        'tanggal_publish' => [
            'required',
            'date',
        ],

        'gambar' => [
            'required',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],
    ], [
        'judul.required' =>
            'Judul galeri wajib diisi.',

        'tanggal_publish.required' =>
            'Tanggal publish wajib diisi.',

        'tanggal_publish.date' =>
            'Tanggal publish tidak valid.',

        'gambar.required' =>
            'Gambar galeri wajib diupload.',

        'gambar.image' =>
            'File harus berupa gambar.',

        'gambar.mimes' =>
            'Format gambar harus JPG, JPEG, PNG, atau WEBP.',

        'gambar.max' =>
            'Ukuran gambar maksimal 2 MB.',
    ]);


    /*
    |--------------------------------------------------------------------------
    | Upload gambar
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('gambar')) {

        $validated['gambar'] =
            $this->storeMedia(
                $request->file('gambar'),
                'galeri'
            );
    }


    Galeri::create($validated);


    return redirect()
        ->route('admin.galeri')
        ->with(
            'success',
            'Data galeri berhasil ditambahkan.'
        );
}


/**
 * Mengubah galeri.
 */
public function updateGaleri(
    Request $request,
    Galeri $galeri
) {
    $validated = $request->validate([
        'judul' => [
            'required',
            'string',
            'max:255',
        ],

        'deskripsi' => [
            'nullable',
            'string',
        ],

        'tanggal_publish' => [
            'required',
            'date',
        ],

        'gambar' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],
    ], [
        'judul.required' =>
            'Judul galeri wajib diisi.',

        'tanggal_publish.required' =>
            'Tanggal publish wajib diisi.',

        'gambar.image' =>
            'File harus berupa gambar.',

        'gambar.mimes' =>
            'Format gambar harus JPG, JPEG, PNG, atau WEBP.',

        'gambar.max' =>
            'Ukuran gambar maksimal 2 MB.',
    ]);


    /*
    |--------------------------------------------------------------------------
    | Jika ada gambar baru
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('gambar')) {

        // Hapus gambar lama
        $this->deleteMedia(
            $galeri->gambar,
            'galeri'
        );

        // Simpan gambar baru
        $validated['gambar'] =
            $this->storeMedia(
                $request->file('gambar'),
                'galeri'
            );
    }


    $galeri->update($validated);


    return redirect()
        ->route('admin.galeri')
        ->with(
            'success',
            'Data galeri berhasil diperbarui.'
        );
}


/**
 * Menghapus galeri.
 */
public function destroyGaleri(
    Galeri $galeri
) {
    /*
    |--------------------------------------------------------------------------
    | Hapus gambar
    |--------------------------------------------------------------------------
    */

    $this->deleteMedia(
        $galeri->gambar,
        'galeri'
    );


    /*
    |--------------------------------------------------------------------------
    | Hapus data
    |--------------------------------------------------------------------------
    */

    $galeri->delete();


    return redirect()
        ->route('admin.galeri')
        ->with(
            'success',
            'Data galeri dan gambarnya berhasil dihapus.'
        );
}


// ========================================================== //KONTAK=========================================================
/**
 * Menyimpan pesan kontak.
 */
public function storeKontak(Request $request)
{
    $validated = $request->validate([
        'nama' => [
            'required',
            'string',
            'max:255',
        ],

        'email' => [
            'required',
            'email',
            'max:255',
        ],

        'pesan' => [
            'required',
            'string',
        ],
    ], [
        'nama.required' =>
            'Nama wajib diisi.',

        'email.required' =>
            'Email wajib diisi.',

        'email.email' =>
            'Format email tidak valid.',

        'pesan.required' =>
            'Pesan wajib diisi.',
    ]);


    Kontak::create($validated);


    return redirect()
        ->route('admin.kontak')
        ->with(
            'success',
            'Pesan kontak berhasil ditambahkan.'
        );
}


/**
 * Mengubah data kontak.
 */
public function updateKontak(
    Request $request,
    Kontak $kontak
) {
    $validated = $request->validate([
        'nama' => [
            'required',
            'string',
            'max:255',
        ],

        'email' => [
            'required',
            'email',
            'max:255',
        ],

        'pesan' => [
            'required',
            'string',
        ],
    ], [
        'nama.required' =>
            'Nama wajib diisi.',

        'email.required' =>
            'Email wajib diisi.',

        'email.email' =>
            'Format email tidak valid.',

        'pesan.required' =>
            'Pesan wajib diisi.',
    ]);


    $kontak->update($validated);


    return redirect()
        ->route('admin.kontak')
        ->with(
            'success',
            'Data kontak berhasil diperbarui.'
        );
}


/**
 * Menghapus kontak.
 */
public function destroyKontak(
    Kontak $kontak
) {
    $kontak->delete();


    return redirect()
        ->route('admin.kontak')
        ->with(
            'success',
            'Pesan kontak berhasil dihapus.'
        );
}

// ==========================================================
// FASILITAS
// ==========================================================

/**
 * Menyimpan fasilitas baru.
 */
public function storeFasilitas(Request $request)
{
    $validated = $request->validate([

        'nama_fasilitas' => [
            'required',
            'string',
            'max:255',
        ],

        'gambar' => [
            'required',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],

    ], [

        'nama_fasilitas.required' =>
            'Nama fasilitas wajib diisi.',

        'gambar.required' =>
            'Gambar fasilitas wajib diupload.',

        'gambar.image' =>
            'File harus berupa gambar.',

        'gambar.mimes' =>
            'Format gambar harus JPG, JPEG, PNG, atau WEBP.',

        'gambar.max' =>
            'Ukuran gambar maksimal 2 MB.',

    ]);


    /*
    |--------------------------------------------------------------------------
    | Upload gambar
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('gambar')) {

        $validated['gambar'] =
            $this->storeMedia(
                $request->file('gambar'),
                'fasilitas'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Simpan data
    |--------------------------------------------------------------------------
    */

    Fasilitas::create($validated);


    return redirect()
        ->route('admin.fasilitas')
        ->with(
            'success',
            'Data fasilitas berhasil ditambahkan.'
        );
}


/**
 * Mengubah fasilitas.
 */
public function updateFasilitas(
    Request $request,
    Fasilitas $fasilitas
) {
    $validated = $request->validate([

        'nama_fasilitas' => [
            'required',
            'string',
            'max:255',
        ],

        'gambar' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],

    ], [

        'nama_fasilitas.required' =>
            'Nama fasilitas wajib diisi.',

        'gambar.image' =>
            'File harus berupa gambar.',

        'gambar.mimes' =>
            'Format gambar harus JPG, JPEG, PNG, atau WEBP.',

        'gambar.max' =>
            'Ukuran gambar maksimal 2 MB.',

    ]);


    /*
    |--------------------------------------------------------------------------
    | Jika ada gambar baru
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('gambar')) {

        // Hapus gambar lama
        $this->deleteMedia(
            $fasilitas->gambar,
            'fasilitas'
        );


        // Simpan gambar baru
        $validated['gambar'] =
            $this->storeMedia(
                $request->file('gambar'),
                'fasilitas'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Update data
    |--------------------------------------------------------------------------
    */

    $fasilitas->update($validated);


    return redirect()
        ->route('admin.fasilitas')
        ->with(
            'success',
            'Data fasilitas berhasil diperbarui.'
        );
}


/**
 * Menghapus fasilitas.
 */
public function destroyFasilitas(
    Fasilitas $fasilitas
) {
    /*
    |--------------------------------------------------------------------------
    | Hapus gambar
    |--------------------------------------------------------------------------
    */

    $this->deleteMedia(
        $fasilitas->gambar,
        'fasilitas'
    );


    /*
    |--------------------------------------------------------------------------
    | Hapus data
    |--------------------------------------------------------------------------
    */

    $fasilitas->delete();


    return redirect()
        ->route('admin.fasilitas')
        ->with(
            'success',
            'Data fasilitas dan gambarnya berhasil dihapus.'
        );
}

// ====================================================PROFIL============================================================
/**
 * Menyimpan / memperbarui profil sekolah.
 */
public function updateProfil(Request $request)
{
    $validated = $request->validate([
        'nama_sekolah' => [
            'required',
            'string',
            'max:255',
        ],

        'akreditasi' => [
            'nullable',
            'string',
            'max:50',
        ],

        'sejarah' => [
            'nullable',
            'string',
        ],

        'visi' => [
            'nullable',
            'string',
        ],

        'misi' => [
            'nullable',
            'string',
        ],

        'alamat' => [
            'nullable',
            'string',
            'max:500',
        ],

        'telephone' => [
            'nullable',
            'string',
            'max:30',
        ],

        'email' => [
            'nullable',
            'email',
            'max:255',
        ],
    ], [
        'nama_sekolah.required' =>
            'Nama sekolah wajib diisi.',

        'email.email' =>
            'Format email tidak valid.',
    ]);


    $profil = ProfilSekolah::first();


    /*
    |--------------------------------------------------------------------------
    | Jika data profil belum ada
    |--------------------------------------------------------------------------
    */

    if (!$profil) {

        ProfilSekolah::create($validated);

    } else {

        $profil->update($validated);

    }


    return redirect()
        ->route('admin.profil')
        ->with(
            'success',
            'Profil sekolah berhasil disimpan.'
        );
}

}