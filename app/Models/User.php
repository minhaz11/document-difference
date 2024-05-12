<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'author_id');
    }


    public function clientDocuments(): BelongsToMany
    {
        return $this->belongsToMany(Document::class, 'document_users')
            ->withPivot('last_viewed_version')->withTimestamps();
    }


    public function lastViewedVersion($document)
    {
        return $this->clientDocuments()
            ->where('document_id', $document->id)
            ->orderBy('last_viewed_version', 'desc')
            ->first();
    }

}
