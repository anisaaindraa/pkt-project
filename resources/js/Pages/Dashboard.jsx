import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
// import { InertiaLink } from "@inertiajs/inertia-react";

export default function Dashboard({ auth }) {
    return (
        <AuthenticatedLayout>
            <div className="border-2 border-gray-200 rounded-lg dark:border-gray-700 p-4 mb-4">
                <h3 className="text-3xl text-blue-950 font-bold">
                    Hi, selamat datang admin!
                </h3>
            </div>
        </AuthenticatedLayout>
    );
}
