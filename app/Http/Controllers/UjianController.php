<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    public function store(Request $request)
    {
        try {
            $grade = $this->grade($request->nilai);
            if($grade == "Error") {
                return back()->with([
                    "message" => "Grade Error!",
                    "status" => false,
                ]);
            }

            $ujian = new Ujian([
                'nim' => $request->nim,
                'matkul_id' => $request->matkul,
                'tanggal_ujian' => $request->tanggal_ujian,
                'nilai' => $request->nilai,
                'grade' => $grade
            ]);

            if($ujian->save()) {
                return back()->with([
                    "message" => "Tambah Nilai Berhasil!",
                    "status" => true,
                ]);
            } 
        } catch (\Throwable $th) {
            return back()->with([
                "message" => "Tambah Nilai Gagal, Error: " . json_encode($th->getMessage(), true),
                "status" => false,
            ]);
        }
    }

    public function grade($nilai)
    {
        $grade = '';

        switch ($nilai) {
            case ($nilai >= 80):
                $grade = "A";
                break;
            case ($nilai >= 70 && $nilai < 80):
                $grade = "B";
                break;
            case ($nilai >= 55 && $nilai < 70):
                $grade = "C";
                break;
            case ($nilai >= 40 && $nilai < 55):
                $grade = "D";
                break;
            case ($nilai < 40):
                $grade = "E";
                break;

            default:
                $grade = "Error";
                break;
        }

        return $grade;
    }
}
