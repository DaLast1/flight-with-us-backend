<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ticket::select()->latest()->get();
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
            'LoaiVe' => 'required',
            'GiaVe' => 'required',
            'MaChoNgoi' => 'required',
            'TrangThai' => 'required',
            'IdChuyenBay' => 'required'
        ]);

        return Ticket::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdVeMayBay)
    {
        return Ticket::where('IdVeMayBay', '=', $IdVeMayBay)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdVeMayBay)
    {
        $ticket = Ticket::where('IdVeMayBay', '=', $IdVeMayBay)->update($request->all());
        return $ticket;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($IdVeMayBay)
    {
        return Ticket::where('IdVeMayBay', '=', $IdVeMayBay)->delete();
    }

    public function search(Request $request)
    {
        if ($request["IdChuyenBay"] == '') $request["IdChuyenBay"] = -1;
        if ($request["IdVeMayBay"] == '') $request["IdVeMayBay"] = -1;

        return DB::select(DB::raw('declare @param1 int = '.$request["IdChuyenBay"].', @param2 nvarchar(100) = N\''.$request["TrangThai"].'\', @param3 int = '.$request["IdVeMayBay"].'; select * from tickets where ((@param1 = -1) or (IdChuyenBay = @param1)) and ((@param2 = \'\') or (TrangThai = @param2)) and ((@param3 = -1) or (IdVeMayBay = @param3)) order by created_at desc;'));
    }
}