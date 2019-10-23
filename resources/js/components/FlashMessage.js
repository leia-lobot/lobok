import React from "react";
import { Message } from "semantic-ui-react";
import { usePage } from "@inertiajs/inertia-react";

export default function FlashMessage() {
    const { flash } = usePage();
    const [isVisible, setIsVisible] = React.useState(true);

    function handleDismiss() {
        setIsVisible(false);
    }

    return (
        <>
            {flash.success && isVisible && (
                <Message
                    onDismiss={handleDismiss}
                    success
                    attached="top"
                    color="green"
                    content={flash.success}
                    header={"Reservation sent!"}
                />
            )}
        </>
    );
}
