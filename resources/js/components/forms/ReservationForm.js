import React, { useState } from "react";
import { usePage } from "@inertiajs/inertia-react";

// MUI
import {
    TextField,
    Select,
    MenuItem,
    InputLabel,
    FormHelperText,
    FormControl
} from "@material-ui/core";

export function ReservationForm() {
    const { companies, resources } = usePage();

    const [state, setState] = useState({
        title: "",
        description: "",
        company: "",
        resource: "",
        attendants: 5,
        start_time: new Date().toISOString(),
        end_time: new Date().toISOString(),
        extras: [],
        errors: {}
    });

    const handleChange = name => event => {
        setState({
            ...state,
            [name]: event.target.value
        });
    };

    return (
        <form action="/reservations" method="post">
            <div className="flex flex-wrap -mx-3 mb-3">
                <TextField
                    id="title"
                    name="title"
                    type="text"
                    label="Title"
                    helperText={state.errors.title}
                    error={state.errors.title ? true : false}
                    className={""}
                    fullWidth
                    value={state.title}
                    onChange={handleChange}
                />

                <TextField
                    id="description"
                    name="description"
                    type="text"
                    label="Description"
                    multiline
                    rows="8"
                    helperText={state.errors.description}
                    error={state.errors.description ? true : false}
                    className={"" /*classes.textField*/}
                    fullWidth
                    value={state.description}
                    onChange={handleChange}
                />
            </div>
            <div className="flex flex-wrap -mx-3 mb-3">
                <div className="flex-1 mr-3 mb-3 w1/2">
                    <FormControl style={{ width: "100%" }}>
                        <InputLabel htmlFor="company">Company</InputLabel>
                        <Select
                            value={state.company}
                            onChange={handleChange}
                            label="Company"
                            fullWidth
                            error={state.errors.company ? true : false}
                            inputProps={{
                                name: "company",
                                id: "company"
                            }}
                        >
                            <MenuItem value="">None</MenuItem>
                            {companies.map(company => {
                                <MenuItem value={company.id}>
                                    {company.name}
                                </MenuItem>;
                            })}
                        </Select>
                        <FormHelperText>{state.errors.company}</FormHelperText>
                    </FormControl>
                </div>
                <div className="flex-1 ml-3 mb-3 w1/2">
                    <FormControl style={{ width: "100%" }}>
                        <InputLabel htmlFor="resource">Resource</InputLabel>
                        <Select
                            value={state.resource}
                            onChange={handleChange}
                            className={"w1/2"}
                            fullWidth
                            error={state.errors.resource ? true : false}
                            inputProps={{
                                name: "resource",
                                id: "resource"
                            }}
                        >
                            <MenuItem value="">None</MenuItem>
                            {resources.map(resource => {
                                <MenuItem value={resource.id}>
                                    {resource.name}
                                </MenuItem>;
                            })}
                        </Select>
                    </FormControl>
                </div>
            </div>

            <div className="flex flex-wrap -mx-3 mb-2">
                <div className="w-full md:w-1/2 md:pr-3 mb-6 md:mb-0">
                    <TextField
                        id="start_time"
                        label="Start Time"
                        type="datetime-local"
                        defaultValue={state.start_time}
                        className={""}
                        helperText={state.errors.start_time}
                        error={state.errors.start_time ? true : false}
                        InputLabelProps={{
                            shrink: true
                        }}
                    />
                    <TextField
                        id="end_time"
                        label="End Time"
                        type="datetime-local"
                        defaultValue={state.end_time}
                        className={""}
                        helperText={state.errors.end_time}
                        error={state.errors.end_time ? true : false}
                        InputLabelProps={{
                            shrink: true
                        }}
                    />
                    <TextField
                        id="attendants"
                        label="Attendants"
                        type="number"
                        defaultValue={state.attendants}
                        className={""}
                        helperText={state.errors.attendants}
                        error={state.errors.attendants ? true : false}
                        InputLabelProps={{
                            shrink: true
                        }}
                    />
                    <TextField
                        id="extras"
                        name="extras"
                        type="text"
                        label="Extras"
                        helperText={state.errors.extras}
                        error={state.errors.extras ? true : false}
                        className={""}
                        fullWidth
                        value={state.extras}
                        onChange={handleChange}
                    />
                </div>
            </div>

            <div className="flex flex-wrap -mx-3 mb-2">
                <div className="w-1/2 md:pr-3 mb-6 md:mb-0">
                    <button
                        type="submit"
                        className="text-white rounded bg-red-700 px-5 py-2 shadow-2xl hover:bg-red-800 mr-10"
                    >
                        Boka
                    </button>
                </div>
                <div className="w-1/2 md:pl-3 mb-6 md:mb-0">
                    <button
                        type="button"
                        className="text-white rounded bg-red-700 px-5 py-2 shadow-2xl hover:bg-red-800 mr-10"
                    >
                        Avbryt
                    </button>
                </div>
            </div>
        </form>
    );
}

export default ReservationForm;
