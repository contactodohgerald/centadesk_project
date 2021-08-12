<script>
    var validationModule = function(){

        let errors = {};

        //validate Empty
        function validateEmpty(value, fieldName, className){
            if(value === '' || value === null){
                returnValidationMessage(className, fieldName+' is required');
            }
        }

        //validate Empty
        function validateFileSize(fileIdAndSize, fieldName, className){
            //['fieldId,size:sizeReadable|className|fieldName|type']
            let explodedValue = fileIdAndSize.split(',');
            let fileSize = explodedValue[1].split(':');
            let fileSizeNo = fileSize[0];
            let fileSizeReadable = fileSize[1];
            let fileId = explodedValue[0];
            let fileField = document.getElementById(fileId);

            if(fileField.files.length == 0){ return; }
            if (fileField.files[0].size > fileSizeNo){
                returnValidationMessage(className, fieldName+' must be less than or equal to '+fileSizeReadable);
            }
        }

        //validate number
        function validateNumber(value, fieldName, className){
            if(isNaN(value)){
                returnValidationMessage(className, fieldName+' must be numeric');
            }
        }

        //validate Address
        function validateEmailAddress(value, fieldName, className){
            if(value === ''){ return; }
            if(!emailValidator(value)){
                returnValidationMessage(className, fieldName+' must be an email');
            }
        }

        //chech if a value exiats in a string
        function validateExistenceOfAValueInaString(value, fieldName, className){
            //valueToBeValidated+','+valueToBeCheckedFor+':rightExpression|ClassName|Field Name|conditional_empty'
            let explodedValue = value.split(',');
            let valueToBeValidated = explodedValue[0];//the value to validated
            if(valueToBeValidated !== '' || valueToBeValidated !== null){
                let valueToBeCheckedForAndrightExpression = explodedValue[1];//combination of valuetobechecked and right expression
                let explodedExpression = valueToBeCheckedForAndrightExpression.split(':');
                let valueToBeCheckedFor = explodedExpression[0];
                let rightExpression = explodedExpression[1];
                if(valueToBeValidated.includes(valueToBeCheckedFor) === false){
                    returnValidationMessage(className, fieldName+' must be of correct format: '+rightExpression);
                }
            }
        }

        //validate empty on a condition
        function validateEmptyOnCondition(value, fieldName, className){
            //main_value+':main_value_answer,'+sub_value+'|className|Sub Field 1 Name,Main Field Name|conditional_empty'
            let explodedValue = value.split(',');
            let mainValue = explodedValue[0].split(':');
            let explodedFieldName = fieldName.split(',');

            if(mainValue[0] === mainValue[1] && explodedValue[1] === ''){
                returnValidationMessage(className, explodedFieldName[0]+' is required');
                // if value for '+explodedFieldName[1]+' is provided as '+mainValue[1]
            }
        }

        //validate empty on a condition
        function validateStringLength(value, fieldName, className){
            let explodedValue = value.split(',');
            if(explodedValue[0].length > explodedValue[1]){
                returnValidationMessage(className, 'Total Characters for '+fieldName+' cannot exceed '+explodedValue[1]);
            }
        }

        function passwordMatchValidation(passwordValues, fieldName, className){
            //['value1:value2|className|fieldName|type1']
            let explodedValue = passwordValues.split(':');
            let mainPassword = explodedValue[0].trim();
            let confirmPassword = explodedValue[1].trim();

            if(mainPassword === '' || confirmPassword === ''){
                returnValidationMessage(className, 'Please provide both password and password confirmation value');
                return;
            }
            if(mainPassword !== confirmPassword){
                returnValidationMessage(className, 'Passwords does not match');
            }
        }

        async function validateImageDimensions(fileId, fieldName, className){//width: 600, height: 700

            try {
                let file = document.getElementById(fileId).files[0];
                if(typeof file == 'undefined'){
                    returnValidationMessage(className, 'Please select image you want to use for this Ads Campaign');
                    return;
                }
                const dimensions = await imageDimensions(file);
                if(dimensions.width <= dimensions.height){
                    returnValidationMessage(className, 'Please use an image with landscape resolution');
                }
            } catch(error) {
                returnValidationMessage(className, error);
            }
        }

        //['fileId|className|fieldName|type']
        async function validateEmptyFileField(fileId, fieldName, className){
            console.log(document.getElementById(fileId).files.length)
            if( document.getElementById(fileId).files.length == 0 ){
                returnValidationMessage(className, fieldName+' is required!');
            }
        }

        async function  validateCheckboxCheck(fileIdPlusMessage, fieldName, className){
            //['fieldId,errorMessage|className|fieldName|type']
            let explodedFieldPlusMessage = fileIdPlusMessage.split(',');
            let fieldId = explodedFieldPlusMessage[0];
            let message = explodedFieldPlusMessage[1];
            if (!$("#"+fieldId).is(":checked")) {
                returnValidationMessage(className, message);
                return;
            }

        }

        function returnValidationMessage(className, errorMessage){
            let error_array = [];
            if(className in errors){
                error_array = errors[className];
                error_array.push(errorMessage);
            }else{
                error_array.push(errorMessage);
            }
            errors[className] = error_array;
        }

        function returnError($error){
            return $error;
        }

        //['value|className|fieldName|type']
        async function callValidator(thingsToValidate){

            errors = {};
            $(".error_displayer").html('')

            //try {

            for(var i = 0; i < thingsToValidate.length; i++) {

                let explodedValidationDetails = thingsToValidate[i].split('|');

                if (explodedValidationDetails.length != 4) {
                    throw 'Please make sure you supplied parameters for validation in correct format'
                }

                //explode the type
                let explodedTypes = explodedValidationDetails[3].split(',');

                for (var l = 0; l < explodedTypes.length; l++) {

                    switch (explodedTypes[l]) {
                    //type = empty,email,number
                        case 'empty':
                            validateEmpty(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                            break;
                        case 'email':
                            validateEmailAddress(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                            break;
                        case 'number':
                            validateNumber(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                            break;
                        case 'conditional_empty':
                            validateEmptyOnCondition(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                            break;
                        case 'value_existence_in_a_string':
                            validateExistenceOfAValueInaString(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                            break;
                        case 'word_length':
                            validateStringLength(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                            break;
                        case 'image_dimensions':
                            await validateImageDimensions(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                            break;
                        case 'empty_file_field':
                            await validateEmptyFileField(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                            break;
                        case 'image_size':
                            await validateFileSize(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                            break;
                        case 'password_match_validation':
                            passwordMatchValidation(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                            break;
                        case 'validate_checking_check':
                            validateCheckboxCheck(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                            break;
                        default:
                            alert('No Match');
                    }

                }
            }

            if(Object.keys(errors).length > 0){
                return {status:false, message:errors};
            }
            return {status:true};

            /*}catch (e) {
                alert(e);
            }*/

        }

        //display the error
        function handleErrorStatement(error_statement, loginPage = 'login', showField = 'on', useClassForFieldFocus = 'yes',
            useModal = 'no') {

            var counter = 0;
            let theKey = '',
                theTxt = '';
            let errorStatementLenght = Object.keys(error_statement).length;
            let incomingErrorArray = [];
            for (var i in error_statement) {
                if (counter == 0) {
                    theKey = i;
                }

                if (typeof error_statement[i] === 'string') {
                    if (error_statement[i].indexOf(':') != -1) {
                        error_statement[i] = error_statement[i].split(':');
                    }
                }

                var txt = '';
                for (var j in error_statement[i]) {

                    incomingErrorArray.push(error_statement[i][j]);

                    txt += "<p style='font-size:12px' class='f-size error_carrier text-danger'><span >*</span> " +
                        error_statement[i][j] + "</p>";
                }

                if (i === 'general_error') {
                    if (useModal === 'yes') {
                        this.callErrorModal(txt);
                        $(".errorAreaHolder p").removeClass('t-color');
                    } else {
                        swal.fire("ERROR!", txt, "error");;
                        $(".error_carrier").removeClass('t-color');
                    }

                } else {

                    if (i.indexOf('.') != -1) {

                        //split the value at point i
                        let mainIndex = i.split('.');
                        let mainErrorClass = mainIndex[0];
                        let currentPoint = parseFloat(mainIndex[1]);
                        let selectedMainErrorClass = $('.err_' + mainErrorClass);
                        for (let e = 0; e < selectedMainErrorClass.length; e++) {
                            if (e == currentPoint) {
                                $(selectedMainErrorClass[e]).html(txt).removeClass('hidden');

                                if (counter == 0) {
                                    let newClass = mainErrorClass +
                                        currentPoint; //create a new class from the combination of the field class and current index
                                    $(selectedMainErrorClass[e]).siblings('input').addClass(
                                        newClass); //add a class to the input field
                                    theKey = newClass; //reassign the key
                                    useClassForFieldFocus = 'yes';
                                }
                            }
                        }
                    } else {
                        if (useModal === 'yes') {
                            theTxt += txt;
                        } else {
                            $('.err_' + i).html(txt).removeClass('hidden');
                        }
                        //$('.err_'+i).html(txt).removeClass('hidden');
                    }
                    //show the field with the first error message
                    if (parseFloat(counter) == parseFloat(errorStatementLenght - 1)) {
                        if (showField === 'on') {
                            this.scrollIntoDomView(theKey, useClassForFieldFocus);
                           // alert('Some validation errors occurred.', 'warning');
                        }
                        if (useModal === 'yes') {
                            this.callErrorModal(theTxt);
                        }
                    }
                    counter++;
                }

            }
            this.chckForLogout(incomingErrorArray, loginPage);
        }

        function callErrorModal(error) {
            $(".errorAreaHolder").html(error);
            $(".errorCarrierBox").removeClass("hidden");
            let elementHeight = $(".errorAreaHolderMain").height();
            if (elementHeight == 500) {
                $(".errorCarrierBox").attr({
                    'title': 'scroll down with scroll the bar to view more errors'
                })
                $(".errorAreaHeadNot").removeClass('hidden');
            }
        }

        function constructFileTypes(fileTypeArray) {
            let stringValue = '';
            let mainLen = parseFloat(fileTypeArray.length) - parseFloat(1);
            for (let i = 0; i < fileTypeArray.length; i++) {
                if (mainLen == i) {
                    stringValue += 'or ' + fileTypeArray[i] + ' file';
                } else {
                    stringValue += fileTypeArray[i] + ' file,';
                }
            }
            return stringValue;
        }

        function scrollIntoDomView(selectedElement, useClassForFieldFocus) {
            let prefix = '';
            let offset = '';
            if (useClassForFieldFocus === 'no') {
                offset = $("#" + selectedElement).offset(); // Contains .top and .left
                prefix = '#';
            } else {
                offset = $("." + selectedElement).offset(); // Contains .top and .left
                prefix = '.';
            }

            //Subtract 20 from top and left:

            offset.left -= 200;
            offset.top -= 200;
            //Now animate the scroll-top and scroll-left CSS properties of <body> and <html>:

            $('html, body').animate({
                scrollTop: offset.top,
                scrollLeft: offset.left
            });
            $(prefix + selectedElement).focus();

        }

        function chckForLogout(incomingErrorArray) {
            if (this.checkIfInArray('Please Login to continue', incomingErrorArray) != -1) {
                setTimeout(async function() {
                    //get the user details
                    let userType = await getRequest('../getTypeOfUser.php?get_user_type');
                    let typeOfUser = userType.typeOfUser;
                    let page = typeOfUser === 'dev' ? '../adminLogin' : '../login';
                    window.location.href = page;
                }, 2000)
            }
        }

        //check if a value is a n array
        function checkIfInArray(theValue, theArray){
            return jQuery.inArray(theValue, theArray);

        }

        function emailValidator(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        function imageDimensions(file){

            return new Promise(function (resolve, reject) {

                const img = new Image();

                // the following handler will fire after the successful loading of the image
                img.onload = () => {
                    const { naturalWidth: width, naturalHeight: height } = img;
                    resolve({ width, height })
                }

                // and this handler will fire if there was an error with the image (like if it's not really an image or a corrupted one)
                img.onerror = () => {
                    reject('There was some problem with the image.')
                }

                img.src = URL.createObjectURL(file)

            });
        }

        // here's how to use the helper
        //{ target: { files } }
        async function getImageInfo(file){
            //const [file] = files
            try {
                const dimensions = await imageDimensions(file);
                return {error_code:0, data:dimensions};
            } catch(error) {
                return {error_code:1, error:error}
            }
        }

        return{
            passwordMatchValidation:passwordMatchValidation,
            validateStringLength:validateStringLength,
            getImageInfo:getImageInfo,
            imageDimensions:imageDimensions,
            checkIfInArray:checkIfInArray,
            chckForLogout:chckForLogout,
            handleErrorStatement:handleErrorStatement,
            callValidator:callValidator,
            returnValidationMessage:returnValidationMessage,
            validateCheckboxCheck:validateCheckboxCheck,
            validateEmptyFileField:validateEmptyFileField,
            validateImageDimensions:validateImageDimensions,
            validateEmptyOnCondition:validateEmptyOnCondition,
            validateExistenceOfAValueInaString:validateExistenceOfAValueInaString,
            validateEmailAddress:validateEmailAddress,
            validateNumber:validateNumber,
            validateEmpty:validateEmpty,
            validateFileSize:validateFileSize,
            scrollIntoDomView:scrollIntoDomView,
            callErrorModal:callErrorModal,
            errors:errors
        }

    }()
</script>