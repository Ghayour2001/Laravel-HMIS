$("#update-bedgroup-form").validate({
    rules: {
        name: {
            required: true,
        },
        floor_id: {
            required: true,
        },
        description: {
            required: true,
        },
    },
    messages: {
        name: "Please enter the name",
        floor_id: "Select floor",
        description: "Please enter the description",
    },
});
