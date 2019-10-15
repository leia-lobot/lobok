import React, { useState } from "react";
import { usePage } from "@inertiajs/inertia-react";
import { Inertia } from "@inertiajs/inertia";
import moment from "moment";

import { Form, Button, Segment, Message } from "semantic-ui-react";
import DatetimePicker from "react-semantic-datetime";

import useFormValidation from "../../Shared/hooks/useFormValidation";
import validateReservation from "../../Shared/validation/validateReservation";

moment.locale("en-GB");

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
    } = useFormValidation(
        props.reservation,
        validateReservation,
        makeReservation
    );

    const { errors, companies, resources, flash } = usePage();
    const [timeDateDialogs, setTimeDateDialogs] = useState({
        start: false,
        end: false
    });

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
                    <Form.Input
                        name="start"
                        label="Start"
                        placeholder="Start"
                        value={moment(values.start).format("LLL")}
                        onClick={() =>
                            setTimeDateDialogs({
                                ...timeDateDialogs,
                                start: true
                            })
                        }
                        disabled={timeDateDialogs.start}

                        // error={formErrors.start}
                    />
                    <Form.Input
                        name="end"
                        label="End"
                        placeholder="End"
                        value={moment(values.end).format("LLL")}
                        onClick={() =>
                            setTimeDateDialogs({
                                ...timeDateDialogs,
                                end: true
                            })
                        }
                        disabled={timeDateDialogs.start}

                        // error={formErrors.start}
                    />
                </Form.Group>
                {timeDateDialogs.start && (
                    <DatetimePicker
                        onChange={value => {
                            handleSelectChange("start", value);
                            setTimeDateDialogs({
                                ...timeDateDialogs,
                                start: false
                            });
                        }}
                        moment={values.start}
                        time={true}
                    />
                )}
                {timeDateDialogs.end && (
                    <DatetimePicker
                        onChange={value => {
                            handleSelectChange("end", value);
                            setTimeDateDialogs({
                                ...timeDateDialogs,
                                end: false
                            });
                        }}
                        moment={values.end}
                        time={true}
                    />
                )}

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
            {flash.success && (
                <Message
                    success
                    attached="top"
                    color="green"
                    content={flash.success}
                    header={"Reservation sent!"}
                />
            )}
            <Segment>{JSON.stringify(flash)}</Segment>
        </>
    );
}
