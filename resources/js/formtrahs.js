   attendants: 5,
    start_time: new Date().toISOString(),
    end_time: new Date().toISOString(),
    extras: []


<Form.Select
                        options={resources}
                        onChange={handleChange}
                        onBlur={handleBlur}
                        name="resource"
                        value={values.resource}
                        error={errors.resource}
                        placeholder="Resource"
                    />


 <form action="/reservations" method="post">
                    <div className="flex flex-wrap -mx-3 mb-3">

                </div>
                <div className="flex-1 ml-3 mb-3 w1/2">

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
