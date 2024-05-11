<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentResource;
use App\Models\Document;
use App\Services\DocumentService;
use Illuminate\Http\Request;
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
        return Inertia::render('Document/Show', [
            'document' => $document,
        ]);
    }
}
