<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // //fungsi eloquent menampilkan data menggunakan pagination
        // $mahasiswa = Mahasiswa::all();
        // //yang semua Mahasiswa::all, diubah menjadi with() yang menyatakan relasi
        $mahasiswa = Mahasiswa::with('kelas')->orderBy('id_mahasiswa', 'asc')->paginate(4);
        return view('mahasiswa.index',['mahasiswa'=>$mahasiswa, 'paginate'=>$mahasiswa]);
        
        // //mengambil data dari tabel mahasiswa
        // $mahasiswa = DB::table('mahasiswa')->paginate(4);
        // //mengirim data mahasiswa ke view index
        // return view('mahasiswa.index',['mahasiswa'=>$mahasiswa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::All(); //mendapatkan semua dari tabel kelas
        return view('mahasiswa.create',['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'Nim'=>'required',
            'Nama'=>'required',
            'Kelas'=>'required',
            'Jurusan'=>'required',
            'Email'=>'required',
            'Alamat'=>'required',
            'Tanggal_Lahir'=>'required',
        ]);

        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = $request->get('Nim');
        $mahasiswa->nama = $request->get('Nama');
        $mahasiswa->jurusan = $request->get('Jurusan');
        $mahasiswa->email = $request->get('Email');
        $mahasiswa->alamat = $request->get('Alamat');
        $mahasiswa->tanggal_lahir = $request->get('Tanggal_Lahir');
        $mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');
        
        //fungsi eloquent untuk menambah data dengan relasi belongsTo
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success','Data Mahasiswa Berhasil Ditambahkan ! ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $nim
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        //menampilkan detail data dengan berdasarkan Nim Mahasiswa
        $Mahasiswa=Mahasiswa::with('kelas')->where('nim', $nim)->first();
        return view('mahasiswa.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $nim
     * @return \Illuminate\Http\Response
     */
    public function edit($nim)
    {
        //menampilkan detail data dengan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        $kelas = Kelas::all();
        return view('mahasiswa.edit', compact('Mahasiswa','kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $nim
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nim)
    {
        //melakukan validasi data
        $request->validate([
            'Nim'=>'required',
            'Nama'=>'required',
            'Kelas'=>'required',
            'Jurusan'=>'required',
            'Email'=>'required',
            'Alamat'=>'required',
            'Tanggal_Lahir'=>'required',
        ]);

        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        $mahasiswa->nim = $request->get('Nim');
        $mahasiswa->nama = $request->get('Nama');
        $mahasiswa->jurusan = $request->get('Jurusan');
        $mahasiswa->email = $request->get('Email');
        $mahasiswa->alamat = $request->get('Alamat');
        $mahasiswa->tanggal_lahir = $request->get('Tanggal_Lahir');
        $mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');
        
        //fungsi eloquent untuk mengupdate data dengan relasi belongsTo
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();
        
        //jika berhasil diupdate maka akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data Mahasiswa Berhasil Diupdate ! ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $nim
     * @return \Illuminate\Http\Response
     */
    public function destroy($nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::where('nim', $nim)->delete();
        return redirect()->route('mahasiswa.index')
            -> with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function cari(Request $request)
    {
        //menangkap data pencarian
        $cari = $request->cari;

        //mengambil data dari table mahasiswa sesuai pencarian data
        $mahasiswa = Mahasiswa::where('nama','like',"%".$cari."%")
        ->paginate();

        //mengirim data ke view index   
        return view('mahasiswa.index',['mahasiswa'=>$mahasiswa]);
    }
};  