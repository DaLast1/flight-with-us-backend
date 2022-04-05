<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    // PostgreSQL
    protected $primaryKey = 'IdChiTietHoaDon';

    protected $fillable = [
        'Thue',
        'ThanhTien',
        'HLKG',
        'DVBS',
        'IdVeMayBay',
        'IdHanhKhach',
        'IdHoaDon',
    ];
}