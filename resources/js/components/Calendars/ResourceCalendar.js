import React, { useState } from "react";
import BigCalendar from "react-big-calendar";
import moment from "moment";
import { Button, Header, Segment, Portal } from "semantic-ui-react";
import CreateReservationForm from "../Forms/CreateReservationForm";
import { usePage } from "@inertiajs/inertia-react";

const localizer = BigCalendar.momentLocalizer(moment);
moment.locale("en-GB");

export default function ResourceCalendar(props) {
    const [events, setEvents] = useState(props.events);
    const [isOpen, setIsOpen] = useState(false);
    const [newReservation, setNewReservation] = useState({
        company: "",
        resource: "",
        start: "",
        end: "",
        request_help: false,
        preliminary: false
    });
    const { resource, companies } = usePage();

    React.useEffect(() => {
        setIsOpen(false);
    }, []);

    const handleSelect = ({ start, end }) => {
        /* TODO: Attempt to save reservation */

        setNewReservation({
            ...newReservation,
            resource: resource.id,
            company: companies[0].value,
            start: moment(start),
            end: moment(end)
        });

        setIsOpen(true);
    };

    const handleClose = () => {
        setIsOpen(false);
    };

    return (
        <>
            <Portal
                onClose={handleClose}
                open={isOpen}
                closeOnDocumentClick={false}
            >
                <Segment
                    style={{
                        left: "20%",
                        position: "fixed",
                        top: "20%",
                        zIndex: 1000
                    }}
                >
                    <Header>Make a new reservation</Header>
                    <CreateReservationForm reservation={newReservation} />

                    <Button
                        content="Close Portal"
                        negative
                        onClick={handleClose}
                    />
                </Segment>
            </Portal>
            <BigCalendar
                selectable
                events={events}
                localizer={localizer}
                defaultView={BigCalendar.Views.DAY}
                views={{
                    week: true,
                    day: true
                }}
                defaultView="week"
                step={15}
                timeslots={2}
                defaultDate={new Date()}
                startAccessor="start"
                endAccessor="end"
                onSelectEvent={event => alert(event.title)}
                onSelectSlot={handleSelect}
            />
        </>
    );
}
