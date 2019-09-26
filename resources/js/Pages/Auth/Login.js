import React from "react";

import { Grid, Header } from "semantic-ui-react";

import Layout from "../../Shared/Layout";
import LoginForm from "../../components/Forms/LoginForm";

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
                        Log-in to your account
                    </Header>
                    <LoginForm />
                </Grid.Column>
            </Grid>
        </Layout>
    );
}

export default Login;
