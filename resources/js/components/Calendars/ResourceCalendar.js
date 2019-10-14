import React, { useState } from "react";
import BigCalendar from "react-big-calendar";
import moment from "moment";
import { Button, Grid, Header, Segment, Portal } from "semantic-ui-react";
import CreateReservationForm from "../Forms/CreateReservationForm";

const localizer = BigCalendar.momentLocalizer(moment);
moment.locale("en-GB");

export default function ResourceCalendar(props) {
    const [events, setEvents] = useState(props.events);
    const [isOpen, setIsOpen] = useState(false);
    const [newReservation, setNewReservation] = useState({});

    const handleSelect = ({ start, end }) => {
        /* TODO: Attept to save reservation */
        /*
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
        }*/

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
                    <Header>Portal here!</Header>
                    <CreateReservationForm />

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
