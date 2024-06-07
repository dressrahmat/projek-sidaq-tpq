<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Masjid extends Model
{
    use HasFactory;
    protected $table = 'masjid';

    protected $fillable = [
        'photo_masjid',
        'nama_masjid',
    ];

    /**
     * Get all of the user for the Masjid
     *
     * @return HasMany
     */
    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'id_masjid', 'id');
    }
}