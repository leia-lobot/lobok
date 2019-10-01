import React from "react";

import { Grid, Header } from "semantic-ui-react";

import Layout from "../../Shared/Layout";
import RegisterForm from "../../components/Forms/RegisterForm";

function Login() {
    return (
        <Layout>
            <Grid
                textAlign="center"
                style={{ height: "100vh" }}
                verticalAlign="middle"
            >
                <Grid.Column style={{ maxWidth: 450 }}>
                    <Header as="h2" color="teal" textAlign="center">
                        Register a new account
                    </Header>
                    <RegisterForm />
                </Grid.Column>
            </Grid>
        </Layout>
    );
}

export default Login;
