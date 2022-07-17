$(function() {
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='checkout']").validate({
        // Specify validation rules
        rules: {
            firstname: "required",
            lastname: "required",
            shipping_country: "required",
            shipping_city: "required",
            shipping_street: "required",
            shipping_zipcode: "required",
            shipping_phone: "required",

        },
        // Specify validation error messages
        messages: {
            firstname: "This value is required",
            lastname: "This value is required",
            shipping_country: "Please Select Customer",
            shipping_city: "This value is required",
            shipping_street: "This value is required",
            shipping_zipcode: "This value is required",
            shipping_phone: "This value is required",
        

        },

        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
            form.submit();
            $(':button').prop('disabled', true);
        }
    });
});
