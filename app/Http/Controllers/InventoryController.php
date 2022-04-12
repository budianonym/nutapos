<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $saldoAwalStok = 0;
        $saldoAwalStokRp = 0;
        $kartuStok = array(
            (object)[
                "tanggal" => "2021-10- 
01", "masuk" => 10, "keluar" => 0, "saldoQty" => 0,
                "masukRp" => 10000, "keluarRp" => 0, "saldoRp" => 0
            ],
            (object)[
                "tanggal" => "2021-10- 
03", "masuk" => 45, "keluar" => 0, "saldoQty" => 0,
                "masukRp" => 36000, "keluarRp" => 0, "saldoRp" => 0
            ],
            (object)[
                "tanggal" => "2021-10- 
05", "masuk" => 40, "keluar" => 0, "saldoQty" => 0,
                "masukRp" => 35000, "keluarRp" => 0, "saldoRp" => 0
            ],
            (object)[
                "tanggal" => "2021-10- 
02", "masuk" => 0, "keluar" => 5, "saldoQty" => 0,
                "masukRp" => 0, "keluarRp" => 0, "saldoRp" => 0
            ],
            (object)[
                "tanggal" => "2021-10- 
04", "masuk" => 0, "keluar" => 40, "saldoQty" => 0,
                "masukRp" => 0, "keluarRp" => 0, "saldoRp" => 0
            ],
            (object)[
                "tanggal" => "2021-10- 
06", "masuk" => 0, "keluar" => 35, "saldoQty" => 0,
                "masukRp" => 0, "keluarRp" => 0, "saldoRp" => 0
            ]
        );


        $sort = collect($kartuStok)->sortBy('tanggal')->all();
        $kartuStok = [];
        foreach ($sort as $key) {
            $kartuStok[] = $key;
        }

        $mutasi = collect($kartuStok)->map(function ($list_data, $i) use ($saldoAwalStok, $saldoAwalStokRp, $kartuStok) {
            $saldoAwalStok =  $i == 0 ? $saldoAwalStok : $kartuStok[$i - 1]->saldoQty;
            $saldoAwalStokRp =  $i == 0 ? $saldoAwalStokRp : $kartuStok[$i - 1]->saldoRp;
            $list_data->saldoQty = $saldoAwalStok + $list_data->masuk - $list_data->keluar;
            $list_data->saldoRp = $saldoAwalStokRp + $list_data->masukRp - $list_data->keluarRp;
            return $list_data;
        });

        return view('inventory/index', compact('kartuStok'));
    }
}
