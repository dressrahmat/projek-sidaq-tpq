<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kemampuan extends Model
{
    use HasFactory;

    protected $table = 'kemampuan';
    protected $fillable = [
        'khidmat', 
        'entrepreneur', 
        'operation', 
        'administration', 
        'leadership', 
        'speaking', 
        'mengajar'
    ];

    /**
     * The kemampuan_user that belong to the Kemampuan
     *
     * @return BelongsToMany
     */
    public function kemampuan_user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'kemampuan_user', 'id_user', 'id_kemampuan')
            ->withPivot('total_nilai');
    }
}