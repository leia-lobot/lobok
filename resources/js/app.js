
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import React, { useState, useEffect } from 'react'
import ReactDOM from 'react-dom'
import BigCalendar from 'react-big-calendar'
import moment from 'moment'
import axios from 'axios'
import 'react-big-calendar/lib/css/react-big-calendar.css'

moment.locale('en-GB')
const localizer = BigCalendar.momentLocalizer(moment)

const events = []

const resourceMap = []

function Resource (props){
  const [events, setEvents] = useState(props.events);
  const [resourceMap, setResourceMap] = useState(props.resourceMap);

  useEffect(() => {
    async function fetchData() {
      const result = await axios('http://lobok.test/calendar',)
      /*
      'id' => $reservation->id,
                'title' => $reservation->title,
                'start' => $reservation->start_time,
                'end' => $reservation->end_time,
                'resourceId' => $reservation->resource_id
                */
      const reservations = result.data.reservations.map((reserv) => {
        return {
          title: reserv.title,
          start:  moment(reserv.start),
          end:  moment(reserv.end),
          resourceId: reserv.resourceId
        }
      })
      setResourceMap(result.data.resources)
      setEvents(reservations)
    }
    fetchData()
  }, []);
  return (
    <BigCalendar
      events={events}
      localizer={props.localizer}
      defaultView={BigCalendar.Views.DAY}
      views={['day', 'work_week']}
      step={30}
      defaultDate={new Date()}
      resources={resourceMap}
      resourceIdAccessor="resourceId"
      resourceTitleAccessor="resourceTitle"
    />
  )
}


ReactDOM.render(
  <Resource 
    localizer={localizer} 
    events={events} 
    resources={resourceMap} 
  />, document.getElementById("calendar"))