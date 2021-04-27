<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'phone_verified_at',
        'country_id',
        'province_id',
        'district_id',
        'address',
        'bank_id',
        'payment_id',
        'role_id',
        'postal_code',
        'avatar',
        'provider',
        'provider_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function host()
    {
        return $this->hasOne(Host::class, 'user_id', 'id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function country()
    {
        return$this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function bookTours()
    {
        return $this->belongsToMany(BookTour::class, 'bills','book_tour_id','user_id');
    }

    public function isAdmin()
    {
        if ($this->role->name == "administrator") {
            return true;
        }
        return false;
    }

    public function scopeOnlyHost($query)
    {
        return $query->where('role_id', UserRole::HOST);
    }

    public function scopeOnlyCustomer($query)
    {
        return $query->where('role_id', UserRole::CUSTOMER);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getAvatarUrlAttribute()
    {
        return ($this->avatar) ? Storage::disk('s3')->url($this->avatar) : asset('img/anh-dai-dien.jpg');
    }

    public function getOriginalPassWordAttribute($password)
    {
        try {
            $this->attributes['password'] = Crypt::decrypt($password);
        } catch (DecryptException $e) {
            return false;
        }
    }

    public function getFullAddressAttribute()
    {
        if (isset($this->district_id) && isset($this->province_id) && isset($this->country_id)) {
            return $this->district->name . ',' . $this->province->name . ','. $this->country->name;
        }
    }

    public function getRoleNameAttribute()
    {
        if(isset($this->role_id))
        {
            switch ($this->role_id)
            {
                case UserRole::CUSTOMER:
                    return 'Customer';
                case UserRole::HOST:
                    return 'Host';
                case UserRole::ADMINISTRATOR:
                    return 'Admin';
            }
        }

        return 'Customer';
    }
}
