import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';

const DataTugasPage = ({ formulirPelaksanaanTugas }) => {
  const handleDelete = (taskId) => {
    // Implement delete logic as needed
    console.log(`Deleting task with ID: ${taskId}`);
  };

  return (
    <div className="container mx-auto mt-8">
      <div className="flex justify-between items-center mb-4">
        <h1 className="text-3xl font-semibold">Data Formulir Pelaksanaan Tugas</h1>
      </div>
      <table className="min-w-full border border-gray-300">
        <thead className="bg-gray-200">
          <tr>
            <th className="py-2 px-4 border-b">Nomor</th>
            <th className="py-2 px-4 border-b">Hari/Tanggal</th>
            <th className="py-2 px-4 border-b">Shift</th>
            <th className="py-2 px-4 border-b">POS</th>
            <th className="py-2 px-4 border-b">SIPAM</th>
            <th className="py-2 px-4 border-b">Keterangan</th>
            <th className="py-2 px-4 border-b">Waktu dan Uraian Tugas</th>
            <th className="py-2 px-4 border-b">Inventaris POS</th>
            <th className="py-2 px-4 border-b">Actions</th>
          </tr>
        </thead>
        <tbody>
          {formulirPelaksanaanTugas.map((formulir, index) => (
            <tr key={formulir.id} className="border-b">
              <td className="py-2 px-4">{index + 1}</td>
              <td className="py-2 px-4">{formulir.tanggal_kejadian}</td>
              <td className="py-2 px-4">{formulir.shift && formulir.shift.nama_shift}</td>
              <td className="py-2 px-4">{formulir.pos && formulir.pos.nama_pos}</td>
              <td className="py-2 px-4">{formulir.sipam && formulir.sipam.nama_sipam}</td>
              <td className="py-2 px-4">{formulir.keterangan}</td>
              <td className="py-2 px-4">
                {formulir.waktu_uraian_tugas.map((waktuUraian, idx) => (
                  <div key={idx}>
                    Waktu: {waktuUraian.waktu}, Uraian: {waktuUraian.uraian_tugas}
                  </div>
                ))}
              </td>
              <td className="py-2 px-4">
                {formulir.inventaris_pos.map((inventaris, idx) => (
                  <div key={idx}>
                    ID Barang: {inventaris.m_barang_inventaris_id}, Jumlah: {inventaris.jumlah}, Keterangan: {inventaris.keterangan}
                  </div>
                ))}
              </td>
              <td className="py-2 px-4">
                <div className="flex">
                  <InertiaLink
                    href={route('formulirpelaksanaantugas.edit', formulir.id)}
                    className="bg-blue-500 text-white px-3 py-1 rounded-md mr-1 focus:outline-none focus:shadow-outline-blue"
                  >
                    Edit
                  </InertiaLink>
                  <button
                    onClick={() => handleDelete(formulir.id)}
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

export default DataTugasPage;
