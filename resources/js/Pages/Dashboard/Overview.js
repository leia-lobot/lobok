import React from "react";
import { usePage } from "@inertiajs/inertia-react";
import { Form, Button, Segment, Message } from "semantic-ui-react";

import Layout from "../../Shared/Layout";
import ResourceCalendar from "../../components/Calendars/ResourceCalendar";
import OverviewCalendar from "../../components/Calendars/OverviewCalendar";

export default function Overview() {
    const { events, resources, resourceList } = usePage();
    const [selectedResource, setSelectedResource] = React.useState();
    const [filteredEvents, setFilteredEvents] = React.useState();

    React.useEffect(() => {
        setFilteredEvents(
            events.filter(event => {
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

                    {selectedResource ? (
                        <ResourceCalendar events={filteredEvents} />
                    ) : (
                        <OverviewCalendar
                            events={events}
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
