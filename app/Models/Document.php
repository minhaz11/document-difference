<?php

namespace App\Models;

use App\Enums\DocumentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Document extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'document_users')
            ->withPivot('last_viewed_version')->withTimestamps();
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class,'author_id');
    }

    public function versions(): HasMany
    {
        return $this->hasMany(DocumentVersion::class);
    }

    //scopes
    public function scopeActive($query)
    {
        return $query->where('status', DocumentStatus::ACTIVE->value);
    }

    public function scopeWithClient($query, $clientId)
    {
        return $query->whereHas('clients', function ($query) use ($clientId){
            $query->where('user_id', $clientId);
        });
    }


    public function scopeWithClientLastViewedVersion($query, $userId)
    {
        return $query->addSelect([
            'last_viewed_version' => DocumentUser::select('last_viewed_version')
                ->whereColumn('document_id', 'documents.id')
                ->where('user_id', $userId)
                ->latest()
                ->limit(1),
        ]);
    }
}
