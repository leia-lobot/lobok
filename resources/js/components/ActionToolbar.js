import React from "react";
import {
    Icon,
    Confirm,
    Portal,
    Header,
    Segment,
    Button
} from "semantic-ui-react";
import { Inertia } from "@inertiajs/inertia";
import CreateReservationForm from "./Forms/CreateReservationForm";

export default function ActionToolbar(props) {
    const [confirmDelete, setConfirmDelete] = React.useState({ open: false });
    const [target] = React.useState(props.target);
    const [editIsOpen, setEditIsOpen] = React.useState(false);

    const handleConfirmDelete = () => {
        Inertia.delete(target.path);
        setConfirmDelete({ open: false });
    };

    const handleCloseEdit = () => {
        setEditIsOpen(false);
    };

    const editPopup = (
        <Portal
            onClose={handleCloseEdit}
            open={editIsOpen}
            closeOnDocumentClick={true}
        >
            <Segment
                style={{
                    left: "20%",
                    position: "fixed",
                    top: "20%",
                    zIndex: 1000
                }}
            >
                <Header>Edit reservation</Header>
                <CreateReservationForm reservation={target} />

                <Button
                    content="Close Portal"
                    negative
                    onClick={handleCloseEdit}
                />
            </Segment>
        </Portal>
    );

    return (
        <div>
            <Icon link name="expand arrows alternate" />
            <Icon link name="edit" onClick={() => setEditIsOpen(true)} />
            <Icon
                link
                name="times"
                onClick={() => setConfirmDelete({ open: true })}
            />
            <Confirm
                open={confirmDelete.open}
                onCancel={() => setConfirmDelete({ open: false })}
                onConfirm={handleConfirmDelete}
            />
            {editPopup}
        </div>
    );
}
