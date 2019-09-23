import React from "react";
import { usePage } from "@inertiajs/inertia-react";
import { Inertia } from "@inertiajs/inertia";

import {
    Form,
    Button,
    Message,
    Grid,
    Segment,
    Header
} from "semantic-ui-react";

import useFormValidation from "../../Shared/hooks/useFormValidation";
import validateAuth from "../../Shared/validation/validateLogin";
import Layout from "../../Shared/Layout";

const INITIAL_STATE = {
    email: "",
    password: ""
};

function Login() {
    function loginUser() {
        // Make a POST visit
        Inertia.post("/login", values)
            .then(data => {})
            .catch(err => {});
    }

    const {
        handleChange,
        handleSubmit,
        handleBlur,
        values,
        formErrors,
        isSubmitting
    } = useFormValidation(INITIAL_STATE, validateAuth, loginUser);

    const { errors } = usePage();

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
                    <Form size="large" onSubmit={handleSubmit}>
                        <Segment stacked>
                            <Form.Input
                                fluid
                                icon="user"
                                iconPosition="left"
                                onChange={handleChange}
                                onBlur={handleBlur}
                                name="email"
                                value={values.email}
                                error={formErrors.email}
                                autoComplete="off"
                                placeholder="Your email address"
                            />
                            <Form.Input
                                fluid
                                icon="lock"
                                iconPosition="left"
                                onChange={handleChange}
                                onBlur={handleBlur}
                                name="password"
                                type="password"
                                value={values.password}
                                error={formErrors.password}
                                placeholder="Choose a safe password"
                            />
                            <Button disabled={isSubmitting} type="submit">
                                Submit
                            </Button>
                        </Segment>
                    </Form>
                    {errors.email && <Message error>{errors.email}</Message>}
                </Grid.Column>
            </Grid>
        </Layout>
    );
}

export default Login;
