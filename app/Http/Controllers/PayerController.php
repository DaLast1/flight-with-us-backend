<?php

namespace App\Http\Controllers;

use App\Models\Payer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Payer::select()->latest()->get();
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
            // 'GioiTinh' => 'required',
            'Email' => 'required',
            'SDT' => 'required',
            'DiaChi' => 'required',
            'QuocGia' => 'required',
            'ThanhPho' => 'required',
        ]);

        return Payer::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdNguoiThanhToan)
    {
        return Payer::where('IdNguoiThanhToan', '=', $IdNguoiThanhToan)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdNguoiThanhToan)
    {
        $payer = Payer::where('IdNguoiThanhToan', '=', $IdNguoiThanhToan)->update($request->all());
        return $payer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($IdNguoiThanhToan)
    {
        return Payer::where('IdNguoiThanhToan', '=', $IdNguoiThanhToan)->delete();
    }

    public function search(Request $request)
    {
        if ($request["IdNguoiThanhToan"] == '') $request["IdNguoiThanhToan"] = -1;
        
        // PostgreSQL
        return DB::select(DB::raw('with var (param1) as (values ('.$request["IdNguoiThanhToan"].')) select * from payers, var where ((param1 = -1) or ("IdNguoiThanhToan" = param1)) order by created_at desc;'));

        // SQL Server
        // return DB::select(DB::raw('declare @param1 int = '.$request["IdNguoiThanhToan"].'; select * from payers where ((@param1 = -1) or (IdNguoiThanhToan = @param1)) order by created_at desc;'));
    }
}
