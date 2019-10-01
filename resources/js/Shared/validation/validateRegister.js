export default function validateAuth(values) {
    let errors = {};

    if (!values.name) {
        errors.name = "Required";
    }

    if (!values.email) {
        errors.email = "Required";
    } else if (!/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i.test(values.email)) {
        errors.email = "Invalid email address";
    }

    if (!values.password) {
        errors.password = "Required";
    } else if (values.password.length < 6) {
        errors.password = "Must be atleast 6 characters";
    } else if (values.password !== values.password_confirmation) {
        errors.password_confirmation = "Passwords must match";
    }
    return errors;
}
