import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';
import { Inertia } from '@inertiajs/inertia';

const DataTablePatroli = ({ formulir_patroli_laut }) => {
  const handleDelete = async (id) => {
  try{
    if (confirm('Apakah Anda yakin ingin menghapus data patroli ini?')) {
     await Inertia.delete(route('formulirpatrolilaut.destroy', { id }), {}, {
        onSuccess: () => {
          console.log(`Data Patroli dengan ID ${id} berhasil dihapus`);
          Inertia.reload();
        },
        onError: (error) => {
          console.error(`Terjadi kesalahan saat menghapus data patroli: ${error.message}`);
        },
      });
    }
  }catch (error){
    console.error('Error deleting form:', error);
  }
  };

  console.log("Data Formulir Patroli Laut:", formulir_patroli_laut);
  return (
    <div className="container mx-auto mt-8">
      <div className="flex justify-between items-center mb-4">
        <h1 className="text-3xl font-semibold">Data Formulir Hasil Patroli Laut</h1>
      </div>
      <table className="min-w-full border border-gray-300">
        <thead className="bg-gray-200">
          <tr>
            <th className="py-2 px-4 border-b">Nomor</th>
            <th className="py-2 px-4 border-b">Hari/Tanggal</th>
            <th className="py-2 px-4 border-b">Shift</th>
            <th className="py-2 px-4 border-b">Uraian Hasil Patroli</th>
            <th className="py-2 px-4 border-b">Photos</th>
            <th className="py-2 px-4 border-b">Keterangan</th>
            <th className="py-2 px-4 border-b">Created At</th>
            <th className="py-2 px-4 border-b">Updated At</th>
            <th className="py-2 px-4 border-b">Actions</th>
          </tr>
        </thead>
        <tbody>
          {formulir_patroli_laut && formulir_patroli_laut.map((formulir_patroli_laut) => (
            <tr key={formulir_patroli_laut.id} className="border-b">
              <td className="py-2 px-4">{formulir_patroli_laut.id}</td>
              <td className="py-2 px-4">{formulir_patroli_laut.tanggal_kejadian}</td>
              <td className="py-2 px-4">{formulir_patroli_laut.m_shift && formulir_patroli_laut.m_shift.nama_shift}</td>
              <td className="py-2 px-4">{formulir_patroli_laut.uraian_hasil}</td>
              <td className="py-2 px-4">
                {formulir_patroli_laut.photoPatroliLauts && formulir_patroli_laut.photoPatroliLauts.map((photo) => (
                <img key={photo.id} src={photo.url} alt={`Photo ${photo.id}`} className="max-w-full mb-2" />
                ))}
              </td>
              <td className="py-2 px-4">{formulir_patroli_laut.keterangan}</td>
              <td className="py-2 px-4">{formulir_patroli_laut.created_at}</td>
              <td className="py-2 px-4">{formulir_patroli_laut.updated_at}</td>
              <td className="py-2 px-4">
              <div className="flex">
                  <InertiaLink
                    href={route('formulirpatrolilaut.edit', { id: formulir_patroli_laut.id })}
                    className="bg-blue-500 text-white px-3 py-1 rounded-md mr-1 focus:outline-none focus:shadow-outline-blue"
                  >
                    Edit
                  </InertiaLink>
                  <button
                    onClick={() => handleDelete(formulir_patroli_laut.id)}
                    className="bg-red-500 text-white px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-red"
                  >
                    Delete
                  </button>
                </div>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default DataTablePatroli;
