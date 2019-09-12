import React, { useState } from "react";

import Inertia from "@inertiajs/inertia-react";
import { usePage } from "@inertiajs/inertia-react";
import { Form, Button, Segment } from "semantic-ui-react";

import Layout from "../../Shared/Layout";
import useFormValidation from "../../Shared/hooks/useFormValidation";
import validateReservation from "../../Shared/validation/validateReservation";

const INITIAL_STATE = {
    title: "",
    description: "",
    company: "",
    resource: ""
};

export default function Reservation() {
    function makeReservation() {
        // Make a POST visit
        Inertia.post("/reservate", values, {
            replace: false,
            preserveState: true,
            preserveScroll: false
        });
    }

    const {
        handleChange,
        handleBlur,
        handleSelectChange,
        values,
        errors
    } = useFormValidation(INITIAL_STATE, validateReservation, makeReservation);

    const [serverError, setServerError] = React.useState({});
    const { companies, resources } = usePage();

    return (
        <Layout>
            <Form>
                <Form.Input
                    onChange={handleChange}
                    onBlur={handleBlur}
                    name="title"
                    value={values.title}
                    error={errors.title}
                    autoComplete="off"
                    placeholder="Title"
                />
                <Form.TextArea
                    name="description"
                    placeholder="Description"
                    value={values.description}
                    error={errors.description}
                    onChange={handleChange}
                    onBlur={handleBlur}
                />

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
            </Form>
            <Segment>{JSON.stringify(values)}</Segment>
        </Layout>
    );
}
