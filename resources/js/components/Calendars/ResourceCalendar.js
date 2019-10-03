import React from "react";
import BigCalendar from "react-big-calendar";
import moment from "moment";

const localizer = BigCalendar.momentLocalizer(moment);
moment.locale("en-GB");

export default function ResourceCalendar(props) {
    const [events, setEvents] = React.useState(props.events);
    const [newReservation, setNewReservation] = React.useState({});

    const handleSelect = ({ start, end }) => {
        /* TODO: Attept to save reservation */
        const title = window.prompt("New Event name");
        if (title) {
            setEvents([
                ...events,
                {
                    start,
                    end,
                    title
                }
            ]);
        }
    };
    return (
        <BigCalendar
            selectable
            events={events}
            localizer={localizer}
            defaultView={BigCalendar.Views.DAY}
            views={["day", "work_week"]}
            step={15}
            timeslots={2}
            defaultDate={new Date()}
            startAccessor="start"
            endAccessor="end"
            onSelectEvent={event => alert(event.title)}
            onSelectSlot={handleSelect}
        />
    );
}
