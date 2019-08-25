import React from "react";

import ListItemIcon from "@material-ui/core/ListItemIcon";
import ListItemText from "@material-ui/core/ListItemText";
import DashboardIcon from "@material-ui/icons/Dashboard";
import EventNote from "@material-ui/icons/EventNote";
import EventIcon from "@material-ui/icons/Event";

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
