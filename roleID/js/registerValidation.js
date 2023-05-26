$(document).ready(function() {
    $.validator.addMethod("noSpecialChars", function(value, element) {
        return /^[a-zA-Z0-9\s]+$/.test(value);
      }, "Special characters are not allowed.");
  $.validator.addMethod("numericOnly", function(value, element) {
    return /^[0-9]+$/.test(value);
  }, "Please enter a valid number.");

  $('#myForm').validate({
    rules: {
      name: {
        required: true,
        noSpecialChars: true
      },
      email: {
        required: true,
      },
      phone: {
        required: true,
        numericOnly: true
      },
      password: {
        required: true
      },
      cpassword: {
        required: true,
      },
    },
    messages: {
      name: {
        required: "Enter a valid Category name. No special characters allowed."
      },
      email: {
        required: "Enter a valid email address."
      },
      phone: {
        required: "Please enter your phone number"
      },
      password: {
        required: "Please enter your password."
      },
      cpassword: {
        required: "Please enter your password again.",
        
      },
    },
    errorClass: "error",
    submitHandler: function(form) {
      form.submit(); // Allow form submission
    }
  });
});

