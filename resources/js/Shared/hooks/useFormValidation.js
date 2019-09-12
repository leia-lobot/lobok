import React from "react";

function useFormValidation(initialState, validate) {
    const [values, setValues] = React.useState(initialState);
    const [errors, setErrors] = React.useState({});
    const [hasErrors, setHasErrors] = React.useState(false);
    const [isSubmitting, setIsSubmitting] = React.useState(false);

    React.useEffect(() => {
        if (isSubmitting) {
            const noErrors = Object.keys(errors).length === 0;
            if (noErrors) {
                console.log("authenticated!");
                setIsSubmitting(false);
                setHasErrors(false);
            } else {
                setIsSubmitting(false);
                setHasErrors(true);
            }
        }
    }, [errors, isSubmitting]);

    function handleChange(event) {
        setValues({
            ...values,
            [event.target.name]: event.target.value
        });
    }
    function handleSelectChange(target, value) {
        setValues({
            ...values,
            [target]: value
        });
    }

    function handleBlur() {
        const validationErrors = validate(values);
        setErrors(validationErrors);
    }

    function handleSubmit(event) {
        event.preventDefault();
        const validationErrors = validate(values);
        setErrors(validationErrors);
        setIsSubmitting(true);
    }

    return {
        handleChange,
        handleSubmit,
        handleBlur,
        handleSelectChange,
        values,
        errors,
        hasErrors,
        isSubmitting
    };
}

export default useFormValidation;
