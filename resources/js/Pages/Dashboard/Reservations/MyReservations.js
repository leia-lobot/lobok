import React from "react";
import { usePage } from "@inertiajs/inertia-react";

import Layout from "../../../Shared/Layout";
import ReservationTable from "../../../components/Tables/ReservationTable";

export default function MyReservations() {
    const { reservations } = usePage();

    return (
        <Layout>
            <ReservationTable reservations={reservations} />
        </Layout>
    );
}
