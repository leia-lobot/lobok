import React from "react";
import moment from "moment";
import { Table } from "semantic-ui-react";

import ActionToolbar from "../ActionToolbar";
import CreateReservationForm from "../Forms/CreateReservationForm";

export default function ReservationTable(props) {
    const [reservations] = React.useState(props.reservations);

    return (
        <Table celled>
            <Table.Header>
                <Table.Row>
                    <Table.HeaderCell>#</Table.HeaderCell>
                    <Table.HeaderCell>Date</Table.HeaderCell>
                    <Table.HeaderCell>Time</Table.HeaderCell>
                    <Table.HeaderCell>Created</Table.HeaderCell>
                    <Table.HeaderCell>Resource</Table.HeaderCell>
                    <Table.HeaderCell>Company</Table.HeaderCell>
                    <Table.HeaderCell>Status</Table.HeaderCell>
                    <Table.HeaderCell>Requested Help</Table.HeaderCell>
                    <Table.HeaderCell>Information</Table.HeaderCell>
                    <Table.HeaderCell>Action</Table.HeaderCell>
                </Table.Row>
            </Table.Header>
            <Table.Body>
                {reservations &&
                    reservations.map(reservation => (
                        <Table.Row key={reservation.id}>
                            <Table.Cell>{reservation.id}</Table.Cell>
                            <Table.Cell>
                                {moment(reservation.start).format("DD-MM-YY")}
                            </Table.Cell>
                            <Table.Cell>
                                {moment(reservation.start).format("HH:mm")}
                                {" - "}
                                {moment(reservation.end).format("HH:mm")}
                            </Table.Cell>
                            <Table.Cell>
                                {moment(reservation.created_at).format(
                                    "DD-MM-YY HH:mm"
                                )}
                            </Table.Cell>
                            <Table.Cell>{reservation.resource_id}</Table.Cell>
                            <Table.Cell>{reservation.company_id}</Table.Cell>
                            <Table.Cell>{reservation.state}</Table.Cell>
                            <Table.Cell>{reservation.request_help}</Table.Cell>
                            <Table.Cell>{reservation.information}</Table.Cell>
                            <Table.Cell>
                                <ActionToolbar
                                    target={reservation}
                                    edit={
                                        <CreateReservationForm
                                            reservation={reservation}
                                        />
                                    }
                                />
                            </Table.Cell>
                        </Table.Row>
                    ))}
            </Table.Body>
        </Table>
    );
}
