import React from "react";
import { InertiaLink } from "@inertiajs/inertia-react";
import ListItem from "@material-ui/core/ListItem";
import ListItemIcon from "@material-ui/core/ListItemIcon";
import ListItemText from "@material-ui/core/ListItemText";
import ListSubheader from "@material-ui/core/ListSubheader";
import DashboardIcon from "@material-ui/icons/Dashboard";
import PeopleIcon from "@material-ui/icons/People";
import BarChartIcon from "@material-ui/icons/BarChart";
import LayersIcon from "@material-ui/icons/Layers";
import AssignmentIcon from "@material-ui/icons/Assignment";
import EventNote from "@material-ui/icons/EventNote";
import EventIcon from "@material-ui/icons/Event";
import { Divider } from "@material-ui/core";

import ListItemLink from "../components/ListItemLink";

export default function Navigation() {
    return (
        <div>
            <ListItemLink button component="a" href="/dashboard">
                <ListItemIcon>
                    <DashboardIcon />
                </ListItemIcon>
                <ListItemText primary="Dashboard" />
            </ListItemLink>
            <ListItemLink button component="a" href="/overview">
                <ListItemIcon>
                    <EventNote />
                </ListItemIcon>
                <ListItemText primary="Overview" />
            </ListItemLink>
            <ListItemLink button component="a" href="/reservation">
                <ListItemIcon>
                    <EventIcon />
                </ListItemIcon>
                <ListItemText primary="Reservation" />
            </ListItemLink>
        </div>
    );
}
