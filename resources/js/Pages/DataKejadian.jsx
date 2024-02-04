// DataTableKejadian.jsx
import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';

const DataTableKejadian = ({ formulir_pelaporan_kejadian }) => {
  return (
    // console.log(formulir_pelaporan_kejadian) 
    <div className="container mx-auto mt-8">
      <table className="min-w-full border border-gray-300">
        <thead className="bg-gray-200">
          <tr>
            <th className="py-2 px-4 border-b">ID</th>
            <th className="py-2 px-4 border-b">Jenis Kejadian</th>
            <th className="py-2 px-4 border-b">Tanggal Kejadian</th>
            <th className="py-2 px-4 border-b">Waktu Kejadian</th>
            <th className="py-2 px-4 border-b">Tempat Kejadian</th>
            {/* <th className="py-2 px-4 border-b">Korban</th>
            <th className="py-2 px-4 border-b">Pelaku</th> */}
            <th className="py-2 px-4 border-b">Actions</th>
          </tr>
        </thead>
        <tbody>
          {formulir_pelaporan_kejadian &&
            formulir_pelaporan_kejadian.map((formulir) => (
              <tr key={formulir.id} className="border-b">
                <td className="py-2 px-4 text-center">{formulir.id}</td>
                <td className="py-2 px-4 text-center">{formulir.jenis_kejadian}</td>
                <td className="py-2 px-4 text-center">{formulir.tanggal_kejadian}</td>
                <td className="py-2 px-4 text-center">{formulir.waktu_kejadian}</td>
                <td className="py-2 px-4 text-center">{formulir.tempat_kejadian}</td>
                {/* <td className="py-2 px-4 text-center">{formulir.korban.map((k) => k.nama_korban).join(', ')}</td>
                <td className="py-2 px-4 text-center">{formulir.pelaku.map((p) => p.nama_pelaku).join(', ')}</td> */}
                <td className="py-2 px-4 flex items-center justify-center space-x-2">
                  {/* Actions buttons */}
                </td>
              </tr>
            ))}
        </tbody>
      </table>
    </div>
  );
};

export default DataTableKejadian;
