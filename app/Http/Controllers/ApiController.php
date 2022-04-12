<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class ApiController extends Controller
{
    public function total(Request $request)
    {
        $allRequest = $request->all();
        if (!isset($allRequest['total'])) {
            return response()->json(["message" => "total required"], 400);
        }
        if (!isset($allRequest['persen_pajak'])) {
            return response()->json(["message" => "persen_pajak required"], 400);
        }
        $dpp = $allRequest['total'] * (100 / 110);
        $ppn = $dpp * ($allRequest['persen_pajak'] / 100);
        return response()->json(["net_sales" => round($dpp, 2), "pajak_rp" => round($ppn, 2)], 200);
    }

    public function discount(Request $request)
    {
        $allRequest = $request->all();
        $total_diskon = 0;
        $persen = 0;
        $total_harga_setelah_diskon = 0;
        if (!isset($allRequest['total_sebelum_diskon'])) {
            return response()->json(["message" => "total_sebelum_diskon required"], 400);
        }

        if (isset($allRequest['discounts'])) {
            foreach ($allRequest['discounts'] as $key) {
                $persen += $key['diskon'];
            }
        }

        $persen = $persen == 0 ? 0 : $persen / 100;
        $total_diskon = $allRequest['total_sebelum_diskon'] * $persen;
        $total_harga_setelah_diskon = $allRequest['total_sebelum_diskon'] - $total_diskon;

        return response()->json(["total_diskon" => round($total_diskon, 2), "total_harga_setelah_diskon" => round($total_harga_setelah_diskon, 2)], 200);
    }
    public function ojek(Request $request)
    {
        $allRequest = $request->all();
        if (!isset($allRequest['harga_sebelum_markup'])) {
            return response()->json(["message" => "harga_sebelum_markup required"], 400);
        }
        if (!isset($allRequest['markup_persen'])) {
            return response()->json(["message" => "markup_persen required"], 400);
        }
        if (!isset($allRequest['share_persen'])) {
            return response()->json(["message" => "share_persen required"], 400);
        }

        $markupPrice = $allRequest['harga_sebelum_markup'] + ($allRequest['harga_sebelum_markup'] * ($allRequest['markup_persen'] / 100));
        $share_untuk_ojol = ($markupPrice * ($allRequest['share_persen'] / 100));
        $net_untuk_resto = $markupPrice - $share_untuk_ojol;

        return response()->json(["share_untuk_ojol" => round($share_untuk_ojol, 2), "net_untuk_resto" => round($net_untuk_resto, 2)], 200);
    }
}
