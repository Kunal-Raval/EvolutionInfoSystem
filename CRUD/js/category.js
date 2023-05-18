$(document).ready(function() {
    $.validator.addMethod("noSpecialChars", function(value, element) {
        return /^[a-zA-Z0-9\s]+$/.test(value);
    }, "Special characters are not allowed.");

    $('#myForm').validate({
        rules: {
            category_name: {
                required: true,
                noSpecialChars: true
            }

        },
        messages: {
            category_name: {
                required: "Enter a valid Category name. No special characters allowed."
            }

        },
        errorClass: "error",
        submitHandler: function(form) {
            form.submit(); // Allow form submission
        }
    });
});