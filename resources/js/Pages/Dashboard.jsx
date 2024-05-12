import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head, Link} from '@inertiajs/react';

export default function Dashboard({ auth, documents }) {

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard"/>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="flex flex-col">
                            <div className="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div className="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                    <div className="overflow-hidden">
                                        <table className="min-w-full">
                                            <thead className="bg-white border-b">
                                            <tr>
                                                <th scope="col"
                                                    className="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    #
                                                </th>
                                                <th scope="col"
                                                    className="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Title
                                                </th>
                                                <th scope="col"
                                                    className="text-sm font-medium text-gray-900 px-6 py-4 text-center">
                                                    Current Version
                                                </th>
                                                <th scope="col"
                                                    className="text-sm font-medium text-gray-900 px-6 py-4 text-center">
                                                    Status
                                                </th>
                                                <th scope="col"
                                                    className="text-sm font-medium text-gray-900 px-6 py-4 text-center">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            {documents.data.length > 0 ? (
                                                documents.data.map((document, index) => (
                                                    <tr key={document.id} className="bg-gray-100 border-b">
                                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                            {index + 1}
                                                        </td>
                                                        <td className="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                            {document.title}
                                                        </td>
                                                        <td className="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                                            {document.current_version}
                                                        </td>
                                                        <td className="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                                            {document.status}
                                                        </td>
                                                        <td className="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">

                                                                <Link href={route('documents.show', document.id)}
                                                                   className="text-indigo-600 hover:text-indigo-900">
                                                                    View
                                                                </Link>

                                                        </td>
                                                    </tr>
                                                ))
                                            ) : (
                                                <tr className="bg-gray-100 border-b">
                                                    <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center"
                                                        colSpan="5">
                                                        No documents found!
                                                    </td>
                                                </tr>
                                            )}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
