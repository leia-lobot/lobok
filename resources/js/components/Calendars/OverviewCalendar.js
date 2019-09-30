import React from "react";
import BigCalendar from "react-big-calendar";
import moment from "moment";

const localizer = BigCalendar.momentLocalizer(moment);
moment.locale("en-GB");

export default function OverviewCalendar(props) {
    const [events, setEvents] = React.useState(props.events);
    const [resources, setResources] = React.useState(props.resources);

    return (
        <BigCalendar
            events={events}
            localizer={localizer}
            defaultView={BigCalendar.Views.DAY}
            views={["day", "work_week"]}
            step={30}
            timeslots={2}
            defaultDate={new Date()}
            resources={resources}
            resourceIdAccessor="resourceId"
            resourceTitleAccessor="resourceTitle"
        />
    );
}
