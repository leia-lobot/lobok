import React from "react";

import Inertia from "@inertiajs/inertia-react";
import { usePage } from "@inertiajs/inertia-react";
import { Form, Button, Segment, Grid, Header } from "semantic-ui-react";

import Layout from "../../Shared/Layout";
import useFormValidation from "../../Shared/hooks/useFormValidation";
import validateReservation from "../../Shared/validation/validateReservation";

const INITIAL_STATE = {
    title: "",
    description: "",
    company: "",
    resource: ""
};

export default function CreateReservation() {
    function makeReservation() {
        // Make a POST visit
        Inertia.post("/reservation/create", values);
    }

    const {
        handleChange,
        handleSubmit,
        handleBlur,
        handleSelectChange,
        values,
        formErrors,
        isSubmitting
    } = useFormValidation(INITIAL_STATE, validateReservation, makeReservation);

    const { errors } = usePage();
    const { companies, resources } = usePage();

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
                    <Form onSubmit={handleSubmit}>
                        <Form.Group widths="equal">
                            <Form.Select
                                onChange={(e, { value }) =>
                                    handleSelectChange("company", value)
                                }
                                onBlur={(e, { value }) =>
                                    handleSelectChange("company", value)
                                }
                                options={companies}
                                placeholder="Choose an option"
                                selection
                                value={values.company}
                            />
                            <Form.Select
                                onChange={(e, { value }) =>
                                    handleSelectChange("resource", value)
                                }
                                onBlur={(e, { value }) =>
                                    handleSelectChange("resource", value)
                                }
                                options={resources}
                                placeholder="Choose an option"
                                selection
                                value={values.resource}
                            />
                        </Form.Group>
                        <Button disabled={isSubmitting} type="submit">
                            Submit
                        </Button>
                    </Form>

                    {errors.email && (
                        <Segment>
                            <Message error>{errors.email}</Message>
                        </Segment>
                    )}

                    <Segment>{JSON.stringify(values)}</Segment>
                </Grid.Column>
            </Grid>
        </Layout>
    );
}
