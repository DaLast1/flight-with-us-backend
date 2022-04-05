<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // PostgreSQL
    protected $primaryKey = 'IdHoaDon';

    protected $fillable = [
        'TongTien',
        'IdNguoiThanhToan'
    ];
}