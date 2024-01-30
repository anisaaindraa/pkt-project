// DataTablePatroli.jsx

import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';

const DataTablePatroli = ({ dataPatroli }) => {
  const handleDelete = (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus data patroli ini?')) {
      Inertia.post(route('delete.data.patroli', { id }), {}, {
        onSuccess: () => {
          console.log(`Data Patroli dengan ID ${id} berhasil dihapus`);
          Inertia.reload();
        },
        onError: (error) => {
          console.error(`Terjadi kesalahan saat menghapus data patroli: ${error.message}`);
        },
      });
    }
  };

  return (
    <div className="container mx-auto mt-8">
      <div className="flex justify-between items-center mb-4">
        <h1 className="text-3xl font-semibold">Formulir Hasil Patroli Laut</h1>
      </div>
      <table className="min-w-full border border-gray-300">
        <thead className="bg-gray-200">
          <tr>
            <th className="py-2 px-4 border-b">Nomor</th>
            <th className="py-2 px-4 border-b">Hari/Tanggal</th>
            <th className="py-2 px-4 border-b">Shift</th>
            <th className="py-2 px-4 border-b">Uraian Hasil Patroli</th>
            <th className="py-2 px-4 border-b">Keterangan</th>
            <th className="py-2 px-4 border-b">Created At</th>
            <th className="py-2 px-4 border-b">Updated At</th>
            <th className="py-2 px-4 border-b">Pelapor</th>
            <th className="py-2 px-4 border-b">Mengetahui</th>
            <th className="py-2 px-4 border-b">Status</th>
            <th className="py-2 px-4 border-b">Actions</th>
          </tr>
        </thead>
        <tbody>
          {dataPatroli && dataPatroli.map((formulir_patroli_laut) => (
            <tr key={formulir_patroli_laut.id} className="border-b">
              <td className="py-2 px-4">{formulir_patroli_laut.id}</td>
              <td className="py-2 px-4">{formulir_patroli_laut.tanggal_kejadian}</td>
              <td className="py-2 px-4">{formulir_patroli_laut.m_shift_id}</td>
              <td className="py-2 px-4">{formulir_patroli_laut.uraian_hasil}</td>
              <td className="py-2 px-4">{formulir_patroli_laut.keterangan}</td>
              <td className="py-2 px-4">{formulir_patroli_laut.created_at}</td>
              <td className="py-2 px-4">{formulir_patroli_laut.updated_at}</td>
              <td className="py-2 px-4">{formulir_patroli_laut.users_id}</td>
              <td className="py-2 px-4">{formulir_patroli_laut.mengetahui}</td>
              <td className="py-2 px-4">{formulir_patroli_laut.status}</td>
              <td className="py-2 px-4">
                <InertiaLink
                  href={route('edit.data.patroli', { id: formulir_patroli_laut.id })}
                  className="bg-blue-500 text-white px-3 py-1 rounded-md mr-2 focus:outline-none focus:shadow-outline-blue"
                >
                  Edit
                </InertiaLink>
                <button
                  onClick={() => handleDelete(formulir_patroli_laut.id)}
                  className="bg-red-500 text-white px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-red"
                >
                  Delete
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>

      <InertiaLink href="/dashboard" className="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded-md">
        Back to Dashboard
      </InertiaLink>
    </div>
  );
};

export default DataTablePatroli;
