import React, { useEffect, useState } from "react";
import { Inertia } from "@inertiajs/inertia";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { DateTimePicker } from "@mui/x-date-pickers/DateTimePicker";
import dayjs from "dayjs";

export default function KejadianEditPage(props) {
    const [formData, setFormData] = useState({
        users_id: "",
        jenis_kejadian: "",
        tanggal_kejadian: "",
        waktu_kejadian: "",
        tempat_kejadian: "",
        kerugian_akibat_kejadian: "",
        keterangan_lain: "",
        korban: [],
        pelaku: [],
    });

    console.log("Formulir Pelaporan Kejadian Data:", formData);

    useEffect(() => {
        setFormData({
            users_id: props.formulir?.users_id || "",
            jenis_kejadian: props.formulir?.jenis_kejadian || "",
            tanggal_kejadian: props.formulir?.tanggal_kejadian || "",
            tempat_kejadian: props.formulir?.tempat_kejadian || "",
            kerugian_akibat_kejadian:
                props.formulir?.kerugian_akibat_kejadian || "",
            keterangan_lain: props.formulir?.keterangan_lain || "",
            penanganan: props.formulir?.penanganan || "",
            korban: props.formulir?.korban || [],
            pelaku: props.formulir?.pelaku || [],
        });
    }, [props.formulir]);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData((prevData) => ({
            ...prevData,
            [name]: value,
        }));
    };

    const handleKorbanChange = (index, field, value) => {
        const updatedKorban = [...formData.korban];
        updatedKorban[index] = {
            ...updatedKorban[index],
            [field]: value,
        };
        setFormData((prevData) => ({
            ...prevData,
            korban: updatedKorban,
        }));
    };

    const handlePelakuChange = (index, field, value) => {
        const updatedPelaku = [...formData.pelaku];
        updatedPelaku[index] = {
            ...updatedPelaku[index],
            [field]: value,
        };
        setFormData((prevData) => ({
            ...prevData,
            pelaku: updatedPelaku,
        }));
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            await Inertia.put(props.updateUrl, formData, {
                onSuccess: () => {
                    console.log("success");
                    props.onUpdateKejadian(formData);
                    Inertia.visit(route("formulirpelaporankejadian.edit"));
                },
                onError: (errors) => {
                    console.log("error", errors);
                },
            });
        } catch (error) {
            console.error("Error updating kejadian:", error);
        }
    };

    return (
        <AuthenticatedLayout>
            <div className="flex items-center justify-center min-h-screen">
                <div className="w-full max-w-md">
                    <h1 className="text-3xl font-semibold mb-4 text-center">
                        Edit Kejadian
                    </h1>
                    <form
                        onSubmit={handleSubmit}
                        className="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                    >
                        <div className="mb-4">
                            <label
                                className="block text-gray-700 text-sm font-bold mb-2"
                                htmlFor="jenis_kejadian"
                            >
                                Jenis Kejadian:
                            </label>
                            <input
                                type="text"
                                name="jenis_kejadian"
                                value={formData.jenis_kejadian}
                                onChange={handleChange}
                                className="border rounded-md px-3 py-2 w-full"
                            />
                        </div>

                        <div className="mb-4">
                            <label
                                className="block text-gray-700 text-sm font-bold mb-2"
                                htmlFor="tanggal_kejadian"
                            >
                                Tanggal Kejadian:
                            </label>
                            <DateTimePicker
                                name="tanggal_kejadian"
                                value={dayjs(formData.tanggal_kejadian)}
                                onChange={(e) => {
                                    setFormData({
                                        ...formData,
                                        tanggal_kejadian: e.toISOString(),
                                    });
                                }}
                            />
                        </div>

                        <div className="mb-4">
                            <label
                                className="block text-gray-700 text-sm font-bold mb-2"
                                htmlFor="tempat_kejadian"
                            >
                                Tempat Kejadian:
                            </label>
                            <input
                                type="text"
                                name="tempat_kejadian"
                                value={formData.tempat_kejadian}
                                onChange={handleChange}
                                className="border rounded-md px-3 py-2 w-full"
                            />
                        </div>

                        <div className="mb-4">
                            <label
                                className="block text-gray-700 text-sm font-bold mb-2"
                                htmlFor="kerugian_akibat_kejadian"
                            >
                                Kerugian Akibat Kejadian:
                            </label>
                            <input
                                type="text"
                                name="kerugian_akibat_kejadian"
                                value={formData.kerugian_akibat_kejadian}
                                onChange={handleChange}
                                className="border rounded-md px-3 py-2 w-full"
                            />
                        </div>

                        <div className="mb-4">
                            <label
                                className="block text-gray-700 text-sm font-bold mb-2"
                                htmlFor="keterangan_lain"
                            >
                                Keterangan Lain:
                            </label>
                            <input
                                type="text"
                                name="keterangan_lain"
                                value={formData.keterangan_lain}
                                onChange={handleChange}
                                className="border rounded-md px-3 py-2 w-full"
                            />
                        </div>

                        {/* Korban Section */}
                        <div className="mb-4">
                            <h2 className="text-xl font-semibold mb-2">
                                Edit Korban
                            </h2>

                            {formData.korban &&
                                formData.korban.map((korban, index) => (
                                    <div key={index}>
                                        <label htmlFor={`korban_nama_${index}`}>
                                            Nama Korban:
                                        </label>
                                        <input
                                            type="text"
                                            name={`korban_nama_${index}`}
                                            value={korban?.nama_korban}
                                            onChange={(e) =>
                                                handleKorbanChange(
                                                    index,
                                                    "nama_korban",
                                                    e.target.value
                                                )
                                            }
                                        />

                                        <label htmlFor={`korban_umur_${index}`}>
                                            Umur Korban:
                                        </label>
                                        <input
                                            type="text"
                                            name={`korban_umur_${index}`}
                                            value={korban?.umur_korban}
                                            onChange={(e) =>
                                                handleKorbanChange(
                                                    index,
                                                    "umur_korban",
                                                    e.target.value
                                                )
                                            }
                                        />

                                        <label
                                            htmlFor={`korban_pekerjaan_${index}`}
                                        >
                                            Pekerjaan Korban:
                                        </label>
                                        <input
                                            type="text"
                                            name={`korban_pekerjaan_${index}`}
                                            value={korban?.pekerjaan_korban}
                                            onChange={(e) =>
                                                handleKorbanChange(
                                                    index,
                                                    "pekerjaan_korban",
                                                    e.target.value
                                                )
                                            }
                                        />

                                        <label
                                            htmlFor={`korban_alamat_${index}`}
                                        >
                                            Alamat Korban:
                                        </label>
                                        <input
                                            type="text"
                                            name={`korban_alamat_${index}`}
                                            value={korban?.alamat_korban}
                                            onChange={(e) =>
                                                handleKorbanChange(
                                                    index,
                                                    "alamat_korban",
                                                    e.target.value
                                                )
                                            }
                                        />

                                        <label
                                            htmlFor={`korban_no_tlp_${index}`}
                                        >
                                            No Telepon Korban:
                                        </label>
                                        <input
                                            type="text"
                                            name={`korban_no_tlp_${index}`}
                                            value={korban?.no_tlp__korban}
                                            onChange={(e) =>
                                                handleKorbanChange(
                                                    index,
                                                    "no_tlp_korban",
                                                    e.target.value
                                                )
                                            }
                                        />
                                    </div>
                                ))}
                        </div>

                        {/* Pelaku Section */}
                        <div className="mb-4">
                            <h2 className="text-xl font-semibold mb-2">
                                Edit Pelaku
                            </h2>
                            {formData.pelaku &&
                                formData.pelaku.map((pelaku, index) => (
                                    <div key={index}>
                                        <label htmlFor={`pelaku_nama_${index}`}>
                                            Nama Pelaku:
                                        </label>
                                        <input
                                            type="text"
                                            name={`pelaku_nama_${index}`}
                                            value={pelaku?.nama_pelaku}
                                            onChange={(e) =>
                                                handlePelakuChange(
                                                    index,
                                                    "nama_pelaku",
                                                    e.target.value
                                                )
                                            }
                                        />

                                        <label htmlFor={`pelaku_umur_${index}`}>
                                            Umur Pelaku:
                                        </label>
                                        <input
                                            type="text"
                                            name={`pelaku_umur_${index}`}
                                            value={pelaku?.umur_pelaku}
                                            onChange={(e) =>
                                                handlePelakuChange(
                                                    index,
                                                    "umur_pelaku",
                                                    e.target.value
                                                )
                                            }
                                        />

                                        <label
                                            htmlFor={`pelaku_pekerjaan_${index}`}
                                        >
                                            Pekerjaan Pelaku:
                                        </label>
                                        <input
                                            type="text"
                                            name={`pelaku_pekerjaan_${index}`}
                                            value={pelaku?.pekerjaan_pelaku}
                                            onChange={(e) =>
                                                handlePelakuChange(
                                                    index,
                                                    "pekerjaan_pelaku",
                                                    e.target.value
                                                )
                                            }
                                        />

                                        <label
                                            htmlFor={`pelaku_alamat_${index}`}
                                        >
                                            Alamat Pelaku:
                                        </label>
                                        <input
                                            type="text"
                                            name={`pelaku_alamat_${index}`}
                                            value={pelaku?.alamat_pelaku}
                                            onChange={(e) =>
                                                handlePelakuChange(
                                                    index,
                                                    "alamat_pelaku",
                                                    e.target.value
                                                )
                                            }
                                        />

                                        <label
                                            htmlFor={`pelaku_no_tlp_${index}`}
                                        >
                                            No Telepon Pelaku:
                                        </label>
                                        <input
                                            type="text"
                                            name={`pelaku_no_tlp_${index}`}
                                            value={pelaku?.no_tlp_pelaku}
                                            onChange={(e) =>
                                                handlePelakuChange(
                                                    index,
                                                    "no_tlp_pelaku",
                                                    e.target.value
                                                )
                                            }
                                        />
                                    </div>
                                ))}
                        </div>

                        {/* Submit Button */}
                        <div className="mb-6 text-center">
                            <button
                                type="submit"
                                className="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue"
                            >
                                Update Kejadian
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
