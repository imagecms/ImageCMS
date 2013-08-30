/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: RU (Russian; русский язык)
 */
(function ($, lang) {
	$.extend($.validator.messages, {
            	required: lang.needToFillField,
		remote: lang.please + ", " + lang.enterCorrectValue +  ".",
		email: lang.please + ", " + lang.enterValidEmailAddress + ".",
		url: lang.please + ", " + lang.enterCorrectURL + ".",
		date: lang.please +  ", " + lang.enterCorrectDate + ".",
		dateISO: lang.please +  ", " + lang.enterCorrectDateFormatISO + ".",
		number: lang.please +  ", " + lang.enterNumber + ".",
		digits: lang.please + ", " + lang.enterOnlyNumbers + ".",
		creditcard: lang.please +  ", " + lang.enterValidCreditCardNumber + ".",
		equalTo: lang.please +  ", " + lang.enterTheSameValueAgain + ".",
		accept:  lang.please + ", " + lang.selectFileWwithCorrectExtension + ".",
		maxlength: $.validator.format(lang.please +  ", " + lang.enterNoMore + " {0} " + lang.characters + "."),
		minlength: $.validator.format(lang.please +  ", " + lang.enterAtLeast + " {0} " + lang.characters + "."),
		rangelength: $.validator.format(lang.please +  ", " + lang.enterValueFrom + " {0} " + lang.to + " {1} " + lang.characters + "."),
		range: $.validator.format(lang.please +  ", " + lang.enterNumberFrom + "{0} " + lang.to + " {1}."),
		max: $.validator.format(lang.please + ", " + lang.enterNumberLessThanOrEqualTo + " {0}."),
		min: $.validator.format(lang.please +  ", " + lang.enterNumberMoreThanOrEqualTo + " {0}.")
	});
}(jQuery, lang));