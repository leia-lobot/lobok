import React from "react";
import { Dropdown } from "semantic-ui-react";
import { Inertia } from "@inertiajs/inertia";

export default function SelectResource(props) {
    const [resources, setResources] = React.useState(props.list);

    const pathname = window.location.pathname;
    const path = pathname.split("/dashboard/resource/")[1];

    const [selectedResource, setSelectedResource] = React.useState();

    React.useEffect(() => {
        resources.unshift({
            value: "overview",
            key: "overview",
            text: "Overview"
        });
    }, [resources]);

    React.useEffect(() => {
        setSelectedResource(path);
    }, []);

    return (
        <Dropdown
            selection
            onChange={(e, { value }) => {
                Inertia.visit(`/dashboard/resource/${value}`);
            }}
            options={resources}
            value={selectedResource}
        />
    );
}
