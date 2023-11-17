<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Ujian;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function show()
    {
        $dataMahasiswa = Mahasiswa::all();
        $dataMatkul = MataKuliah::all();
        $dataUjian = Ujian::with('mahasiswa', 'matkul')->get();

        return view("index", [
            'dataUjian' => $dataUjian,
            'dataMatkul' => $dataMatkul,
            'dataMahasiswa' => $dataMahasiswa
        ]);
    }

    public function search(Request $request) {
        if ($request->ajax()) {
            $errorMessage = "";
            $mahasiswa = Mahasiswa::where([
                ['nim', $request->nim],
            ])->first();

            if ($mahasiswa == null) {
                $errorMessage = "NIM " . $request->nim . __(" Not found");
                return response()->json(['status' => "Invalid", 'errorMessage' => $errorMessage]);
            } else {
               $dataResponse = [
                    'nim' => $mahasiswa->nim,
                    'nama' => $mahasiswa->nama_mahasiswa,
                ];
                $objectResponse = (object)$dataResponse;
                return response()->json(['data' => $objectResponse, 'status' => "Valid", 'errorMessage' => $errorMessage]);
            }
        }
    }
}
