<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'employee_id',
        'first_name',
        'middle_name',
        'last_name',
        'designation',
        'username',
        'email',
        'email_verified_at',
        'password',
        'office_id',
        'role_id',
        'is_active',
        'is_archived',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'is_archived' => 'boolean',
        ];
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            'user_permissions',
            'user_id',
            'permission_id'
        )->withTimestamps();
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function payslips(): HasMany
    {
        return $this->hasMany(Payslip::class);
    }

    public function hasPermission(string $slug): bool
    {
        // Check direct user permission first, then fall back to role
        if ($this->permissions()->where('slug', $slug)->exists()) {
            return true;
        }

        return $this->role?->permissions()->where('slug', $slug)->exists() ?? false;
    }

    public function hasRole(string $name): bool
    {
        return $this->role?->name === $name;
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }
}
