import React from "react";
import moment from "moment";
import { Table, Icon, Popup } from "semantic-ui-react";

/*
     "id" => 4
        "start" => "2019-10-04 06:00:00"
        "end" => "2019-10-04 06:55:00"
        "state" => "STATE_PENDING"
        "request_help" => 0
        "preliminary" => 0
        "information" => null
        "created_at" => "2019-10-04 09:36:33"
        "updated_at" => "2019-10-04 09:36:33"
        "resource_id" => 2
        "company_id" => 1
        "user_id" => 4

        trash
        edit
*/

export default function ReservationTable(props) {
    const [reservations, setReservations] = React.useState(props.reservations);

    return (
        <Table celled>
            <Table.Header>
                <Table.Row>
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
                                <Popup
                                    content="View"
                                    trigger={
                                        <Icon
                                            link
                                            name="expand arrows alternate"
                                        />
                                    }
                                />
                                <Popup
                                    content="Edit"
                                    trigger={<Icon link name="edit" />}
                                />
                                <Popup
                                    content="Delete"
                                    trigger={<Icon link name="times" />}
                                />
                            </Table.Cell>
                        </Table.Row>
                    ))}
            </Table.Body>
        </Table>
    );
}
