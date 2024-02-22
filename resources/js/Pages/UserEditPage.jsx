import React, { useEffect, useState } from "react";
import { Inertia } from "@inertiajs/inertia";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import DateTimePickerMui from "@/Components/DateTimePickerMui";

export default function UserEditPage(props) {
    const [formData, setFormData] = useState({
        role_id: "",
        username: "",
        email: "",
        nama_user: "",
        alamat_user: "",
        pekerjaan_user: "",
        npk_user: "",
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

    console.log("ISI PROPS", props);

    return (
        <AuthenticatedLayout>
            <>
                <h3 className="text-2xl text-blue-950 font-bold mb-6">
                    Formulir Edit Patroli Laut
                </h3>

                <form>
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">
                                Data Formulir
                            </h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">
                                Merubah data formulir patroli laut.
                            </p>

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div className="flex col-span-full gap-4">
                                    <div class="flex-1">
                                        <label
                                            htmlFor="user"
                                            class="block text-lg font-medium leading-6 text-gray-900"
                                        >
                                            Petugas
                                        </label>
                                        <div class="mt-2">
                                            <select
                                                id="countries"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            >
                                                <option>United States</option>
                                                <option>Canada</option>
                                                <option>France</option>
                                                <option>Germany</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="flex-1">
                                        <label
                                            htmlFor="user"
                                            class="block text-lg font-medium leading-6 text-gray-900"
                                        >
                                            Shift
                                        </label>
                                        <div class="mt-2">
                                            <select
                                                id="countries"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            >
                                                <option>United States</option>
                                                <option>Canada</option>
                                                <option>France</option>
                                                <option>Germany</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="flex-1">
                                        <label
                                            htmlFor="user"
                                            class="block text-lg font-medium leading-6 text-gray-900"
                                        >
                                            Keterangan
                                        </label>
                                        <div class="mt-2">
                                            <select
                                                id="countries"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            >
                                                <option>Aman</option>
                                                <option>Tidak Aman</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div className="col-span-full flex gap-8">
                                    <div className="flex-1">
                                        <label
                                            className="text-lg"
                                            htmlhtmlFor=""
                                        >
                                            Tanggal dan Waktu Temuan
                                        </label>
                                        <DateTimePickerMui />
                                    </div>

                                    <div className="flex-1">
                                        <label
                                            htmlFor="about"
                                            class="block font-medium leading-6 text-gray-900 text-lg"
                                        >
                                            Uraian Hasil Patroli
                                        </label>
                                        <div class="mt-2">
                                            <textarea
                                                id="about"
                                                name="about"
                                                rows="3"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                            ></textarea>
                                        </div>
                                        <p class="mt-3 text-sm leading-6 text-gray-600">
                                            Jelaskan mengenai hasil temuan.
                                        </p>
                                    </div>
                                </div>

                                <div class="col-span-full">
                                    <label className="text-lg" htmlhtmlFor="">
                                        Status Laporan
                                    </label>

                                    <div class="mt-2">
                                        <select
                                            id="countries"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        >
                                            <option>Pending</option>
                                            <option>Accepted</option>
                                            <option>Rejected</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button
                            type="button"
                            class="text-sm font-semibold leading-6 text-gray-900"
                        >
                            Batalkan
                        </button>
                        <button
                            type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                            Perbarui
                        </button>
                    </div>
                </form>
            </>
        </AuthenticatedLayout>
    );
}
