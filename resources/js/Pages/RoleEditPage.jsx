// RoleEditPage.jsx

import React, { useEffect, useState } from 'react';
import { Inertia } from '@inertiajs/inertia';

const RoleEditPage = ({ role, updateUrl }) => {
  const [formData, setFormData] = useState({
    nama_role: '',
  });

  useEffect(() => {
    setFormData({
      nama_role: role.nama_role,
    });
  }, [role]);

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
      await Inertia.put(updateUrl, formData, {
        onSuccess: () => {
          console.log('success');
          // Handle success action if needed
          Inertia.visit(route('dataroles')); // Redirect to the data roles page after successful update
        },
        onError: (errors) => {
          console.log('error', errors);
          // Handle error action if needed
        },
      });
    } catch (error) {
      console.error('Error updating role:', error);
    }
  };

  return (
    <div className="flex items-center justify-center min-h-screen">
      <div className="w-full max-w-md">
        <h1 className="text-3xl font-semibold mb-4 text-center">Edit Role</h1>
        <form onSubmit={handleSubmit} className="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="nama_role">
              Role Name:
            </label>
            <input
              type="text"
              name="nama_role"
              value={formData.nama_role}
              onChange={handleChange}
              className="border rounded-md px-3 py-2 w-full"
            />
          </div>

          {/* Submit Button */}
          <div className="mb-6 text-center">
            <button
              type="submit"
              className="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue"
            >
              Update Role
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default RoleEditPage;
