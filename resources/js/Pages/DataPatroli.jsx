import React from "react";
import { Link } from "@inertiajs/react";
import { Inertia } from "@inertiajs/inertia";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

const DataTablePatroli = ({ formulir_patroli_laut }) => {
    const handleDelete = async (id) => {
        try {
            if (
                confirm("Apakah Anda yakin ingin menghapus data patroli ini?")
            ) {
                const response = await Inertia.delete(
                    route("formulirpatrolilaut.destroy", { id }),
                    {
                        onError: (error) => {
                            console.error(
                                `Terjadi kesalahan saat menghapus data patroli: ${error.message}`
                            );
                        },
                    }
                );

                if (response && response.status === "success") {
                    console.log(
                        `Data Patroli dengan ID ${id} berhasil dihapus`
                    );
                    Inertia.reload();
                }
            }
        } catch (error) {
            console.error("Error deleting form:", error);
        }
    };

    console.log("Data Formulir Patroli Laut:", formulir_patroli_laut);
    return (
        <AuthenticatedLayout>
            <div className="container mx-auto mt-8">
                <div className="flex justify-between items-center mb-4">
                    <h1 className="text-3xl font-semibold">
                        Data Formulir Hasil Patroli Laut
                    </h1>
                </div>
                <table className="min-w-full border border-gray-300">
                    <thead className="bg-gray-200">
                        <tr>
                            <th className="py-2 px-4 border-b">Nomor</th>
                            <th className="py-2 px-4 border-b">
                                Hari/Tanggal Temuan
                            </th>
                            <th className="py-2 px-4 border-b">Petugas</th>

                            <th className="py-2 px-4 border-b">Shift</th>
                            <th className="py-2 px-4 border-b">
                                Uraian Hasil Patroli
                            </th>

                            <th className="py-2 px-4 border-b">
                                Status Laporan
                            </th>

                            <th className="py-2 px-4 border-b">Keterangan</th>

                            <th className="py-2 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {formulir_patroli_laut &&
                            formulir_patroli_laut.map(
                                (formulir_patroli_laut, idx) => (
                                    <tr
                                        key={formulir_patroli_laut.id}
                                        className="border-b"
                                    >
                                        <td className="py-2 px-4">{idx + 1}</td>
                                        <td className="py-2 px-4">
                                            {
                                                formulir_patroli_laut.tanggal_kejadian
                                            }
                                        </td>
                                        <td className="py-2 px-4">
                                            {formulir_patroli_laut.nama_user}
                                        </td>
                                        <td className="py-2 px-4">
                                            {formulir_patroli_laut.nama_shift}
                                        </td>
                                        <td className="py-2 px-4">
                                            {formulir_patroli_laut.uraian_hasil}
                                        </td>
                                        {/* <td className="py-2 px-4">
                                            {formulir_patroli_laut.photos &&
                                                formulir_patroli_laut.photos.map(
                                                    (photo) => (
                                                        <img
                                                            key={photo.id}
                                                            src={photo.url}
                                                            alt={`Photo ${photo.id}`}
                                                            className="max-w-full mb-2"
                                                        />
                                                    )
                                                )}
                                        </td> */}

                                        <td className="py-2 px-4">
                                            {formulir_patroli_laut.status}
                                        </td>

                                        <td className="py-2 px-4">
                                            {
                                                formulir_patroli_laut.keterangan_formulir_patroli_laut
                                            }
                                        </td>

                                        <td className="py-2 px-4">
                                            <div className="flex">
                                                <Link
                                                    href={route(
                                                        "formulirpatrolilaut.edit",
                                                        {
                                                            id: formulir_patroli_laut.id_formulir_patroli_laut,
                                                        }
                                                    )}
                                                    className="bg-blue-500 text-white px-3 py-1 rounded-md mr-1 focus:outline-none focus:shadow-outline-blue"
                                                >
                                                    Edit
                                                </Link>
                                                <button
                                                    onClick={() =>
                                                        handleDelete(
                                                            formulir_patroli_laut.id_formulir_patroli_laut
                                                        )
                                                    }
                                                    className="bg-red-500 text-white px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-red"
                                                >
                                                    Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                )
                            )}
                    </tbody>
                </table>
            </div>
        </AuthenticatedLayout>
    );
};

export default DataTablePatroli;
