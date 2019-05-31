
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
      const reservations = result.data.reservations.map((reserv) => {
        return {
          title: reserv.title,
          start:  moment(reserv.start).toDate(),
          end:  moment(reserv.end).toDate(),
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
      min={new Date(2017, 10, 0, 6, 0, 0)}
      max={new Date(2017, 10, 0, 22, 0, 0)} 
      localizer={props.localizer}
      defaultView={BigCalendar.Views.DAY}
      views={['day', 'work_week']}
      step={30}
      timeslots={2}
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