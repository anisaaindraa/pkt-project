import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { InertiaLink } from '@inertiajs/inertia-react';

export default function Dashboard({ auth }) {
  return (
    <AuthenticatedLayout
      user={auth.user}
      header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
    >
      <Head title="Dashboard" />
      <div className="py-12">
        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            {/* Data Table User Card */}
            <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
              <h3 className="text-xl font-semibold mb-4">Data Table User</h3>
              <InertiaLink href='/datatable' className="text-blue-500 hover:underline">
                Go to Data Table User
              </InertiaLink>
            </div>

            {/* Data Formulir Patroli Laut Card */}
            <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
              <h3 className="text-xl font-semibold mb-4">Data Formulir Patroli Laut</h3>
              <InertiaLink href='/patroli' className="text-blue-500 hover:underline">
                Go to Data Formulir Patroli Laut
              </InertiaLink>
            </div>

            {/* Data Formulir Pelaksanaan Tugas Card */}
            <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
              <h3 className="text-xl font-semibold mb-4">Data Formulir Pelaksanaan Tugas</h3>
              <InertiaLink href='/tugas' className="text-blue-500 hover:underline">
                Go to Data Formulir Pelaksanaan Tugas
              </InertiaLink>
            </div>

            {/* Data Formulir Pelaporan Kejadian Card */}
            <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
              <h3 className="text-xl font-semibold mb-4">Data Formulir Pelaporan Kejadian</h3>
              <InertiaLink href='/kejadian' className="text-blue-500 hover:underline">
                Go to Data Formulir Pelaporan Kejadian
              </InertiaLink>
            </div>

            {/* Data Role Card */}
            <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
              <h3 className="text-xl font-semibold mb-4">Role</h3>
              <InertiaLink href='/dataroles' className="text-blue-500 hover:underline">
                Go to Role
              </InertiaLink>
            </div>

          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  );
}