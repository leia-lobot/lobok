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

const initialFormState = {
    title: "",
    description: "",
    company: "",
    resource: "",
    attendants: 5,
    start_time: new Date().toISOString(),
    end_time: new Date().toISOString(),
    extras: [],
    errors: {}
};

export function ReservationForm() {
    const { companies, resources } = usePage();

    const [form, setForm] = useState(initialFormState);

    const handleChange = event => {
        setForm({
            ...form,
            [event.target.name]: event.target.value
        });
    };

    let items = [];
    companies.forEach(company => {
        items.push({ value: company.id, name: company.name });
    });

    console.log(items);

    return (
        <form action="/reservations" method="post">
            <div className="flex flex-wrap -mx-3 mb-3">
                <TextField
                    id="title"
                    name="title"
                    type="text"
                    label="Title"
                    helperText={form.errors.title}
                    error={form.errors.title ? true : false}
                    className={""}
                    fullWidth
                    value={form.title}
                    onChange={handleChange}
                />

                <TextField
                    id="description"
                    name="description"
                    type="text"
                    label="Description"
                    multiline
                    rows="8"
                    helperText={form.errors.description}
                    error={form.errors.description ? true : false}
                    className={"" /*classes.textField*/}
                    fullWidth
                    value={form.description}
                    onChange={handleChange}
                />
            </div>
            <div className="flex flex-wrap -mx-3 mb-3">
                <div className="flex-1 mr-3 mb-3 w1/2">
                    <FormControl style={{ width: "100%" }}>
                        <InputLabel htmlFor="company">Company</InputLabel>
                        <Select
                            value={form.company}
                            onChange={handleChange}
                            className={"w1/2"}
                            fullWidth
                            error={form.errors.company ? true : false}
                        >
                            <MenuItem value="">None</MenuItem>
                            {companies &&
                                companies.map(item => {
                                    console.log(item);
                                    return (
                                        <MenuItem
                                            component="option"
                                            key={item.value}
                                        >
                                            {item.name}
                                        </MenuItem>
                                    );
                                })}
                        </Select>
                        <FormHelperText>{form.errors.company}</FormHelperText>
                    </FormControl>
                </div>
                <div className="flex-1 ml-3 mb-3 w1/2">
                    <FormControl style={{ width: "100%" }}>
                        <InputLabel htmlFor="resource">Resource</InputLabel>
                        <Select
                            value={form.resource}
                            onChange={handleChange}
                            className={"w1/2"}
                            fullWidth
                            error={form.errors.resource ? true : false}
                            inputProps={{
                                name: "resource",
                                id: "resource"
                            }}
                        >
                            <MenuItem value="">None</MenuItem>
                            {resources &&
                                resources.map(resource => {
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
                        defaultValue={form.start_time}
                        className={""}
                        helperText={form.errors.start_time}
                        error={form.errors.start_time ? true : false}
                        InputLabelProps={{
                            shrink: true
                        }}
                    />
                    <TextField
                        id="end_time"
                        label="End Time"
                        type="datetime-local"
                        defaultValue={form.end_time}
                        className={""}
                        helperText={form.errors.end_time}
                        error={form.errors.end_time ? true : false}
                        InputLabelProps={{
                            shrink: true
                        }}
                    />
                    <TextField
                        id="attendants"
                        label="Attendants"
                        type="number"
                        defaultValue={form.attendants}
                        className={""}
                        helperText={form.errors.attendants}
                        error={form.errors.attendants ? true : false}
                        InputLabelProps={{
                            shrink: true
                        }}
                    />
                    <TextField
                        id="extras"
                        name="extras"
                        type="text"
                        label="Extras"
                        helperText={form.errors.extras}
                        error={form.errors.extras ? true : false}
                        className={""}
                        fullWidth
                        value={form.extras}
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
