<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasRoles;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_masjid',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the masjid that owns the User
     */
    public function masjid(): BelongsTo
    {
        return $this->belongsTo(Masjid::class, 'id_masjid', 'id');
    }

    /**
     * Get the profile associated with the User
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class, 'id_user', 'id');
    }

    /**
     * Get all of the murid for the User
     */
    public function murid(): HasMany
    {
        return $this->hasMany(Profile::class, 'id_murobbi', 'id');
    }

    /**
     * The kemampuan_user that belong to the Kemampuan
     */
    public function kemampuan_user(): BelongsToMany
    {
        return $this->belongsToMany(Kemampuan::class, 'kemampuan_user', 'id_user', 'id_kemampuan')
            ->withPivot(['total_nilai', 'created_at', 'updated_at']);
    }

    /**
     * The kemampuan_user that belong to the Kemampuan
     */
    public function hafalan_user(): BelongsToMany
    {
        return $this->belongsToMany(Hafalan::class, 'hafalan_user', 'id_user', 'id_hafalan')
            ->withPivot(['nilai', 'created_at', 'updated_at']);
    }
}
