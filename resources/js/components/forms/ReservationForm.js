import React, { useState } from 'react'
import { usePage } from '@inertiajs/inertia-react';

// MUI
import { TextField } from '@material-ui/core';


export function ReservationForm()  {
    
        const { companies, resources } = usePage();

        const [state, setState] = useState({
            title: '',
            description: '',
            company: null,
            resource: null,
            attendants: 0,
            start_time: null,
            end_time: null,
            extras: [],
            errors: {}
        });

        const handleChange = event => {
            this.setState({
                [event.target.name]: event.target.value
              });
        }


        return (
            <form action="/reservations" method="post">
            <div className="flex flex-wrap -mx-3 mb-3">
                <TextField id="title" name="title" type="text" label="Title" helperText={state.errors.title} error={state.errors.title ? true : false} className={''/*classes.textField*/} fullWidth value={state.title} onChange={handleChange} />
                
                <TextField id="description" name="description" type="text" label="Description" multiline rows="8" helperText={state.errors.description} error={state.errors.description ? true : false} className={''/*classes.textField*/} fullWidth value={state.description} onChange={handleChange} />

                <label className="block tracking-wide text-gray-200 text-xs font-bold mb-2" htmlFor="grid-company">
                    {'Företag'}
                </label>
                <select 
                    className="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
                    id="grid-company" name="company"
                >
                    {companies.map(company => {
                        <option value={company.id}>{ company.name }</option>
                    })}
                </select>
            </div>

            <div className="flex flex-wrap -mx-3 mb-3">
                <label className="block tracking-wide text-gray-200 text-xs font-bold mb-2" htmlFor="grid-resource">
                    {'Resurs'}
                </label>
                <select 
                    className="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
                    id="grid-resource" name="resource" type="text" placeholder="Leia Företagshotell"
                >
                    {resources.map(resource => {
                        <option value={resource.id}>{ resource.name }</option>
                    })}
                </select>
            </div>

            <div className="flex flex-wrap -mx-3 mb-2">
                <div className="w-full md:w-1/2 md:pr-3 mb-6 md:mb-0">
                    <label className="block tracking-wide text-gray-200 text-xs font-bold mb-2" htmlFor="grid-date">
                        {'Datum'}
                    </label>
                    <input 
                        className="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                        id="grid-date" name="date" type="date" value={ new Date().toISOString()} />
                </div>
                <div className="w-full md:w-1/2 md:pl-3 mb-3 md:mb-0">
                    <label className="block tracking-wide text-gray-200 text-xs font-bold mb-2" htmlFor="grid-attendants">
                        {'Deltagare'}
                    </label>
                    <input 
                    className="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
                    id="grid-attendants" name="attendants" type="number" placeholder="10" />
                </div>
            </div>
            <div className="flex flex-wrap -mx-3 mb-2">
                <div className="w-full md:w-1/2 md:pr-3 mb-6 md:mb-0">
                <label className="block tracking-wide text-gray-200 text-xs font-bold mb-2" htmlFor="grid-start-time">
                    {'Från'}
                </label>
                <input 
                    className="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                    id="grid-start-time" name="start-time" type="time" value={new Date().toLocaleTimeString()} />
                </div> 
                <div className="w-full md:w-1/2 md:pl-3 mb-3 md:mb-0">
                <label className="block tracking-wide text-gray-200 text-xs font-bold mb-2" htmlFor="grid-end-time">
                    {'Till'}
                </label>
                <input 
                    className="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                    id="grid-end-time" name="end-time" type="time" value={new Date().toLocaleTimeString()} />
                </div> 
            </div>

            
            <div className="flex flex-wrap -mx-3 mb-2">
                <div className="w-full mb-6 md:mb-0">
                    <label className="block tracking-wide text-gray-200 text-xs font-bold mb-2" htmlFor="extras">
                    {'Tillval'}
                    </label>
                    <input 
                    className="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
                    id="grid-extras" name="extras" type="textarea" rows="5" placeholder="Tillval" /> 
                </div>
            </div>

            <div className="flex flex-wrap -mx-3 mb-2">
                <div className="w-1/2 md:pr-3 mb-6 md:mb-0">
                <button type="submit" className="text-white rounded bg-red-700 px-5 py-2 shadow-2xl hover:bg-red-800 mr-10">Boka</button>
                </div>
                <div className="w-1/2 md:pl-3 mb-6 md:mb-0">
                <button type="button" className="text-white rounded bg-red-700 px-5 py-2 shadow-2xl hover:bg-red-800 mr-10">Avbryt</button>
                </div>
                
            </div>
        </form>
        )
    }


export default ReservationForm
