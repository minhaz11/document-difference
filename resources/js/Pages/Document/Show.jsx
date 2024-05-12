import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head, Link} from '@inertiajs/react';
import ReactDiffViewer, { DiffMethod } from 'react-diff-viewer-continued';

export default function Show({ auth, document, latestDocumentVersion, clientLastViewedDocument }) {
    console.log(latestDocumentVersion)
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Document Show</h2>}
        >
            <Head title="Document Show"/>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <h1 className="font-bold text-center pb-5">Title : {document.title}</h1>


                        {clientLastViewedDocument && (
                            <>
                                <h3 className="font-bold text-blue-500 text-start pb-5">Difference Between Last viewed and Latest
                                    Version</h3>

                                <ReactDiffViewer
                                    oldValue={clientLastViewedDocument.body_content}
                                    newValue={latestDocumentVersion.body_content}
                                    compareMethod={DiffMethod.WORDS_WITH_SPACE}
                                    splitView={true}
                                />
                            </>
                        )}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
);
}
