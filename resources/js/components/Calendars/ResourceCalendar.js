import React from "react";
import BigCalendar from "react-big-calendar";
import moment from "moment";
const localizer = BigCalendar.momentLocalizer(moment);
moment.locale("en-GB");

export default function ResourceCalendar(props) {
    const [events, setEvents] = React.useState(props.events);
    return (
        <BigCalendar
            events={events}
            min={new Date(2017, 10, 0, 6, 0, 0)}
            max={new Date(2017, 10, 0, 22, 0, 0)}
            localizer={localizer}
            defaultView={BigCalendar.Views.DAY}
            views={["day", "work_week"]}
            step={15}
            timeslots={2}
            defaultDate={new Date()}
            startAccessor="start"
            endAccessor="end"
            onSelectEvent={event => alert(event.title)}
        />
    );
}
