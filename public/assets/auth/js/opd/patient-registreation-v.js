jQuery("#patientForm").validate({
    rules: {
        name: "required",
        type: "required",
        age: {
            required: true,
            number: true,
        },
        pat_gender: {
            required: true,
        },
        cnic: "required",
        contact_no: "required",
        doctor_id: "required",
        department_id: "required",
        city: "required",
        guardian_name: "required",
        guardian_contact: "required",
        address: "required",
    },
    messages: {
        name: "Please enter the patient's full name",
        type: "Please enter the patient's type",
        age: {
            required: "Please enter the patient's age",
            number: "Please enter a valid number for age",
        },

        pat_gender: {
            required: "Please select the patient's gender",
        },
        cnic: "Please enter the CNIC number",
        contact_no: "Please enter the contact number",
        doctor_id: "Please select a doctor",
        department_id: "Please select a department",
        city: "Please enter the city",
        guardian_name: "Please enter the guardian's name",
        guardian_contact: "Please enter the guardian's contact number",
        address: "Please enter the address",
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "pat_gender") {
            error.appendTo($("#gender-error"));
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form) {
        form.submit();
    },
});
