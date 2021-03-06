<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;
use App\Akademik;

class MahasiswaController extends Controller {

    public function set_mhs(Request $request) {
        $nim = $request->input('nim');
        $nama = $request->input('nama');
        $alamat = $request->input('alamat');
        $no_telepon = $request->input('no_telepon');
        $foto = "";

        //upload file
        if ($request->file('foto')) {
            $foto = $request->file('foto')->getClientOriginalName();
            $foto = uniqid() . '_' . $foto;
            $path = 'uploads' . DIRECTORY_SEPARATOR . 'user_files' . DIRECTORY_SEPARATOR . 'cnic' . DIRECTORY_SEPARATOR;
            $destinationPath = public_path($path); // upload path
            File::makeDirectory($destinationPath, 0777, true, true);
            $request->file('foto')->move($destinationPath, $foto);
            //upload file end
        }

        $set = Mahasiswa::create([
                    'nim' => $nim,
                    'nama' => $nama,
                    'alamat' => $alamat,
                    'no_telepon' => $no_telepon,
                    'foto' => $foto
        ]);
        if ($set) {
            $res['success'] = true;
            $res['message'] = 'Sukses Menyimpan!';
            return response($res);
        } else {
            $res['success'] = false;
            $res['message'] = 'Gagal Menyimpan!';
            return response($res, 400);
        }
    }

    public function put_mhs(Request $request, $nim) {
        $nama = $request->input('nama');
        $alamat = $request->input('alamat');
        $no_telepon = $request->input('no_telepon');
        $foto = "";

        //upload file
        if ($request->file('foto')) {
            $foto = $request->file('foto')->getClientOriginalName();
            $foto = uniqid() . '_' . $foto;
            $path = 'uploads' . DIRECTORY_SEPARATOR . 'user_files' . DIRECTORY_SEPARATOR . 'cnic' . DIRECTORY_SEPARATOR;
            $destinationPath = public_path($path); // upload path
            File::makeDirectory($destinationPath, 0777, true, true);
            $request->file('foto')->move($destinationPath, $foto);
            //upload file end
        }

        $mhs = Mahasiswa::find($nim);

        $mhs->nim = $nim;
        $mhs->nama = $nama;
        $mhs->alamat = $alamat;
        $mhs->no_telepon = $no_telepon;
        $mhs->foto = $foto;

        if ($mhs->save()) {
            $res['success'] = true;
            $res['message'] = 'Sukses Memperbarui!';
            return response($res);
        } else {
            $res['success'] = false;
            $res['message'] = 'Gagal Memperbarui!';
            return response($res, 400);
        }
    }

    public function del_mhs(Request $request, $nim) {
        $mhs = Mahasiswa::find($nim);

        if ($mhs->delete()) {
            $res['success'] = true;
            $res['message'] = 'Sukses Menghapus!';
            return response($res);
        } else {
            $res['success'] = false;
            $res['message'] = 'Gagal Menghapus!';
            return response($res, 400);
        }
    }

    public function get_mhs(Request $request, $nim) {
        $mhs = Mahasiswa::where('nim', $nim)->get();
        if ($mhs) {
            $res['success'] = true;
            $res['message'] = $mhs;

            return response($res);
        } else {
            $res['success'] = false;
            $res['message'] = 'Cannot find Mahasiswa!';

            return response($res, 400);
        }
    }

    public function get_all_mhs(Request $request) {
        $mhs = Mahasiswa::all();
        if ($mhs) {
            $res['success'] = true;
            $res['message'] = $mhs;

            return response($res);
        } else {
            $res['success'] = false;
            $res['message'] = 'Cannot find Mahasiswa!';

            return response($res, 400);
        }
    }

    public function set_akademik(Request $request) {
//        'id', 'nim', 'prodi', 'angkatan_wisuda', 'tanggal_lulus', 'nilai_ipk'
        $nim = $request->input('nim');
        $prodi = $request->input('prodi');
        $angkatan_wisuda = $request->input('angkatan_wisuda');
        $tanggal_lulus = $request->input('tanggal_lulus');
        $nilai_ipk = $request->input('nilai_ipk');

        $set = Akademik::create([
                    'nim' => $nim,
                    'prodi' => $prodi,
                    'angkatan_wisuda' => $angkatan_wisuda,
                    'tanggal_lulus' => $tanggal_lulus,
                    'nilai_ipk' => $nilai_ipk
        ]);
        if ($set) {
            $res['success'] = true;
            $res['message'] = 'Sukses Menyimpan!';
            return response($res);
        } else {
            $res['success'] = false;
            $res['message'] = 'Gagal Menyimpan!';
            return response($res, 400);
        }
    }

    public function put_akademik(Request $request, $nim) {
//        'id', 'nim', 'prodi', 'angkatan_wisuda', 'tanggal_lulus', 'nilai_ipk'
        $nim = $request->input('nim');
        $prodi = $request->input('prodi');
        $angkatan_wisuda = $request->input('angkatan_wisuda');
        $tanggal_lulus = $request->input('tanggal_lulus');
        $nilai_ipk = $request->input('nilai_ipk');

        $set = Akademik::find($nim);
        $set->nim = $nim;
        $set->prodi = $prodi;
        $set->angkatan_wisuda = $angkatan_wisuda;
        $set->tanggal_lulus = $tanggal_lulus;
        $set->nilai_ipk = $nilai_ipk;

        if ($set->save()) {
            $res['success'] = true;
            $res['message'] = 'Sukses Memperbarui!';
            return response($res);
        } else {
            $res['success'] = false;
            $res['message'] = 'Gagal Memperbarui!';
            return response($res, 400);
        }
    }

    public function del_akademik(Request $request, $nim) {
        $mhs = Akademik::find($nim);

        if ($mhs->delete()) {
            $res['success'] = true;
            $res['message'] = 'Sukses Menghapus!';
            return response($res);
        } else {
            $res['success'] = false;
            $res['message'] = 'Gagal Menghapus!';
            return response($res, 400);
        }
    }

    public function get_akademik(Request $request, $nim) {
        $akademik = Akademik::where('nim', $nim)->get();
        if ($akademik) {
            $res['success'] = true;
            $res['message'] = $akademik;

            return response($res);
        } else {
            $res['success'] = false;
            $res['message'] = 'Cannot find Akademik!';

            return response($res, 400);
        }
    }

    public function get_all_akademik(Request $request) {
        $akademik = Akademik::all();
        if ($akademik) {
            $res['success'] = true;
            $res['message'] = $akademik;

            return response($res);
        } else {
            $res['success'] = false;
            $res['message'] = 'Cannot find Akademik!';

            return response($res, 400);
        }
    }

}
