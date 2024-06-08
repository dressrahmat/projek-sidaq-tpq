<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profile';

    protected $fillable = [
        'id_user',
        'id_murobbi',
        'photo_profile',
        'nama_lengkap',
        'tanggal_lahir',
        'jenis_kelamin',
        'provinsi',
        'kabupaten',
        'alamat',
    ];

    /**
     * Get the user that owns the Profile
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    /**
     * Get the user that owns the Profile
     *
     * @return BelongsTo
     */
    public function murobbi(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_murobbi', 'id');
    }
}