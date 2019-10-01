import React from "react";
import { usePage } from "@inertiajs/inertia-react";
import { Inertia } from "@inertiajs/inertia";

import { Form, Button, Segment, Message } from "semantic-ui-react";

import useFormValidation from "../../Shared/hooks/useFormValidation";
import validateRegister from "../../Shared/validation/validateRegister";

const INITIAL_STATE = {
    name: "",
    email: "",
    password: "",
    password_confirmation: ""
};

export default function LoginForm() {
    function registerUser() {
        // Make a POST visit
        Inertia.post("/register", values);
    }

    const {
        handleChange,
        handleSubmit,
        handleBlur,
        values,
        formErrors,
        isSubmitting
    } = useFormValidation(INITIAL_STATE, validateRegister, registerUser);

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
                        name="name"
                        value={values.name}
                        error={formErrors.name}
                        autoComplete="off"
                        placeholder="Your name"
                    />
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
                    <Form.Input
                        fluid
                        icon="lock"
                        iconPosition="left"
                        onChange={handleChange}
                        onBlur={handleBlur}
                        name="password_confirmation"
                        type="password"
                        value={values.password_confirmation}
                        error={formErrors.password_confirmation}
                        placeholder="Repeat password"
                    />
                    <Button disabled={isSubmitting} type="submit">
                        Submit
                    </Button>
                </Segment>
            </Form>
            {errors.name && <Message error>{errors.name}</Message>}
            {errors.email && <Message error>{errors.email}</Message>}
            {errors.password && <Message error>{errors.password}</Message>}
        </>
    );
}
