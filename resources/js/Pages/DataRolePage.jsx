import React, { useState } from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';
import Modal from '@/Components/Modal';
import Checkbox from '@/Components/Checkbox';
import { Inertia } from '@inertiajs/inertia';// Sesuaikan path dengan struktur folder Anda

const DataRolePage = ({ roles, permission }) => {
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [selectedRoleId, setSelectedRoleId] = useState(null);
  const [selectedPermissions, setSelectedPermissions] = useState([]);
  
  const handleDelete = async (roleId)=> {
    try {
      await Inertia.delete(`/roles/${roleId}/destroy`, {
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

  const handleAssignPermission = (roleId) => {
    setSelectedRoleId(roleId);
    setIsModalOpen(true);
  };

  const handleCloseModal = () => {
    setSelectedRoleId(null);
    setIsModalOpen(false);
  };

  const handleCheckboxChange = (permission) => {
    const updatedPermissions = selectedPermissions.includes(permission)
      ? selectedPermissions.filter((p) => p !== permission)
      : [...selectedPermissions, permission];
    setSelectedPermissions(updatedPermissions);
  };

  // Data dummy untuk checkbox
  const dummyPermissions = [
    { id: 1, nama_permission: 'Permission 1' },
    { id: 2, nama_permission: 'Permission 2' },
    { id: 3, nama_permission: 'Permission 3' },
  ];

  const handlePermissionSubmit = () => {
    // Implementasi logika penanganan submit permission di sini
    console.log('Selected Permissions:', selectedPermissions);
    // TODO: Lakukan sesuatu dengan selectedPermissions
    handleCloseModal(); // Menutup modal setelah submit
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
                {/* <InertiaLink
                  href={route('roles.destroy', { id: role.id })}
                  className="bg-red-500 text-white px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-red"
                >
                  Delete
                </InertiaLink> */}
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

      {/* Tombol kembali ke dashboard */}
      <Modal show={isModalOpen} onClose={handleCloseModal}>
        {/* Isi modal Assign Permission */}
        <div className="p-6 bg-white rounded-lg shadow-xl">
          <h1 className="text-2xl font-semibold mb-4">Assign Permission for Role ID: {selectedRoleId}</h1>
          <div>
            {permission.map((permisi) => (
              <Checkbox
                key={permisi.id}
                label={permisi.nama_permission}
                checked={selectedPermissions.includes(permisi)}
                onChange={() => handleCheckboxChange(permisi)}
              />
            ))}
          </div>
          <div className="flex justify-end mt-4">
            <button className="mr-2 bg-gray-600 text-white px-4 py-2 rounded" onClick={handleCloseModal}>
              Cancel
            </button>
            <button className="bg-blue-500 text-white px-4 py-2 rounded" onClick={handlePermissionSubmit}>
              Submit
            </button>
          </div>
        </div>
      </Modal>
    </div>
  );
};

export default DataRolePage;
