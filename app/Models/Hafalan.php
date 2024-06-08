<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Hafalan extends Model
{
    use HasFactory;

    protected $table = 'hafalan';
    protected $fillable = [
        'awal_surah', 
        'akhir_surah', 
        'awal_ayat', 
        'akhir_ayat', 
        'keterangan', 
    ];

    /**
     * The kemampuan_user that belong to the Kemampuan
     *
     * @return BelongsToMany
     */
    public function hafalan_user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'hafalan_user', 'id_hafalan', 'id_user')
            ->withPivot(['nilai', 'created_at', 'updated_at']);
    }
}