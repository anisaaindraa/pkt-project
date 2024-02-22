import { useState } from "react";
import ApplicationLogo from "@/Components/ApplicationLogo";
import Dropdown from "@/Components/Dropdown";
import NavLink from "@/Components/NavLink";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink";

import AuthenticatedSidebar from "@/Components/AuthenticatedSidebar";
import AuthenticatedNavbar from "@/Components/AuthenticatedNavbar";

export default function AuthenticatedLayout({ user, header, children }) {
    const [showingNavigationDropdown, setShowingNavigationDropdown] =
        useState(false);

    return (
        <>
            <AuthenticatedNavbar />

            <AuthenticatedSidebar />

            <div class="p-4 sm:ml-64">
                <div class="p-4 mt-20">{children}</div>
            </div>
        </>
    );
}
