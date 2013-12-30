/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery.extend(jQuery.validator.messages, {
    required: lang("This field is required"),
    remote: lang("Please fix this field."),
    email: lang("Enter a valid email address."),
    url: lang("Please enter a valid URL."),
    date: lang("Please enter a valid date."),
    dateISO: lang("Please enter a valid date (ISO)."),
    number: lang("Please enter a valid number."),
    digits: lang("Please enter only digits."),
    creditcard: lang("Please enter a valid credit card number."),
    equalTo: lang("Please enter the same value again."),
    accept: lang("Please enter a value with a valid extension."),
    maxlength: $.validator.format(lang("Please enter no more than {0} characters.")),
    minlength: $.validator.format(lang("Please enter at least {0} characters.")),
    rangelength: $.validator.format(lang("Please enter a value between {0} and {1} characters long.")),
    range: $.validator.format(lang("Please enter a value between {0} and {1}.")),
    max: $.validator.format(lang("Please enter a value less than or equal to {0}.")),
    min: $.validator.format(lang("Please enter a value greater than or equal to {0}."))
});



