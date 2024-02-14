import React, { useState } from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';
import { Inertia } from '@inertiajs/inertia';

const DataTablePage = ({ users }) => {
  const handleDelete = async (userId) => {
    try {
      await Inertia.delete(`/users/${userId}/destroy`, {
        onSuccess: () => {
          console.log('success');
          // Handle success action if needed
          Inertia.visit(route('datatable')); // Redirect to the data roles page after successful update
        },
        onError: (errors) => {
          console.log('error', errors);
          // Handle error action if needed
        },
      });
    } catch (error) {
      console.error('Error updating User:', error);
    }
  };

  return (
    <div className="container mx-auto mt-8">
      <div className="flex justify-between items-center mb-4">
        <h1 className="text-3xl font-semibold">User Data Table</h1>
        <InertiaLink href={route('create.users.page')} className="bg-green-500 text-white px-4 py-2 rounded-md">
          Create
        </InertiaLink>
      </div>
      <table className="min-w-full border border-gray-300">
        <thead className="bg-gray-200">
          <tr>
            <th className="py-2 px-4 border-b">ID User</th>
            <th className="py-2 px-4 border-b">Username</th>
            <th className="py-2 px-4 border-b">Email</th>
            <th className="py-2 px-4 border-b">Nama</th>
            <th className="py-2 px-4 border-b">Pekerjaan</th>
            <th className="py-2 px-4 border-b">NPK</th>
            <th className="py-2 px-4 border-b">Created At</th>
            <th className="py-2 px-4 border-b">Updated At</th>
            <th className="py-2 px-4 border-b">Actions</th>
          </tr>
        </thead>
        <tbody>
          {users && users.map((user) => (
            <tr key={user.id} className="border-b">
              <td className="py-2 px-4">{user.id}</td>
              <td className="py-2 px-4">{user.username}</td>
              <td className="py-2 px-4">{user.email}</td>
              <td className="py-2 px-4">{user.nama_user}</td>
              <td className="py-2 px-4">{user.pekerjaan_user}</td>
              <td className="py-2 px-4">{user.npk_user}</td>
              <td className="py-2 px-4">{user.created_at}</td>
              <td className="py-2 px-4">{user.updated_at}</td>
              <td className="py-2 px-4 flex">

              <InertiaLink
                href={route('users.edit', { id: user.id })}
                className="bg-blue-500 text-white px-3 py-1 rounded-md mr-2 focus:outline-none focus:shadow-outline-blue"
              >
                Edit
              </InertiaLink>
                <button
                  onClick={() => handleDelete(user.id)}
                  className="bg-red-500 text-white px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-red"
                >
                  Delete
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default DataTablePage;
