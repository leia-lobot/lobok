import React from "react";
import moment from "moment";
import { usePage } from "@inertiajs/inertia-react";

import Layout from "../../../Shared/Layout";
import OverviewCalendar from "../../../components/Calendars/OverviewCalendar";

export default function Overview() {
    const { events, resources } = usePage();

    let pEvents = events.map(event => {
        return {
            id: event.id,
            title: event.title,
            start: moment(event.start).toDate(),
            end: moment(event.end).toDate(),
            resourceId: event.resourceId
        };
    });
    const [parsedEvents] = React.useState(pEvents);

    return (
        <Layout>
            {resources.length > 0 ? (
                <>
                    <OverviewCalendar
                        events={parsedEvents}
                        resources={resources}
                    />
                </>
            ) : (
                <p>No Resources available</p>
            )}
        </Layout>
    );
}
