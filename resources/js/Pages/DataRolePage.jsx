// DataRolePage.jsx

import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';

const DataRolePage = ({ roles }) => {
  const handleDelete = (roleId) => {
    // ... implementasi handleDelete
  };

  const handleAssignPermission = (roleId) => {
    // ... implementasi handleAssignPermission
  };

  return (
    <div className="container mx-auto mt-8">
      <div className="flex justify-between items-center mb-4">
        <h1 className="text-3xl font-semibold">Role Data Table</h1>
        <InertiaLink href={route('create.roles')} className="bg-green-500 text-white px-4 py-2 rounded-md">
          Create
        </InertiaLink>
      </div>
      <table className="min-w-full border border-gray-300">
        <thead className="bg-gray-200">
          <tr>
            <th className="py-2 px-4 border-b">ID Role</th>
            <th className="py-2 px-4 border-b">Nama Role</th>
            <th className="py-2 px-4 border-b">Created At</th>
            <th className="py-2 px-4 border-b">Updated At</th>
            <th className="py-2 px-4 border-b">Actions</th>
          </tr>
        </thead>
        <tbody>
          {roles && roles.map((role) => (
            <tr key={role.id} className="border-b">
              <td className="py-2 px-4 text-center">{role.id}</td>
              <td className="py-2 px-4 text-center">{role.nama_role}</td>
              <td className="py-2 px-4 text-center">{role.created_at}</td>
              <td className="py-2 px-4 text-center">{role.updated_at}</td>
              <td className="py-2 px-4 flex items-center justify-center space-x-2">
                <InertiaLink
                  href={route('roles.edit', { id: role.id })}
                  className="bg-blue-500 text-white px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-blue"
                >
                  Edit
                </InertiaLink>
                <button
                  onClick={() => handleDelete(role.id)}
                  className="bg-red-500 text-white px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-red"
                >
                  Delete
                </button>
                <button
                  onClick={() => handleAssignPermission(role.id)}
                  className="bg-yellow-500 text-white px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-yellow"
                >
                  Assign Permission
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>

      <InertiaLink href="/dashboard" className="block bg-gray-500 text-white px-4 py-2 w-fit rounded-md mt-4">
        Back to Dashboard
      </InertiaLink>
    </div>
  );
};

export default DataRolePage;
