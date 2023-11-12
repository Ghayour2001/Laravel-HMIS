$("#update-bed-form").validate({
    rules: {
        name: {
            required: true,
        },
        bedtype_id: {
            required: true,
        },
        bedgroup_id: {
            required: true,
        },
    },
    messages: {
        name: "Please enter the name",
        bedtype_id: "Select bed type",
        bedtype_id: "Select bed group",
    },
});
