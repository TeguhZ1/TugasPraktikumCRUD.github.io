<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class Controller1 extends Controller
{

    public function create()
    {
        return view('create');
    }

    public function update($nim)
    {
        if ($data = Mahasiswa::find($nim)) {
            return view('update', ['data' => $data]);
        } else {
            return redirect('/read');
        }
    }

    public function edit(Request $request)
    {
        if ($data = Mahasiswa::find($request->nim)) {
            $data->nama = $request->nama;
            $data->alamat = $request->alamat;
            $data->updated_at = date('Y-m-d H:i:s');
            $data->save();
            return redirect('/read')->with('pesan', 'Data dengan NIM: ' . $request->nim . ' berhasil diupdate');
        } else {
            return redirect('/read')->with('pesan', 'Data tidak ditemukan / gagal diupdate');
        }
    }

    public function save(Request $request)
    {
        $model = new Mahasiswa();
        $model->nim = $request->nim;
        $model->nama = $request->nama;
        $model->alamat = $request->alamat;
        $model->created_at = date("Y-m-d H:i:s");
        $model->save();

        return view('view', ['data' => $request->all()]);
    }

    public function read()
    {
        $model = new Mahasiswa();
        $dataAll = $model->all();
        return view('read', ['dataAll' => $dataAll]);
    }

    public function delete($nim)
    {
        $data = Mahasiswa::find($nim);
        if ($data) {
            $data->delete();
            return redirect('/read')->with('pesan', 'Data NIM: ' . $nim . ' berhasil dihapus');
        } else {
            return redirect('/read')->with('pesan', 'Data NIM: ' . $nim . ' tidak ditemukan');
        }
    }

    public function tampilkan(Request $request)
    {
        $model = new Mahasiswa();
        $model->nim = $request->nim;
        $model->nama = $request->nama;
        $model->alamat = $request->alamat;
        $model->created_at = date("Y-m-d H:i:s");
        $model->save();

        $dataAll = $model->all();
        return view('view', ['data' => $request->all()]);
    }

    public function logout()
    {
        return view('logout');
    }
}