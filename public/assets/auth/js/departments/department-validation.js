$("#dept-form").validate({
    rules: {
        name: {
            required: true,
        },
        order_by: {
            required: true,
        },
        isOpenForAdmission: {
            required: true,
        },
    },
    messages: {
        name: "Please enter the department name",
        order_by: {
            required: "Please enter the order by value",
        },
        isOpenForAdmission: "Please select whether it is open for admission",
    },
    submitHandler: function (form) {
        form.submit();
    },
});
