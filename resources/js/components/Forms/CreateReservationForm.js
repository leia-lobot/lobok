import React from "react";
import Inertia from "@inertiajs/inertia-react";
import { usePage } from "@inertiajs/inertia-react";
import { Form, Button, Segment } from "semantic-ui-react";

import useFormValidation from "../../Shared/hooks/useFormValidation";
import validateReservation from "../../Shared/validation/validateReservation";

const INITIAL_STATE = {
    company: "",
    resource: "",
    start: "",
    end: "",
    request_help: false,
    preliminary: false
};

export default function CreateReservationForm() {
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
        <>
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
                        placeholder="Choose a company"
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
                        placeholder="Choose a resource"
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
        </>
    );
}
