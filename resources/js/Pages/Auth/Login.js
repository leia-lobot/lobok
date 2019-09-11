import React from "react";

import Inertia from "@inertiajs/inertia-react";

import { Form, Button } from "semantic-ui-react";

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
        Inertia.post("/login", values, {
            replace: false,
            preserveState: true,
            preserveScroll: false
        });
    }

    const {
        handleChange,
        handleSubmit,
        handleBlur,
        values,
        errors,
        isSubmitting
    } = useFormValidation(INITIAL_STATE, validateAuth, loginUser);

    const [serverError, setServerError] = React.useState({});

    return (
        <Layout>
            <div className="container">
                <h1>Login Here</h1>
                <Form onSubmit={handleSubmit}>
                    <Form.Group widths="equal">
                        <Form.Input
                            onChange={handleChange}
                            onBlur={handleBlur}
                            name="email"
                            value={values.email}
                            error={errors.email}
                            autoComplete="off"
                            placeholder="Your email address"
                        />
                        <Form.Input
                            onChange={handleChange}
                            onBlur={handleBlur}
                            name="password"
                            type="password"
                            value={values.password}
                            error={errors.password}
                            placeholder="Choose a safe password"
                        />
                    </Form.Group>
                    <div>
                        <Button disabled={isSubmitting} type="submit">
                            Submit
                        </Button>
                    </div>
                </Form>
            </div>
        </Layout>
    );
}

export default Login;
