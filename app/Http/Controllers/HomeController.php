<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'data' => Home::all()
        ];
        return view('home.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('home.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $this->validate($request, [
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'foto' =>'required|mimes:jpeg,png,jpg,gif,svg|max:5000', // Sesuaikan dengan kebutuhan Anda
        ]);

        // Generate nama file acak dengan timestamp
        $randomFileName = time() . '.' . $request->file('foto')->getClientOriginalExtension();

        // Upload foto dengan nama file acak
        $request->file('foto')->move('image/', $randomFileName);

        // Simpan data ke database
        Home::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto' => $randomFileName
        ]);
        
        // Redirect ke halaman yang diinginkan (misalnya halaman list data)
        return redirect()->route('home')->with('success', 'Data berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Home::findOrFail($id);

        return view('home.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari formulir
        $this->validate($request, [
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'foto' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:5000', // Sesuaikan dengan kebutuhan Anda
        ]);

        // Temukan data berdasarkan ID
        $data = Home::findOrFail($id);

        // Simpan data yang diperbarui
        $data->nik = $request->nik;
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->jenis_kelamin = $request->jenis_kelamin;

        // Cek apakah ada file foto yang diunggah
        if ($request->hasFile('foto')) {
            // Generate nama file acak dengan timestamp
            $randomFileName = time() . '.' . $request->file('foto')->getClientOriginalExtension();

            // Upload foto dengan nama file acak
            $request->file('foto')->move('image/', $randomFileName);

            // Hapus foto lama jika ada
            if ($data->foto) {
                // Hapus foto lama dari direktori
                unlink(public_path('image/' . $data->foto));
            }

            // Simpan nama file acak ke dalam kolom foto
            $data->foto = $randomFileName;
        }

        // Simpan data yang diperbarui
        $data->update();

        // Redirect ke halaman yang diinginkan (misalnya halaman list data)
        return redirect()->route('home')->with('success', 'Data berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
            // Temukan data berdasarkan ID
        $data = Home::findOrFail($id);

        // Hapus foto dari direktori jika ada
        if ($data->foto) {
            // Hapus foto dari direktori
            unlink(public_path('image/' . $data->foto));
        }

        // Hapus data dari database
        $data->delete();

        // Redirect ke halaman yang diinginkan (misalnya halaman list data)
        return redirect()->route('home')->with('success', 'Data berhasil dihapus.');

    }
}
