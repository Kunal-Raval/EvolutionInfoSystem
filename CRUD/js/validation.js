$(document).ready(function() {
    $.validator.addMethod("noSpecialChars", function(value, element) {
        return /^[a-zA-Z0-9\s]+$/.test(value);
      }, "Special characters are not allowed.");
  $.validator.addMethod("numericOnly", function(value, element) {
    return /^[0-9]+$/.test(value);
  }, "Please enter a valid number.");

  $('#myForm').validate({
    rules: {
      category_name: {
        required: true,
        noSpecialChars: true
      },
      pname: {
        required: true,
        noSpecialChars: true
      },
      sku: {
        required: true,
        noSpecialChars: true
      },
      details: {
        required: true
      },
      price: {
        required: true,
        numericOnly: true
      },
      quantity: {
        required: true,
        numericOnly: true
      }
    },
    messages: {
      category_name: {
        required: "Enter a valid Category name. No special characters allowed."
      },
      pname: {
        required: "Enter a valid name. No special characters allowed."
      },
      sku: {
        required: "Please enter SKU. No special characters allowed."
      },
      details: {
        required: "Please enter details."
      },
      price: {
        required: "Please enter price.",
        numericOnly: "Please enter a valid number."
      },
      quantity: {
        required: "Please enter quantity.",
        numericOnly: "Please enter a valid number."
      }
    },
    errorClass: "error",
    submitHandler: function(form) {
      form.submit(); // Allow form submission
    }
  });


});

