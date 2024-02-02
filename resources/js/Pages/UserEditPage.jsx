import React, { useEffect, useState } from 'react';
import { Inertia } from '@inertiajs/inertia';

export default function UserEditPage(props) {
  const [formData, setFormData] = useState({
    role_id: '',
    username: '',
    email: '',
    nama_user: '',
    alamat_user: '',
    pekerjaan_user: '',
    npk_user: '',
  });

  useEffect(() => {
    setFormData({
      role_id: props.user.role_id,
      username: props.user.username,
      email: props.user.email,
      nama_user: props.user.nama_user,
      alamat_user: props.user.alamat_user,
      pekerjaan_user: props.user.pekerjaan_user,
      npk_user: props.user.npk_user,
    });
  }, [props.user]);

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
          props.onUpdateUser(data);
          Inertia.visit(route('users.edit'));
        },
        onError: (errors) => {
          console.log('error', errors);
        },
      });
    } catch (error) {
      console.error('Error updating user:', error);
    }
  };

  return (
    <div className="flex items-center justify-center min-h-screen">
      <div className="w-full max-w-md">
        <h1 className="text-3xl font-semibold mb-4 text-center">Edit User</h1>
        <form onSubmit={handleSubmit} className="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
          {/* Role Dropdown */}
          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="role_id">
              Role:
            </label>
            <select
              name="role_id"
              value={formData.role_id}
              onChange={handleChange}
              className="border rounded-md px-3 py-2 w-full"
            >
              <option value="">Select Role</option>
              {props.roles.map((role) => (
                <option key={role.id} value={role.id}>
                  {role.nama_role}
                </option>
              ))}
            </select>
          </div>

          {/* Other Form Fields */}
          {/* Add other form fields here, similar to the example below */}
          {/* Replace 'inputField' with your actual form field names */}
          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="username">
              Username:
            </label>
            <input
              type="text"
              name="username"
              value={formData.username}
              onChange={handleChange}
              className="border rounded-md px-3 py-2 w-full"
            />
            <br />
          </div>

          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="email">
              Email:
            </label>
            <input
              type="text"
              name="email"
              value={formData.email}
              onChange={handleChange}
              className="border rounded-md px-3 py-2 w-full"
            />
            <br />
          </div>

          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="password">
              Password:
            </label>
            <input
              type="text"
              name="password"
              value={formData.password}
              onChange={handleChange}
              className="border rounded-md px-3 py-2 w-full"
            />
            <br />
          </div>

          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="nama_user">
              Nama User:
            </label>
            <input
              type="text"
              name="nama_user"
              value={formData.nama_user}
              onChange={handleChange}
              className="border rounded-md px-3 py-2 w-full"
            />
            <br />
          </div>

          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="pekerjaan_user">
              Pekerjaan:
            </label>
            <input
              type="text"
              name="pekerjaan_user"
              value={formData.pekerjaan_user}
              onChange={handleChange}
              className="border rounded-md px-3 py-2 w-full"
            />
            <br />
          </div>

          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="npk_user">
              NPK:
            </label>
            <input
              type="text"
              name="npk_user"
              value={formData.npk_user}
              onChange={handleChange}
              className="border rounded-md px-3 py-2 w-full"
            />
            <br />
          </div>

          {/* Add other form fields as needed */}

          {/* Submit Button */}
          <div className="mb-6 text-center">
            <button
              type="submit"
              className="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue"
            >
              Update User
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}
