<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Passenger::select()->latest()->get();
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
            'HoTen' => 'required',
            'GioiTinh' => 'required',
            'NgaySinh' => 'required',
            // 'IdNguoiLienHe' => 'required'
        ]);

        return Passenger::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdHanhKhach)
    {
        return Passenger::where('IdHanhKhach', '=', $IdHanhKhach)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdHanhKhach)
    {
        $passenger = Passenger::where('IdHanhKhach', '=', $IdHanhKhach)->update($request->all());
        return $passenger;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($IdHanhKhach)
    {
        return Passenger::where('IdHanhKhach', '=', $IdHanhKhach)->delete();
    }

    public function search(Request $request)
    {
        if ($request["IdHanhKhach"] == '') $request["IdHanhKhach"] = -1;
        // if ($request["KhungGioBay"] == '') $request["KhungGioBay"] = '-1, -1';
            
        // $kgb = array_map('intval', explode(', ', $request["KhungGioBay"]));
        
        return DB::select(DB::raw('declare @param1 int = '.$request["IdHanhKhach"].'; select * from passengers where ((@param1 = -1) or (IdHanhKhach = @param1)) order by created_at desc;'));
    }
}

// declare @param1 int = '.$request["IdChuyenBay"].', @param2 nvarchar(100) = N\''.$request["HangHK"].'\', @param3 nvarchar(100) = N\''.$request["LoaiHinhBay"].'\', @param4_1 int = '.$kgb[0].', @param4_2 int = '.$kgb[1].'; select * from flights where ((@param1 = -1) or (IdChuyenBay = @param1)) and ((@param2 = \'\') or (HangHK = @param2)) and ((@param3 = \'\') or (LoaiHinhBay = @param3)) and ((@param4_1 = -1 and @param4_2 = -1) or (datepart(hour, ThoiGianKhoiHanh) >= @param4_1 and datepart(hour, ThoiGianKhoiHanh) <= @param4_2));

