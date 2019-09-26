import React from "react";
import { Grid, Header } from "semantic-ui-react";

import Layout from "../../Shared/Layout";
import CreateReservationForm from "../../components/Forms/CreateReservationForm";

export default function CreateReservation() {
    return (
        <Layout>
            <Grid
                textAlign="center"
                style={{ height: "100vh" }}
                verticalAlign="middle"
            >
                <Grid.Column style={{ maxWidth: 450 }}>
                    <Header as="h2" color="teal" textAlign="center">
                        Make reservation
                    </Header>
                    <CreateReservationForm />
                </Grid.Column>
            </Grid>
        </Layout>
    );
}
