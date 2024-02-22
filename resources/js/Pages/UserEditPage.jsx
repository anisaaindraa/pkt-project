import React, { useEffect, useState } from "react";
import { Inertia } from "@inertiajs/inertia";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import DateTimePickerMui from "@/Components/DateTimePickerMui";

export default function UserEditPage(props) {
    const { users, user, m_shift, formulir_patroli_laut } = props;

    const [formData, setFormData] = useState({
        user_id: "",
        m_shift_id: "",
        keterangan: "",
        tanggal_kejadian: "",
        uraian_hasil: "",
        status: "",
    });

    useEffect(() => {
        setFormData({
            user_id: user.id,
            m_shift_id: formulir_patroli_laut.m_shift_id,
            keterangan: formulir_patroli_laut.keterangan,
            tanggal_kejadian: formulir_patroli_laut.tanggal_kejadian,
            uraian_hasil: formulir_patroli_laut.uraian_hasil,
            status: formulir_patroli_laut.status,
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
                    console.log("success");
                    props.onUpdateUser(data);
                    Inertia.visit(route("users.edit"));
                },
                onError: (errors) => {
                    console.log("error", errors);
                },
            });
        } catch (error) {
            console.error("Error updating user:", error);
        }
    };

    return (
        <AuthenticatedLayout>
            <>
                <h3 className="text-2xl text-blue-950 font-bold mb-6">
                    Formulir Edit Patroli Laut
                </h3>

                <form onSubmit={handleSubmit}>
                    <div className="space-y-12">
                        <div className="border-b border-gray-900/10 pb-12">
                            <h2 className="text-base font-semibold leading-7 text-gray-900">
                                Data Formulir
                            </h2>
                            <p className="mt-1 text-sm leading-6 text-gray-600">
                                Merubah data formulir patroli laut.
                            </p>

                            <div className="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div className="flex col-span-full gap-4">
                                    <div className="flex-1">
                                        <label
                                            htmlFor="user"
                                            className="block text-lg font-medium leading-6 text-gray-900"
                                        >
                                            Petugas
                                        </label>
                                        <div className="mt-2">
                                            <select
                                                id="user"
                                                name="user_id"
                                                className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            >
                                                {users.map((item) => (
                                                    <option
                                                        key={item.id}
                                                        value={form.user_id}
                                                        defaultValue={user.id}
                                                    >
                                                        {item.username} -{" "}
                                                        {item.nama_user}
                                                    </option>
                                                ))}
                                            </select>
                                        </div>
                                    </div>

                                    <div className="flex-1">
                                        <label
                                            htmlFor="user"
                                            className="block text-lg font-medium leading-6 text-gray-900"
                                        >
                                            Shift
                                        </label>
                                        <div className="mt-2">
                                            <select
                                                id="m_shift"
                                                name="m_shift_id"
                                                className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            >
                                                {m_shift.map((shift) => (
                                                    <option
                                                        key={shift.id}
                                                        value={
                                                            formulir_patroli_laut.m_shift_id
                                                        }
                                                        defaultValue={
                                                            formulir_patroli_laut.m_shift_id
                                                        }
                                                    >
                                                        {shift.id} -{" "}
                                                        {shift.nama_shift}
                                                    </option>
                                                ))}
                                            </select>
                                        </div>
                                    </div>

                                    <div className="flex-1">
                                        <label
                                            htmlFor="user"
                                            className="block text-lg font-medium leading-6 text-gray-900"
                                        >
                                            Keterangan
                                        </label>
                                        <div className="mt-2">
                                            <select
                                                id="keterangan"
                                                name="keterangan"
                                                className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            >
                                                <option>Aman</option>
                                                <option>Tidak Aman</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div className="col-span-full flex gap-8">
                                    <div className="flex-1">
                                        <label className="text-lg" htmlFor="">
                                            Tanggal dan Waktu Temuan
                                        </label>
                                        <DateTimePickerMui />
                                    </div>

                                    <div className="flex-1">
                                        <label
                                            htmlFor="about"
                                            className="block font-medium leading-6 text-gray-900 text-lg"
                                        >
                                            Uraian Hasil Patroli
                                        </label>
                                        <div className="mt-2">
                                            <textarea
                                                id="about"
                                                name="uraian_hasil"
                                                rows="3"
                                                className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                            >
                                                {
                                                    formulir_patroli_laut.uraian_hasil
                                                }
                                            </textarea>
                                        </div>
                                        <p className="mt-3 text-sm leading-6 text-gray-600">
                                            Jelaskan mengenai hasil temuan.
                                        </p>
                                    </div>
                                </div>

                                <div className="col-span-full">
                                    <label className="text-lg" htmlhtmlFor="">
                                        Status Laporan
                                    </label>

                                    <div className="mt-2">
                                        <select
                                            id="countries"
                                            name="status"
                                            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        >
                                            <option value="pending">
                                                Pending
                                            </option>
                                            <option value="accepted">
                                                Accepted
                                            </option>
                                            <option value="rejected">
                                                Rejected
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="mt-6 flex items-center justify-end gap-x-6">
                        <button
                            type="button"
                            className="text-sm font-semibold leading-6 text-gray-900"
                        >
                            Batalkan
                        </button>
                        <button
                            type="submit"
                            className="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                            Perbarui
                        </button>
                    </div>
                </form>
            </>
        </AuthenticatedLayout>
    );
}
