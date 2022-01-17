<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Flight::select()->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'HangHK' => 'required',
            'SHMayBay' => 'required',
            'ThoiGianKhoiHanh' => 'required',
            'ThoiGianHaCanh' => 'required',
            'DiaDiemKhoiHanh' => 'required',
            'DiaDiemHaCanh' => 'required',
            'LoaiHinhBay' => 'required',
            'TongSoVe' => 'required',
            'SLVeConLai' => 'required'
        ]);

        $flights = Flight::create($request->all());

        $IdChuyenBay = Flight::selectRaw('top 1 IdChuyenBay')->orderByRaw('created_at desc')->get();

        for ($count = 1; $count <= $request["TongSoVe"]; $count++)
        {
            Ticket::insert([
                'LoaiVe' => 'Phổ thông',
                'GiaVe' => '500000',
                'MaChoNgoi' => $IdChuyenBay[0]["IdChuyenBay"] . '#' . $request["SHMayBay"] . "#" . $count,
                'TrangThai' => 'Chưa bán',
                'IDChuyenBay' => $IdChuyenBay[0]["IdChuyenBay"],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        return $flights;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdChuyenBay)
    {
        return Flight::where('IdChuyenBay', '=', $IdChuyenBay)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdChuyenBay)
    {
        $flight = Flight::where('IdChuyenBay', '=', $IdChuyenBay)->update($request->all());
        return $flight;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($IdChuyenBay)
    {
        
        Ticket::where('IdChuyenBay', '=', $IdChuyenBay)->delete();
        return Flight::where('IdChuyenBay', '=', $IdChuyenBay)->delete();
    }

    public function search(Request $request)
    {
        if ($request["IdChuyenBay"] == '') $request["IdChuyenBay"] = -1;

        if ($request["KhungGioBay"] == '') $request["KhungGioBay"] = '-1, -1';
        $kgb = array_map('intval', explode(', ', $request["KhungGioBay"]));
        
        return DB::select(DB::raw('declare @param1 int = '.$request["IdChuyenBay"].', @param2 nvarchar(100) = N\''.$request["HangHK"].'\', @param3 nvarchar(100) = N\''.$request["LoaiHinhBay"].'\', @param4_1 int = '.$kgb[0].', @param4_2 int = '.$kgb[1].', @param5 nvarchar(100) = N\''.$request["DiaDiemKhoiHanh"].'\', @param6 nvarchar(100) = N\''.$request["DiaDiemHaCanh"].'\', @param7 nvarchar(100) = N\''.$request["NgayKhoiHanh"].'\'; select * from flights where ((@param1 = -1) or (IdChuyenBay = @param1)) and ((@param2 = \'\') or (HangHK = @param2)) and ((@param3 = \'\') or (LoaiHinhBay = @param3)) and ((@param4_1 = -1 and @param4_2 = -1) or (substring(ThoiGianKhoiHanh, 17, 2) > @param4_1 and substring(ThoiGianKhoiHanh, 17, 2) <= @param4_2)) and ((@param5 = \'\') or (DiaDiemKhoiHanh = @param5)) and ((@param6 = \'\') or (DiaDiemHaCanh = @param6)) and ((@param7 = \'\') or (substring(ThoiGianKhoiHanh, 0, 16) = @param7)) order by created_at desc;'));
    }
}