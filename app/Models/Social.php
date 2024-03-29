<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * @method static create(array $onlyGo)
 * @method static status()
 * @method static latest()
 */
class Social extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'status',
        'link',
        'created_by',
        'updated_by',
    ];

    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }

    public function createdUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($social) {
            $social->slug = slug($social->name);
            $social->created_by = Auth::id() ?? 1;
            $social->updated_by = Auth::id() ?? 1;
        });
        static::updating(function ($social) {
            $social->slug = slug($social->name);
            $social->updated_by = Auth::id();
        });
    }
}
