import React, { useEffect } from 'react';
import DatePicker from 'react-datepicker';
import 'react-datepicker/dist/react-datepicker.css';
import { InertiaLink, useForm } from '@inertiajs/inertia-react';

const PatroliCreatePage = (props) => {
  const { dataPatroli, shift, updateUrl } = props;
  const { id, tanggal_kejadian, m_shift_id, uraian_hasil, keterangan } = dataPatroli || {};
  const { data, setData, put, errors, processing } = useForm({
    tanggal_kejadian: tanggal_kejadian || new Date(),
    m_shift_id: m_shift_id || '',
    uraian_hasil: uraian_hasil || '',
    keterangan: keterangan || '',
    photos: [], // Array to store selected photos
  });

  useEffect(() => {
    setData({
      tanggal_kejadian,
      m_shift_id,
      uraian_hasil,
      keterangan,
    });
  }, [id, tanggal_kejadian, m_shift_id, uraian_hasil, keterangan]);

  useEffect(() => {
    console.log(errors);  // Logging errors
  }, [errors]);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setData(name, value);
  };

  const handleDateChange = (date) => {
    setData('tanggal_kejadian', date);
  };

  const handleFileChange = (e) => {
    const { name, files } = e.target;
    setData(name, files);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const formData = new FormData();
      formData.append('tanggal_kejadian', data.tanggal_kejadian.toISOString());
      formData.append('m_shift_id', data.m_shift_id);
      formData.append('uraian_hasil', data.uraian_hasil);
      formData.append('keterangan', data.keterangan);

      // Append each selected photo to the form data
      for (let i = 0; i < data.photos.length; i++) {
        formData.append(`photos[${i}]`, data.photos[i]);
      }

      await put(updateUrl, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });

      console.log('success');
    } catch (error) {
      // Handle errors
      console.error('Error creating patroli:', error);
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
            <DatePicker
              selected={data.tanggal_kejadian}
              onChange={handleDateChange}
              dateFormat="dd/MM/yyyy"
              className="border rounded-md px-3 py-2 w-full"
            />
            <br />
            {
                errors.tanggal_kejadian
            }
          </div>

          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="m_shift_id">
              Shift:
            </label>
            <select
              name="m_shift_id"
              value={data.m_shift_id}
              onChange={handleChange}
              className="border rounded-md px-3 py-2 w-full"
            >
              <option value="">Select Shift</option>
              {shift.map((shiftOption) => (
                <option key={shiftOption.id} value={shiftOption.id}>
                  {shiftOption.nama_shift}
                </option>
              ))}
            </select>
            <br />
            {
                errors.m_shift_id
            }
          </div>

          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="uraian_hasil">
              Uraian Hasil Patroli:
            </label>
            <textarea
              name="uraian_hasil"
              value={data.uraian_hasil}
              onChange={handleChange}
              className="border rounded-md px-3 py-2 w-full"
            />
            <br />
            {
                errors.uraian_hasil 
            }
          </div>

          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="photos">
              Photos:
            </label>
            <input
              type="file"
              name="photos"
              onChange={handleFileChange}
              className="border rounded-md px-3 py-2 w-full"
              multiple  // Allow multiple file selection
            />
            <br />
            {errors.photos}
          </div>

          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="keterangan">
              Keterangan:
            </label>
            <textarea
              name="keterangan"
              value={data.keterangan}
              onChange={handleChange}
              className="border rounded-md px-3 py-2 w-full"
            />
            <br />
            {errors.keterangan}
          </div>

          <div className="mb-6 text-center">
            <button
              href =""
              type="submit"
              className="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:shadow-outline-green">
              Create Formulir
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default PatroliCreatePage;
