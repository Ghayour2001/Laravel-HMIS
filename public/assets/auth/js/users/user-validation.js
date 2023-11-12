$("#employeeForm").validate({
    rules: {
        name: {
            required: true,
        },
        father_name: {
            required: true,
        },
        email: {
            required: true,
            email: true,
        },
        dob: {
            required: true,
        },
        cnic: {
            required: true,
        },
        department_id: {
            required: true,
        },
        qualification: {
            required: true,
        },
        probation_period: {
            required: true,
        },
        contact_no: {
            required: true,
        },
        position: {
            required: true,
        },
        address: {
            required: true,
        },
        password: {
            required: true,
        },
    },
    messages: {
        name: "Please enter the name",
        father_name: "Please enter the father's name",
        email: {
            required: "Please enter an email address",
            email: "Please enter a valid email address",
        },
        dob: "Please select the date of birth",
        cnic: {
            required: "Please enter the CNIC number",
        },
        department_id: "Please select a department",
        qualification: "Please enter the qualification",
        probation_period: "Please select the contract duration",
        contact_no: {
            required: "Please enter the contact number",
        },
        position: "Please enter the position",
        address: "Please enter the address",
        password: "Please enter a password",
    },
    submitHandler: function (form) {
        form.submit();
    },
});
