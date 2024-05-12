<?php

namespace App\Console\Commands;

use App\Enums\DocumentStatus;
use App\Models\DocumentUser;
use App\Models\User;
use Illuminate\Console\Command;
use Text_Diff;
use Text_Diff_Renderer_inline;

class StoreDocumentDifference extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:document-difference';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store document differences for clients';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $clients = User::clients()->active()
            ->with(['clientDocuments' => function ($query) {
                $query->active();
            }])->get();

        foreach ($clients as $client)
        {
            foreach ($client->clientDocuments as $document)
            {

                $latestDocument = $document->versions()->orderBy('version', 'DESC')->first();
                $lastViewedDocument = $document->versions()->where('version', $document->pivot->last_viewed_version)->first();

                if (($latestDocument && $lastViewedDocument) && $latestDocument->id != $lastViewedDocument->id)
                {
                    $difference = $this->determineDocumentDifference(
                        $lastViewedDocument->body_content,
                        $latestDocument->body_content
                    );

                    if($difference){
                        DocumentUser::create([
                            'user_id' => $client->id,
                            'document_id' => $document->id,
                            'document_difference' => $difference,
                            'last_viewed_version' => $lastViewedDocument->version,
                        ]);
                    }

                }


            }
        }
    }

    private function determineDocumentDifference($lastViewedContent, $latestContent): string
    {
        $difference     = new Text_Diff(explode("\n", $lastViewedContent), explode("\n", $latestContent));
        $renderer = new Text_Diff_Renderer_inline();

        return $renderer->render($difference);
    }
}
