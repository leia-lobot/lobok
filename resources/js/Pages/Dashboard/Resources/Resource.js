import React from "react";
import { usePage } from "@inertiajs/inertia-react";
import moment from "moment";

import Layout from "../../../Shared/Layout";
import ResourceCalendar from "../../../components/Calendars/ResourceCalendar";

export default function Resource() {
    const { events, resource } = usePage();

    let parsedEvents = events.map(event => {
        return {
            id: event.id,
            title: event.title,
            start: moment(event.start).toDate(),
            end: moment(event.end).toDate(),
            resourceId: event.resourceId
        };
    });

    return (
        <Layout>
            {resource !== null ? (
                <ResourceCalendar events={parsedEvents} />
            ) : (
                <p>No Resources available</p>
            )}
        </Layout>
    );
}
