export default function validateAuth(values) {
    let errors = {};

    if (!values.start) {
        errors.start = "Required";
    } else if (!values.end) {
        errors.end = "Required";
    } else if (!values.company) {
        errors.company = "Required";
    } else if (!values.resource) {
        errors.resource = "Required";
    }

    return errors;
}
