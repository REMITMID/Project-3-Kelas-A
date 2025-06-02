<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    // Pastikan nama tabel sesuai dengan yang di database
    protected $table = 'tiket_pesawat';

    // Jika tabel kamu tidak memakai created_at dan updated_at
    public $timestamps = false;

    // Kolom-kolom yang boleh di-mass assign
    protected $fillable = [
        'maskapai',
        'asal',
        'tujuan',
        'tanggal',
        'jam_berangkat',
        'jam_tiba',
        'kelas',
        'harga',
        'kode_penerbangan',
    ];
}
