<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    // PostgreSQL
    protected $primaryKey = 'IdHanhKhach';

    protected $fillable = [
        'HoTen',
        'GioiTinh',
        'NgaySinh',
        'IdNguoiLienHe'
    ];
}