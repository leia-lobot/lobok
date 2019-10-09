import React from "react";
import { usePage } from "@inertiajs/inertia-react";
import { Inertia } from "@inertiajs/inertia";
import { Form, Button, Segment, Message } from "semantic-ui-react";
import { DateTimeInput } from "semantic-ui-calendar-react";

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

export default function CreateReservationForm(props) {
    function makeReservation() {
        // Make a POST visit
        Inertia.post("/reservations", values);
    }

    const {
        handleChange,
        handleChanges,
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
                        label="Company"
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
                        error={formErrors.company}
                    />
                    <Form.Select
                        label="Resource"
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
                        error={formErrors.resource}
                    />
                </Form.Group>

                <Form.Group widths="equal">
                    <DateTimeInput
                        name="start"
                        label="Start"
                        placeholder="Start"
                        value={values.start}
                        onChange={(e, { value }) =>
                            handleSelectChange("start", value)
                        }
                        clearable={true}
                        // error={formErrors.start}
                    />
                    <DateTimeInput
                        name="end"
                        label="End"
                        placeholder="End"
                        value={values.end}
                        onChange={(e, { value }) =>
                            handleSelectChange("end", value)
                        }
                        clearable={true}
                        // error={formErrors.end}
                    />
                </Form.Group>

                <Form.Group widths="equal">
                    <Form.Checkbox
                        label="Preliminary"
                        name="preliminary"
                        checked={values.preliminary}
                        onChange={(e, { checked }) =>
                            handleSelectChange("preliminary", !!checked)
                        }
                    />
                    <Form.Checkbox
                        label="Extra Service"
                        name="request_help"
                        checked={values.request_help}
                        onChange={(e, { checked }) =>
                            handleSelectChange("request_help", !!checked)
                        }
                    />
                </Form.Group>

                <Button disabled={isSubmitting} type="submit">
                    Submit
                </Button>
            </Form>

            {Object.keys(errors).length !== 0 &&
                Object.keys(errors).map(error => {
                    <Segment>
                        <Message error>{error}</Message>
                    </Segment>;
                })}
            <Segment>{JSON.stringify(values)}</Segment>
            <Segment>{JSON.stringify(errors)}</Segment>
        </>
    );
}
