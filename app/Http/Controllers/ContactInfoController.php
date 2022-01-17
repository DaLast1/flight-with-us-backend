<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ContactInfo::select()->latest()->get();
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
            'Email' => 'required',
            'SDT' => 'required',
            'DiaChi' => 'required',
        ]);

        return ContactInfo::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdNguoiLienHe)
    {
        return ContactInfo::where('IdNguoiLienHe', '=', $IdNguoiLienHe)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdNguoiLienHe)
    {
        $contactInfo = ContactInfo::where('IdNguoiLienHe', '=', $IdNguoiLienHe)->update($request->all());
        return $contactInfo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($IdNguoiLienHe)
    {
        return ContactInfo::where('IdNguoiLienHe', '=', $IdNguoiLienHe)->delete();
    }

    public function search(Request $request)
    {
        if ($request["IdNguoiLienHe"] == '') $request["IdNguoiLienHe"] = -1;
        
        return DB::select(DB::raw('declare @param1 int = '.$request["IdNguoiLienHe"].'; select * from contact_infos where ((@param1 = -1) or (IdNguoiLienHe = @param1)) order by created_at desc;'));
    }
}
