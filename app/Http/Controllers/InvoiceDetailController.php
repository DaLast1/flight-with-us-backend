<?php

namespace App\Http\Controllers;

use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return InvoiceDetail::select()->latest()->get();
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
            // 'Thue' => 'required',
            'ThanhTien' => 'required',
            // 'HLKG' => 'required',
            // 'DVBS' => 'required',
            'IdVeMayBay' => 'required',
            'IdHanhKhach' => 'required',
            'IdHoaDon' => 'required',
        ]);

        return InvoiceDetail::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdChiTietHoaDon)
    {
        return InvoiceDetail::where('IdChiTietHoaDon', '=', $IdChiTietHoaDon)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdChiTietHoaDon)
    {
        $invoiceDetail = InvoiceDetail::where('IdChiTietHoaDon', '=', $IdChiTietHoaDon)->update($request->all());
        return $invoiceDetail;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($IdChiTietHoaDon)
    {
        return InvoiceDetail::where('IdChiTietHoaDon', '=', $IdChiTietHoaDon)->delete();
    }

    public function search(Request $request)
    {
        if ($request["IdChiTietHoaDon"] == '') $request["IdChiTietHoaDon"] = -1;

        return DB::select(DB::raw('declare @param1 int = '.$request["IdChiTietHoaDon"].'; select * from invoice_details where ((@param1 = -1) or (IdChiTietHoaDon = @param1)) order by created_at desc;'));
    }
}
