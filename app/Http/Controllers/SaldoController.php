<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class SaldoController extends Controller
{
    public function index()
    {
        $saldoawal = 100000;
        $mutasi = array(
            (object)["tanggal" => "2021-10-01", "masuk" => 200000, "keluar" => 0, "saldo" => 0], (object)["tanggal" => "2021-10-03", "masuk" => 300000, "keluar" => 0, "saldo" => 0], (object)["tanggal" => "2021-10-05", "masuk" => 150000, "keluar" => 0, "saldo" => 0], (object)["tanggal" => "2021-10-02", "masuk" => 0, "keluar" => 100000, "saldo" => 0], (object)["tanggal" => "2021-10-04", "masuk" => 0, "keluar" => 150000, "saldo" => 0], (object)["tanggal" => "2021-10-06", "masuk" => 0, "keluar" => 50000, "saldo" => 0]
        );

        $sort = collect($mutasi)->sortBy('tanggal')->all();
        $mutasi = [];
        foreach ($sort as $key) {
            $mutasi[] = $key;
        }

        $mutasi = collect($mutasi)->map(function ($list_data, $i) use ($saldoawal, $mutasi) {
            $saldo =  $i == 0 ? $saldoawal : $mutasi[$i - 1]->saldo;
            $list_data->saldo = $saldo + $list_data->masuk - $list_data->keluar;
            return $list_data;
        });

        return view('saldo/index', compact('mutasi', 'saldoawal'));
    }
}
