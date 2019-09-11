import React, { useState } from "react";
import { Menu } from "semantic-ui-react";
import { InertiaLink } from "@inertiajs/inertia-react";

function Menubar() {
    const pathname = window.location.pathname;
    const path = pathname === "/" ? "home" : pathname.substr(1);
    const [activeItem, setActiveItem] = useState(path);

    const handleItemClick = e => setActiveItem(e.target.name);

    return (
        <Menu pointing secondary size="massive" color="teal">
            <InertiaLink
                name="dashboard"
                className={
                    "item " + (activeItem === "dashboard" ? "active" : "")
                }
                href={`/dashboard`}
                onClick={handleItemClick}
            >
                Dashboard
            </InertiaLink>
            <Menu.Menu position="right">
                <InertiaLink
                    name="login"
                    className={
                        "item " + (activeItem === "login" ? "active" : "")
                    }
                    href={`/login`}
                    onClick={handleItemClick}
                >
                    Login
                </InertiaLink>
                <InertiaLink
                    name="register"
                    className={
                        "item " + (activeItem === "register" ? "active" : "")
                    }
                    href={`/register`}
                    onClick={handleItemClick}
                >
                    Register
                </InertiaLink>
            </Menu.Menu>
        </Menu>
    );
}

export default Menubar;
