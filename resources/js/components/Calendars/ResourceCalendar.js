import React from "react";
import BigCalendar from "react-big-calendar";
import moment from "moment";
const localizer = BigCalendar.momentLocalizer(moment);
moment.locale("en-GB");

export default function ResourceCalendar(props) {
    return (
        <BigCalendar
            events={props.events}
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
