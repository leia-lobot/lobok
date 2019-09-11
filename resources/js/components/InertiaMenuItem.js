import React, { useCallback } from "react";
import { Inertia, shouldIntercept } from "@inertiajs/inertia";

import { Menu } from "semantic-ui-react";

const noop = () => undefined;

export default function InertiaMenuItem({
    children,
    data = {},
    href,
    method = "get",
    onClick = noop,
    preserveScroll = false,
    preserveState = false,
    replace = false,
    ...props
}) {
    const visit = useCallback(
        event => {
            onClick(event);

            if (shouldIntercept(event)) {
                event.preventDefault();

                Inertia.visit(href, {
                    data,
                    method,
                    preserveScroll,
                    preserveState,
                    replace
                });
            }
        },
        [data, href, method, onClick, preserveScroll, preserveState, replace]
    );

    return (
        <Menu.Item {...props} name="login" onClick={visit}>
            {children}
        </Menu.Item>
    );
}
