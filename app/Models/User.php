<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Konstanta role biar rapi & terhindar dari typo
    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER  = 'user';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar', // sudah ditambahkan
    ];

    // Default kalau tidak diisi (sinkron dengan default kolom di DB)
    protected $attributes = [
        'role' => self::ROLE_USER,
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // otomatis hash saat set
            'role' => 'string',
        ];
    }

    // Normalisasi role ke lowercase saat diset
    protected function role(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => is_string($value) ? strtolower($value) : $value
        );
    }

    // Helper cepat
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function hasRole(string|array $roles): bool
    {
        return in_array($this->role, (array) $roles, true);
    }

    // Scope query: User::role('admin')->get();
    public function scopeRole($query, string $role)
    {
        return $query->where('role', $role);
    }
}
