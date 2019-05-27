
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

const events = [
  {
    id: 0,
    title: 'Board meeting',
    start: new Date(2018, 0, 29, 9, 0, 0),
    end: new Date(2018, 0, 29, 13, 0, 0),
    resourceId: 1,
  },
  {
    id: 1,
    title: 'MS training',
    allDay: true,
    start: new Date(2018, 0, 29, 14, 0, 0),
    end: new Date(2018, 0, 29, 16, 30, 0),
    resourceId: 2,
  },
  {
    id: 2,
    title: 'Team lead meeting',
    start: new Date(2018, 0, 29, 8, 30, 0),
    end: new Date(2018, 0, 29, 12, 30, 0),
    resourceId: 3,
  },
  {
    id: 11,
    title: 'Birthday Party',
    start: new Date(2018, 0, 30, 7, 0, 0),
    end: new Date(2018, 0, 30, 10, 30, 0),
    resourceId: 4,
  },
]

const resourceMap = [
  { resourceId: 1, resourceTitle: 'Board room' },
  { resourceId: 2, resourceTitle: 'Training room' },
  { resourceId: 3, resourceTitle: 'Meeting room 1' },
  { resourceId: 4, resourceTitle: 'Meeting room 2' },
]

function Resource (props){
  const [events, setEvents] = useState(props.events);
  const [resourceMap, setResourceMap] = useState(props.resources);
  return (
    <BigCalendar
      events={events}
      localizer={props.localizer}
      defaultView={BigCalendar.Views.DAY}
      views={['day', 'work_week']}
      step={30}
      defaultDate={new Date(2018, 0, 29)}
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