<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
    ];

   
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favorites():BelongsToMany{
    
        return $this->belongsToMany(Product::class);

    }

    public function addresses(): HasMany{

        return $this->hasMany(UserAddress::class);
    }

    public function orders():HasMany{
        return $this->hasMany(Order::class);
    }

    public function reviews():HasMany{
        return $this->hasMany(Review::class);
    }

    public function hasFavorite($favorite_id){
        return $this->favorites()->where('product_id', $favorite_id)->exists();
    }

    public function settings(){

        return $this->hasMany(UserSetting::class, 'user_id', 'id');

    }
    public function photos():MorphMany{
        return $this->morphMany(Photo::class, 'photoable');
    }

}
