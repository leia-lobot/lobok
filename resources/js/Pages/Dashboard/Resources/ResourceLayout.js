import React from "react";
import { usePage } from "@inertiajs/inertia-react";

import SelectResource from "../../../components/SelectResource";

export default function ResourceLayout({ children }) {
    const { resourceList } = usePage();

    return (
        <>
            <SelectResource list={resourceList} />
            {children}
        </>
    );
}
