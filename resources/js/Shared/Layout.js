import React from "react";
import { Container } from "semantic-ui-react";

import Menubar from "../components/Menubar";
import FlashMessage from "../components/FlashMessage";

export default function Dashboard({ children }) {
    return (
        <Container>
            <FlashMessage />
            <Menubar />
            {children}
        </Container>
    );
}
