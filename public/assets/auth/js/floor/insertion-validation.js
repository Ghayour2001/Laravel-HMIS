    $("#add-floor-form").validate({
        rules: {
            name: {
                required: true,
            },
            description: {
                required: true,
            },
        },
        messages: {
            name: "Please enter the name",
            description: "Please enter the description",
        },
    });

