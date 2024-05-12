import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head, Link} from '@inertiajs/react';

export default function Show({ auth, document, latestDocumentVersion, clientLastViewedDocument }) {
    console.log(latestDocumentVersion)
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Document Show"/>

            <div className="py-12">
                <h1 className="font-bold text-center">{document.title}</h1>

                <h2>Latest Version</h2>
                <pre>{latestDocumentVersion.body_content}</pre>

                {clientLastViewedDocument && (
                    <>
                        <h2>Last Viewed Version</h2>
                        <pre>{clientLastViewedDocument.body_content}</pre>

                        <h2>Diff</h2>
                        <div id="diffContainer"></div>
                    </>
                )}
            </div>
        </AuthenticatedLayout>
    );
}
