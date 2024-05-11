<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\Document;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class DocumentService
{
    public function getDocuments(): ?LengthAwarePaginator
    {
        $user = Auth::user();

        return ($user->role === UserRole::AUTHOR->value)
            ? $this->getDocumentsOfAuthor($user)
            : $this->getDocumentsOfClient($user);
    }

    public function getDocumentsOfAuthor(User $author): LengthAwarePaginator
    {
        return Document::active()->whereAuthorId($author->id)
            ->whereHas('versions')
            ->latest()->paginate(20);

    }

    public function getDocumentsOfClient(User $client): LengthAwarePaginator
    {
        return Document::active()
            ->whereHas('versions')
            ->withClient($client->id)
            ->latest()->paginate(20);
    }
}
