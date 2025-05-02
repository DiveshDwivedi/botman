<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use RTippin\Messenger\Contracts\MessengerProvider;
use RTippin\Messenger\Traits\Messageable;

class User extends Authenticatable implements MessengerProvider
{
    use HasApiTokens, HasFactory, Notifiable, Messageable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getProviderName(): string
    {
        return $this->name;
    }

    public function getProviderAvatarRoute(string $size = 'sm'): ?string
    {
        // You can implement custom avatar logic here
        // For now, return null to use the default avatar
        return null;
    }

    public function isMessengerBot(): bool
    {
        return false;
    }
}
