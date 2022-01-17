<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Invoice::select()->latest()->get();
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
            'TongTien' => 'required',
            // 'IdNguoiThanhToan' => 'required'
        ]);

        return Invoice::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdHoaDon)
    {
        return Invoice::where('IdHoaDon', '=', $IdHoaDon)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdHoaDon)
    {
        $invoice = Invoice::where('IdHoaDon', '=', $IdHoaDon)->update($request->all());
        return $invoice;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($IdHoaDon)
    {
        return Invoice::where('IdHoaDon', '=', $IdHoaDon)->delete();
    }

    public function search(Request $request)
    {
        if ($request["IdHoaDon"] == '') $request["IdHoaDon"] = -1;

        return DB::select(DB::raw('declare @param1 int = '.$request["IdHoaDon"].'; select * from invoices where ((@param1 = -1) or (IdHoaDon = @param1)) order by created_at desc;'));
    }
}
