import React from "react";
import { Container } from "semantic-ui-react";

import Menubar from "../components/Menubar";

export default function Dashboard({ children }) {
    return (
        <Container>
            <Menubar />
            {children}
        </Container>
    );
}
