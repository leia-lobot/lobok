import React, { useState } from "react";
import { Menu, Dropdown } from "semantic-ui-react";
import { InertiaLink, usePage } from "@inertiajs/inertia-react";

function Menubar() {
    const pathname = window.location.pathname;
    const paths = pathname.split("/");
    function isActive(value, arr) {
        return arr.includes(value);
    }
    let path;

    if (paths) {
        if (isActive("resource", paths)) {
            path = "resources";
        } else if (isActive("my-reservations", paths)) {
            path = "my-reservations";
        } else if (isActive("register", paths)) {
            path = "register";
        } else if (isActive("login", paths)) {
            path = "login";
        } else {
            path = pathname === "/" ? "home" : pathname.substr(1);
        }
    }

    const [activeItem, setActiveItem] = useState(path);

    const { auth, resourceMenuList } = usePage();

    return (
        <Menu pointing secondary size="massive" color="teal">
            <InertiaLink
                name="dashboard"
                className={"item "}
                href={`/`}
                onClick={() => setActiveItem("dashboard")}
            >
                Lobok
            </InertiaLink>

            <Dropdown
                text="Resources"
                pointing
                className={
                    "link item " + (activeItem === "resources" ? "active" : "")
                }
            >
                <Dropdown.Menu>
                    <InertiaLink
                        name="overview"
                        className={"item "}
                        href={`/dashboard/resource/overview`}
                        onClick={() => setActiveItem("resources")}
                    >
                        Overview
                    </InertiaLink>
                    {resourceMenuList &&
                        resourceMenuList.map(item => (
                            <InertiaLink
                                key={`resource-` + item.id}
                                name={item.name}
                                className={"item "}
                                href={`/dashboard/resource/` + item.id}
                                onClick={() => setActiveItem("resources")}
                            >
                                {item.text}
                            </InertiaLink>
                        ))}
                </Dropdown.Menu>
            </Dropdown>

            {auth.user && (
                <InertiaLink
                    name="my-reservations"
                    className={
                        "item " +
                        (activeItem === "my-reservations" ? "active" : "")
                    }
                    href={`/dashboard/my-reservations`}
                    onClick={() => setActiveItem("my-reservations")}
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
                        onClick={() => setActiveItem("login")}
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
                        onClick={() => setActiveItem("register")}
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
                        onClick={() => setActiveItem("profile")}
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
