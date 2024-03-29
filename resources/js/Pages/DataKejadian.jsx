import React from "react";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/react";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

const DataTableKejadian = ({ formulir_pelaporan_kejadian }) => {
    // console.log('Formulir Pelaporan Kejadian Data:', formulir_pelaporan_kejadian);

    const handleDelete = async (id) => {
        try {
            if (
                confirm(
                    "Apakah Anda yakin ingin menghapus data pelaporan kejadian ini?"
                )
            ) {
                await Inertia.delete(
                    route("formulirpelaporankejadian.destroy", { id }),
                    {},
                    {
                        onSuccess: () => {
                            console.log(
                                `Data Pelaporan Kejadian dengan ID ${formulir.id} berhasil dihapus`
                            );
                            Inertia.reload();
                        },
                        onError: (error) => {
                            console.error(
                                `Terjadi kesalahan saat menghapus data pelaporan kejadian: ${error.message}`
                            );
                        },
                    }
                );
            }
        } catch (error) {
            console.error("Error deleting form:", error);
        }
    };

    console.log(
        "Data Formulir Pelaporan Kejadian:",
        formulir_pelaporan_kejadian
    );
    return (
        <AuthenticatedLayout>
            <div className="container mx-auto mt-8">
                <div className="flex justify-between items-center mb-4">
                    <h1 className="text-3xl font-semibold">
                        Data Formulir Pelaporan Kejadian
                    </h1>
                </div>
                <table className="min-w-full border border-gray-300">
                    <thead className="bg-gray-200">
                        <tr>
                            <th className="py-2 px-4 border-b">ID</th>
                            <th className="py-2 px-4 border-b">
                                Jenis Kejadian
                            </th>
                            <th className="py-2 px-4 border-b">
                                Tanggal Waktu Kejadian
                            </th>
                            <th className="py-2 px-4 border-b">
                                Tempat Kejadian
                            </th>
                            <th className="py-2 px-4 border-b">
                                Kerugian Akibat Kejadian
                            </th>
                            <th className="py-2 px-4 border-b">
                                Keterangan Lain
                            </th>
                            <th className="py-2 px-4 border-b">Korban</th>
                            <th className="py-2 px-4 border-b">Pelaku</th>
                            <th className="py-2 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {formulir_pelaporan_kejadian &&
                            formulir_pelaporan_kejadian.map((formulir) => (
                                <tr key={formulir.id} className="border-b">
                                    <td className="py-2 px-4 text-center">
                                        {formulir.id}
                                    </td>
                                    <td className="py-2 px-4 text-center">
                                        {formulir.jenis_kejadian}
                                    </td>
                                    <td className="py-2 px-4 text-center">
                                        {formulir.tanggal_kejadian}
                                    </td>
                                    <td className="py-2 px-4 text-center">
                                        {formulir.tempat_kejadian}
                                    </td>
                                    <td className="py-2 px-4 text-center">
                                        {formulir.kerugian_akibat_kejadian}
                                    </td>
                                    <td className="py-2 px-4 text-center">
                                        {formulir.keterangan_lain}
                                    </td>
                                    <td className="py-2 px-4 text-center">
                                        {formulir.korban
                                            ? formulir.korban
                                                  .map((k) => k.nama_korban)
                                                  .join(", ")
                                            : "No Korban"}
                                    </td>
                                    <td className="py-2 px-4 text-center">
                                        {formulir.pelaku
                                            ? formulir.pelaku
                                                  .map((p) => p.nama_pelaku)
                                                  .join(", ")
                                            : "No Pelaku"}
                                    </td>
                                    <td className="py-2 px-4 flex items-center justify-center space-x-2">
                                        <Link
                                            href={route(
                                                "formulirpelaporankejadian.edit",
                                                { id: formulir.id }
                                            )}
                                            className="bg-blue-500 text-white px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-blue"
                                        >
                                            Edit
                                        </Link>
                                        <button
                                            onClick={() =>
                                                handleDelete(formulir.id)
                                            }
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
        </AuthenticatedLayout>
    );
};

export default DataTableKejadian;
