<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class List_Data_Controller extends Controller
{
    public static function list_kab_kota()
    {
        $daftar_kab_kota = [
            'Kab. Alor',
            "Kab. Belu",
            "Kab. Ende",
            "Kab. Flores Timur",
            "Kab. Kupang",
            "Kab. Lembata",
            "Kab. Malaka",
            "Kab. Mangggarai",
            "Kab. Mangggarai Barat",
            "Kab. Mangggarai Timur",
            "Kab. Nagekeo",
            "Kab. Ngada",
            "Kab. Rote Ndao",
            "Kab. Sabu Raijua",
            "Kab. Sikka",
            "Kab. Sumba Barat",
            "Kab. Sumba Barat Daya",
            "Kab. Sumba Tengah",
            "Kab. Sumba Timur",
            "Kab. TTS",
            "Kab. TTU",
            "Kota Kupang",
        ];
        return $daftar_kab_kota;
    }

    public static function list_proses()
    {
        $daftar_proses = [
            "promosi",
            "admisi",
            "pengisian data pribadi dan upload berkas",
            "registrasi mata kuliah",
            "pembayaran uang kuliah"
        ];

        return $daftar_proses;
    }
}
