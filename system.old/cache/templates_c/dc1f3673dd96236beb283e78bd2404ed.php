<script type="text/javascript">
    // var lang = new Object();
    var langs = new Object();

    langs.moduleInstall = "<?php echo lang ('Module installed','admin'); ?>";
    langs.moduleSuccessInstall = "<?php echo lang ('Module successfully installed','admin'); ?>";
    langs.error = "<?php echo lang ('Error','admin'); ?>";
    langs.errorSomethingWereWrong = "<?php echo lang ('Something went wrong. Startup status is not changed.'); ?>";
    langs.errorUrlAccess = "<?php echo lang ('Something went wrong. URL access is not changed.'); ?>";
    langs.turnOn = "<?php echo lang ('Turn on','admin'); ?>";
    langs.turnOff = "<?php echo lang ('Turn off','admin'); ?>";
    langs.haveNotModulesToInstall = "<?php echo lang ('Have not modules to install','admin'); ?>";
    langs.creatingWidget = "<?php echo lang ('Widget creating','admin'); ?>";
    langs.createdSuccessfullyWidget = "<?php echo lang ('Widget successfully created','admin'); ?>";
    langs.deleteGroup = "<?php echo lang ('Delete group','admin'); ?>";
    langs.enterTemplateName = "<?php echo lang ('Enter template name','admin'); ?>";
    langs.categoryHaveNotPage = "<?php echo lang ('No pages in category','admin'); ?>";
    langs.categorySuccessfullyAdd = "<?php echo lang ('Category successfully added','admin'); ?>";
    langs.name = "<?php echo lang ('Name','admin'); ?>";
    langs.discount = "<?php echo lang ('Discount','admin'); ?>";
    langs.needToEnterName = "<?php echo lang ('You need to enter a string','admin'); ?>";
    langs.needToFillField = "<?php echo lang ('This field is required.','admin'); ?>";
    langs.needToFillFields = "<?php echo lang ('Fill in the required fields.','admin'); ?>";
    langs.notFound = "<?php echo lang ('Your search did not found','admin'); ?>";
    langs.please = "<?php echo lang ('Please','admin'); ?>";
    langs.enterCorrectValue = "<?php echo lang ('enter the correct value','admin'); ?>";
    langs.enterValidEmailAddress = "<?php echo lang ('enter a valid email address','admin'); ?>";
    langs.enterCorrectURL = "<?php echo lang ('enter the correct URL','admin'); ?>";
    langs.enterCorrectDate = "<?php echo lang ('enter correct date','admin'); ?>";
    langs.enterCorrectDateFormatISO = "<?php echo lang ('enter correct date in format ISO','admin'); ?>";
    langs.enterNumber = "<?php echo lang ('enter number','admin'); ?>";
    langs.enterOnlyNumbers = "<?php echo lang ('enter only numbers','admin'); ?>";
    langs.enterValidCreditCardNumber = "<?php echo lang ('enter a valid credit card number','admin'); ?>";
    langs.enterTheSameValueAgain = "<?php echo lang ('enter the same value again','admin'); ?>";
    langs.selectFileWwithCorrectExtension = "<?php echo lang ('Select the file with the correct extension','admin'); ?>";
    langs.enterNoMore = "<?php echo lang ('Enter no more','admin'); ?>";
    langs.characters = "<?php echo lang ('characters','admin'); ?>";
    langs.enterAtLeast = "<?php echo lang ('enter at least','admin'); ?>";
    langs.enterValueFrom = "<?php echo lang ('enter value from','admin'); ?>";
    langs.to = "<?php echo lang ('to','admin'); ?>";
    langs.enterNumberFrom = "<?php echo lang ('enter number from','admin'); ?>";
    langs.enterNumberLessThanOrEqualTo = "<?php echo lang ('enter a number less than or equal to','admin'); ?>";
    langs.enterNumberMoreThanOrEqualTo = "<?php echo lang ('enter a number more than or equal to','admin'); ?>";

    // shop module
    langs.administrateShop = "<?php echo lang ('Administer shop','admin'); ?>";
    langs.backToTheSystem = "<?php echo lang ('Back to the system','admin'); ?>";
    langs.errorConversion = "<?php echo lang ('Conversion error','admin'); ?>";
    langs.userAlreadyNotifiedViaEmail = "<?php echo lang ('User already notified via E-mail upon availability! Notify again'); ?>";
    langs.notifyUserViaEmailUponAvailability = "<?php echo lang ('Notify the user via E-mail upon availability'); ?>";
    langs.errorOptionsRemoving = "<?php echo lang ('Error removing options','admin'); ?>";
    langs.deleteCanceledOrders = "<?php echo lang ('Delete canceled orders','admin'); ?>";
    langs.deleteCanceledMessages = "<?php echo lang ('Delete canceled messages','admin'); ?>";
    langs.deleteOredrID = "<?php echo lang ('Delete order ID','admin'); ?>";
    langs.productChanges = "<?php echo lang ('Product changes','admin'); ?>";
    langs.success = "<?php echo lang ('Success','admin'); ?>";
    langs.fileIsLoadedSlot = "<?php echo lang ('File is loaded. Slot'); ?>";
    langs.scriptErrorNotifyAdministrator = "<?php echo lang ('Script error. Notify administrator.'); ?>";
    langs.waitForResizeEnding = "<?php echo lang ('Wait for resize ending','admin'); ?>";
    langs.resizeImagesForProducts = "<?php echo lang ('Resize images for products','admin'); ?>";
    langs.allFindingProducts = "<?php echo lang ('All finding products','admin'); ?>";
    langs.processed = "<?php echo lang ('Processed','admin'); ?>";
    langs.imagesUpdated = "<?php echo lang ('Images updated','admin'); ?>";
    langs.completed = "<?php echo lang ('Completed','admin'); ?>";


    //templates/administrator/js/*
    langs.resizeProductsImages = "<?php echo lang ('Resize products images','admin'); ?>";
    langs.productsFound = "<?php echo lang ('Products found','admin'); ?>";
    langs.additionalImagesResize = "<?php echo lang ('Additional images resize','admin'); ?>";
    langs.foundProdWithAdditionalImgs = "<?php echo lang ('Found products with additional images','admin'); ?>";
    langs.imagesUpdated = "<?php echo lang ('Images updated','admin'); ?>";

    langs.accessDenied = "<?php echo lang ('Access denied','admin'); ?>";
    langs.thisIsDemoMessage = "<?php echo lang ('This is a demo version ImageCMS. Part of the actions are limited. For a complete functional download and install the distribution.','admin'); ?>";
    langs.message = "<?php echo lang ('Message','admin'); ?>";
    langs.enterColumnNum = "<?php echo lang ('Please enter the column number','admin'); ?>";
    langs.columnNumUpdated = "<?php echo lang ('Column number updated','admin'); ?>";
    langs.failColumnNumUodate = "<?php echo lang ('Failed to update the column number','admin'); ?>";
    langs.product = "<?php echo lang ('Product','admin'); ?>";
    langs.variant = "<?php echo lang ('Variant','admin'); ?>";
    langs.price = "<?php echo lang ('Price','admin'); ?>";
    langs.balance = "<?php echo lang ('Balance','admin'); ?>";
    langs.outOfStock = "<?php echo lang ('Out of stock','admin'); ?>";
    langs.addToCart = "<?php echo lang ('Add to Cart','admin'); ?>";
    langs.inTheCart = "<?php echo lang ('In the cart','admin'); ?>";
    langs.thisEmailUserExists = "<?php echo lang ('A user with this email already exists','admin'); ?>";
    langs.newUserCreated = "<?php echo lang ('New user created','admin'); ?>";
    langs.failToCreateUser = "<?php echo lang ('Failed to create user','admin'); ?>";
    langs.checkAndFillAll = "<?php echo lang ('Check the input data and fill in all mandatory fields','admin'); ?>";
    langs.curCertificate = "<?php echo lang ('Current certificate (amount):','admin'); ?>";
    langs.sortMethodUpdated = "<?php echo lang ('Sort method updated','admin'); ?>";

    // shopFunctions.js
    langs.manageShop = "<?php echo lang ('Manage shop','admin'); ?>";
    langs.backToTheSystem = "<?php echo lang ('Back to the system','admin'); ?>";
    langs.convertionError = "<?php echo lang ('Conversion error, ','admin'); ?>";
    langs.failureToRemoveVariant = "<?php echo lang ('Failure to remove variant','admin'); ?>";
    langs.removeSelectedOrders = "<?php echo lang ('Remove selected orders?','admin'); ?>";
    langs.removeSelectedNotifications = "<?php echo lang ('Remove selected notifications?','admin'); ?>";
    langs.removeOrderId = "<?php echo lang ('Remove order with ID: ','admin'); ?>";
    langs.changeProduct = "<?php echo lang ('Change product','admin'); ?>";


    langs.fileLoaded = "<?php echo lang ('The file is loaded. Slot ','admin'); ?>";
    langs.scriptErrorTellAdmin = "<?php echo lang ('Error in the script. Please notify the administrator','admin'); ?>";

    langs.onlyFontsFilesAllowed = "<?php echo lang ('Only fonts-files can be uploaded','admin'); ?>";
    langs.fontNotUploaded = "<?php echo lang ('Font is not uploaded', 'admin'); ?>";
    langs.remove = "<?php echo lang ('Remove','admin'); ?>";
        function lang(value) {
            if (langs[value]) {
                return  langs[value];
            } else {
                return value;
            }
        }
    


</script>

<?php $mabilis_ttl=1415876668; $mabilis_last_modified=1415789033; ///var/www/image-c.loc/templates/administrator/inc/javascriptVars.tpl ?>