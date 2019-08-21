import React from 'react';
import { usePage } from '@inertiajs/inertia-react';
import BigCalendar from 'react-big-calendar'
import moment from 'moment'



import Layout from '../../Shared/Layout';

export default function() {
    const { events, resources } = usePage();
    const localizer = BigCalendar.momentLocalizer(moment)
    moment.locale('en-GB')

    let parsedEvents = events.map( event => {
        return {
            id: event.id,
            title: event.title,
            start: moment(event.start).toDate(),
            end: moment(event.end).toDate(),
            resourceId: event.resourceId
        }
    })

    console.log({parsedEvents});
    
    
    return (
        <Layout>
            <BigCalendar
                events={parsedEvents}
                min={new Date(2017, 10, 0, 6, 0, 0)}
                max={new Date(2017, 10, 0, 22, 0, 0)} 
                localizer={localizer}
                defaultView={BigCalendar.Views.DAY}
                views={['day', 'work_week']}
                step={30}
                timeslots={2}
                defaultDate={new Date()}
                resources={resources}
                resourceIdAccessor="resourceId"
                resourceTitleAccessor="resourceTitle"
            />
        </Layout>
    )
}