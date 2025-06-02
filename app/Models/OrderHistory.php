<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'riwayat_pesanan';

    // Jika tabel tidak memakai created_at/updated_at
    public $timestamps = false;

    // Kolom-kolom yang boleh di‐mass assign
    protected $fillable = [
        'order_id',
        'id_user',
        'id_tiket',
        'waktu_pesan',
        'status',
        'total_harga',
        // tambahkan kolom lain kalau ada
    ];

    /**
     * Relasi ke User (riwayat_pesanan.id_user → users.id)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Relasi ke Ticket (riwayat_pesanan.id_tiket → tiket_pesawat.id)
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'id_tiket');
    }
}
