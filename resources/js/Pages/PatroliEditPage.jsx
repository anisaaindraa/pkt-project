import React, { useEffect, useState } from 'react';
import { Inertia } from '@inertiajs/inertia';

export default function PatroliEditPage(props) {
    const [formData, setFormData] = useState({
        tanggal_kejadian: '',
        m_shift_id: '',
        uraian_hasil: '',
        keterangan: '',
    });

  useEffect(() => {
    if (props.formlir_patroli_laut){
        setFormData({
            tanggal_kejadian: props.formulir_patroli_laut.tanggal_kejadian,
            m_shift_id: props.formulir_patroli_laut.m_shift_id,
            uraian_hasil: props.formulir_patroli_laut.uraian_hasil,
            keterangan: props.formulir_patroli_laut.keterangan,
          });
        }
    }, [props.formulir_patroli_laut]);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [name]: value,
    }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await Inertia.put(props.updateUrl, formData, {
        onSuccess: () => {
          console.log('success');
          props.onUpdateFormulirPatroliLaut(data);
          Inertia.visit(route('formulirpatrolilaut.edit'));
        },
        onError: (errors) => {
          console.log('error', errors);
        },
      });
    } catch (error) {
      console.error('Error updating patroli:', error);
    }
  };

  return (
    <div className="flex items-center justify-center min-h-screen">
      <div className="w-full max-w-md">
        <h1 className="text-3xl font-semibold mb-4 text-center">Edit Patroli</h1>
        <form onSubmit={handleSubmit} className="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="tanggal_kejadian">
              Tanggal Kejadian:
            </label>
            <input
              type="text"
              name="tanggal_kejadian"
              value={formData.tanggal_kejadian}
              onChange={handleChange}
              className="border rounded-md px-3 py-2 w-full"
            />
          </div>

          <div>
          <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="m_shift_id">
              Shift:
            </label>
            <select
              name="m_shift_id"
              value={formData.m_shift_id}
              onChange={handleChange}
              className="border rounded-md px-3 py-2 w-full"
            >
              <option value="">Select Shift</option>
              {props.m_shift.map((m_shift) => (
                <option key={m_shift.id} value={m_shift.id}>
                  {m_shift.nama_shift}
                </option>
              ))}
            </select>
          </div>

          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="uraian_hasil">
              Uraian Hasil Patroli:
            </label>
            <input
              type="text"
              name="uraian_hasil"
              value={formData.uraian_hasil}
              onChange={handleChange}
              className="border rounded-md px-3 py-2 w-full"
            />
          </div>

          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="keterangan">
              Keterangan:
            </label>
            <input
              type="text"
              name="keterangan"
              value={formData.keterangan}
              onChange={handleChange}
              className="border rounded-md px-3 py-2 w-full"
            />
          </div>

          <div className="mb-6 text-center">
            <button
              type="submit"
              className="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue"
            >
              Update Patroli
            </button>
          </div>

        </form>
      </div>
    </div>
  );
};

