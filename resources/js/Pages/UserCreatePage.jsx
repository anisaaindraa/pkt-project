import React, { useEffect, useState } from 'react';
import { router } from "@inertiajs/react";

export default function UserCreatePage(props) {
  const [formData, setFormData] = useState({
    role_id: '',
    username: '',
    email: '',
    nama_user: '',
    alamat_user: '',
    pekerjaan_user: '',
    npk_user: '',
  });

  useEffect(()=>{
    console.log(props);
  }, []);

  useEffect(() => {
    console.log(props.errors);
  }, [props.errors]);

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
      router.post(props.storeUrl, formData, {
        onSuccess: () => {
          console.log('success')
        },
        onError: () => {
          console.log('error')
        }
      });
  
      // Redirect to the DataTablePage or other page
      // Inertia.visit(route('datatable'));
    } catch (error) {
      // Check if the error is due to validation failure
      if (error.response && error.response.status === 422) {
        // Handle validation errors, for example, by updating the form state
        console.log('Validation error:', error.response.data.errors);
      } else {
        // Handle other types of errors, e.g., server error
        console.error('Error creating user:', error);
        // Optionally, you can redirect to an error page or display a notification
      }
    }
  
  };

  return (
    <div className="flex items-center justify-center min-h-screen">
      <div className="w-full max-w-md">
        <h1 className="text-3xl font-semibold mb-4 text-center">Create User</h1>
        <div className='alert'>error</div>
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
              {
                props.roles.map((role) => <option key={role.id} value={role.id}>{role.nama_role}</option>)
              }
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
            {
              props.errors.email
            }
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
            {
              props.errors.nama_user
            }
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
            {
              props.errors.password
            }
          </div>

          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="alamat_user">
              Alamat User:
            </label>
            <input
              type="text"
              name="alamat_user"
              value={formData.alamat_user}
              onChange={handleChange}
              className="border rounded-md px-3 py-2 w-full"
            />
            <br />
            {
              props.errors.alamat_user
            }
          </div>

          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="pekerjaan_user">
              Pekerjaan User:
            </label>
            <input
              type="text"
              name="pekerjaan_user"
              value={formData.pekerjaan_user}
              onChange={handleChange}
              className="border rounded-md px-3 py-2 w-full"
            />
            <br />
            {
              props.errors.pekerjaan_user
            }
          </div>

          <div className="mb-4">
            <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="npk_user">
              NPK User:
            </label>
            <input
              type="text"
              name="npk_user"
              value={formData.npk_user}
              onChange={handleChange}
              className="border rounded-md px-3 py-2 w-full"
            />
            <br />
            {
              props.errors.npk_user
            }
          </div>

          {/* Add other form fields as needed */}

          {/* Submit Button */}
          <div className="mb-6 text-center">
            <button
              href =""
              type="submit"
              className="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:shadow-outline-green">
              Create User
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}

