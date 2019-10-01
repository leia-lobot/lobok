import React from "react";
import moment from "moment";
import { usePage } from "@inertiajs/inertia-react";
import { Form } from "semantic-ui-react";

import Layout from "../../../Shared/Layout";
import ResourceCalendar from "../../../components/Calendars/ResourceCalendar";
import OverviewCalendar from "../../../components/Calendars/OverviewCalendar";

export default function Overview() {
    const { events, resources, resourceList } = usePage();
    const [selectedResource, setSelectedResource] = React.useState("overview");
    const [filteredEvents, setFilteredEvents] = React.useState();

    let pEvents = events.map(event => {
        return {
            id: event.id,
            title: event.title,
            start: moment(event.start).toDate(),
            end: moment(event.end).toDate(),
            resourceId: event.resourceId
        };
    });
    const [parsedEvents, setParsedEvents] = React.useState(pEvents);

    React.useEffect(() => {
        resourceList.unshift({
            value: "overview",
            key: "overview",
            text: "Overview"
        });
    }, [resourceList]);

    React.useEffect(() => {
        setFilteredEvents(
            parsedEvents.filter(event => {
                return event.resourceId === selectedResource;
            })
        );
    }, [selectedResource]);

    return (
        <Layout>
            {resources.length > 0 ? (
                <>
                    <Form>
                        <Form.Select
                            onChange={(e, { value }) => {
                                setSelectedResource(value);
                            }}
                            options={resourceList}
                            value={selectedResource}
                        />
                    </Form>

                    {selectedResource !== "overview" ? (
                        <ResourceCalendar
                            events={filteredEvents}
                            resourceId={selectedResource}
                        />
                    ) : (
                        <OverviewCalendar
                            events={parsedEvents}
                            resources={resources}
                        />
                    )}
                </>
            ) : (
                <p>No Resources available</p>
            )}
        </Layout>
    );
}
