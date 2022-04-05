<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    // PostgreSQL
    protected $primaryKey = 'IdVeMayBay';

    protected $fillable = [
        'LoaiVe',
        'GiaVe',
        'MaChoNgoi',
        'TrangThai',
        'IdChuyenBay'
    ];
}
