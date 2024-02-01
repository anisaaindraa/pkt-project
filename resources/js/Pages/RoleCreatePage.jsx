// RoleCreatePage.jsx

import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';

const RoleCreatePage = ({ storeUrl }) => {
  // State untuk menyimpan data formulir
  const [formData, setFormData] = useState({
    nama_role: '',
  });

  // Handle perubahan input dalam formulir
  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({ ...prevData, [name]: value }));
  };

  // Handle submit formulir
  const handleSubmit = (e) => {
    e.preventDefault();

    // Kirim data formulir ke backend menggunakan Inertia
    Inertia.post(storeUrl, formData, {
      onSuccess: () => {
        // Redirect atau lakukan tindakan lain setelah sukses
        Inertia.visit(route('dataroles'));
      },
      onError: (errors) => {
        // Tangani kesalahan validasi atau respons lain
        console.error(errors);
      },
    });
  };

  return (
    <div className="container mx-auto mt-8">
      <h1 className="text-3xl font-semibold mb-4">Create New Role</h1>
      <form onSubmit={handleSubmit}>
        <div className="mb-4">
          <label htmlFor="nama_role" className="block text-sm font-medium text-gray-600">
            Role Name:
          </label>
          <input
            type="text"
            id="nama_role"
            name="nama_role"
            value={formData.nama_role}
            onChange={handleChange}
            className="mt-1 p-2 border border-gray-300 rounded w-full"
            required
          />
        </div>
        <div>
          <button type="submit" className="bg-blue-500 text-white px-4 py-2 rounded-md">
            Create Role
          </button>
        </div>
      </form>
    </div>
  );
};

export default RoleCreatePage;
