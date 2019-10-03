import React, { useState } from "react";
import { Menu } from "semantic-ui-react";
import { InertiaLink, usePage } from "@inertiajs/inertia-react";

function Menubar() {
    const pathname = window.location.pathname;
    const path = pathname === "/" ? "home" : pathname.substr(1);
    const [activeItem, setActiveItem] = useState(path);
    const { auth } = usePage();

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
            <InertiaLink
                name="overview"
                className={
                    "item " + (activeItem === "overview" ? "active" : "")
                }
                href={`/dashboard/resource/overview`}
                onClick={handleItemClick}
            >
                Overview
            </InertiaLink>
            {auth.user && (
                <InertiaLink
                    name="my-reservations"
                    className={
                        "item " +
                        (activeItem === "my-reservations" ? "active" : "")
                    }
                    href={`/dashboard/my-reservations`}
                    onClick={handleItemClick}
                >
                    My Reservations
                </InertiaLink>
            )}

            {!auth.user ? (
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
                            "item " +
                            (activeItem === "register" ? "active" : "")
                        }
                        href={`/register`}
                        onClick={handleItemClick}
                    >
                        Register
                    </InertiaLink>
                </Menu.Menu>
            ) : (
                <Menu.Menu position="right">
                    <InertiaLink
                        name="profile"
                        className={
                            "item " + (activeItem === "profile" ? "active" : "")
                        }
                        href={`/profile`}
                        onClick={handleItemClick}
                    >
                        Profile
                    </InertiaLink>
                    <InertiaLink
                        name="logout"
                        className="item"
                        href={`/logout`}
                        method="post"
                    >
                        Logout
                    </InertiaLink>
                </Menu.Menu>
            )}
        </Menu>
    );
}

export default Menubar;
