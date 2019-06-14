
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import React, { useState, useEffect } from 'react'
import ReactDOM from 'react-dom'
import BigCalendar from 'react-big-calendar'
import TimeRange from './vendor/react-time-range'
import moment from 'moment'
import axios from 'axios'

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


if(document.getElementById("calendar")) {
  ReactDOM.render(
    <Resource 
      localizer={localizer} 
      events={events} 
      resources={resourceMap} 
  />, document.getElementById("calendar"))
}
if(document.getElementById("timerange")) {
  ReactDOM.render(
    <TimeRange 
      use24Hours={true}
      startMoment={moment().format()}
      endMoment={moment().add(1, "hour").format()}
      startLabel=""
      endLabel=""
      delimiter="-"
      className="p-5 appearance-none flex items-center justify-around block bg-gray-200 text-gray-700 border border-gray-200 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
  />, document.getElementById("timerange"))
}