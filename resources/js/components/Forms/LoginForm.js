import React from "react";
import { usePage } from "@inertiajs/inertia-react";
import { Inertia } from "@inertiajs/inertia";

import { Form, Button, Segment, Message } from "semantic-ui-react";

import useFormValidation from "../../Shared/hooks/useFormValidation";
import validateAuth from "../../Shared/validation/validateLogin";

const INITIAL_STATE = {
    email: "",
    password: ""
};

export default function LoginForm() {
    function loginUser() {
        // Make a POST visit
        Inertia.post("/login", values);
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
        <>
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
        </>
    );
}
