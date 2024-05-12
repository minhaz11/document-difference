<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use App\Services\DocumentService;
use Inertia\Inertia;

class DocumentController extends Controller
{
    public function __construct(protected DocumentService $documentService)
    {
    }

    public function index()
    {
        $documents = $this->documentService->getDocuments();

        return Inertia::render('Dashboard', [
            'documents' => DocumentResource::collection($documents),
        ]);
    }

    public function show(Document $document)
    {
        $latestDocumentVersion = $this->documentService->getLatestDocumentVersion($document);

        $clientLastViewedDocument = auth()->user()->role === UserRole::CLIENT->value
            ? $this->documentService->getClientLastViewedDocument($document)
            : null;

        return Inertia::render('Document/Show', [
            'document' => $document,
            'latestDocumentVersion' => $latestDocumentVersion,
            'clientLastViewedDocument' => $clientLastViewedDocument,
        ]);
    }
}
