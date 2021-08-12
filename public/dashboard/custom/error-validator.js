let incomingErrorArray = [];
class validatorClass{

    constructor(){

        $(".error_displayer").text("");

        $(".errorCarrierBox").addClass("hidden").removeAttr('title');
        $(".errorAreaHeadNot").addClass('hidden');

        this.errors = {};
        //['value|className|fieldName|type'];
    }

    //validate Empty
    validateEmpty(value, fieldName, className){
        if(value === '' || value === null){
            this.returnValidationMessage(className, fieldName+' is required');
        }
    }

    validateEmptyForArray(classNameForSelectedFields, fieldName, className){//['classNameForFormField|className|fieldName|type']
        let selected = $("."+classNameForSelectedFields);
        for(var i = 0; i < selected.length; i++){
            $(selected[i]).addClass(className+'_'+i);
            $(selected[i]).siblings('.err_'+className).addClass('err_'+className+'_'+i);
            if($(selected[i]).val() === '' || $(selected[i]).val() === null){

                this.returnValidationMessage(className+'_'+i, fieldName+' is required');
            }
        }
    }

    validateNumericForArray(classNameForSelectedFields, fieldName, className){//['classNameForFormField|className|fieldName|type']
        let selected = $("."+classNameForSelectedFields);
        for(var i = 0; i < selected.length; i++){
            $(selected[i]).addClass(className+'_'+i);
            $(selected[i]).siblings('.err_'+className).addClass('err_'+className+'_'+i);
            if($(selected[i]).val() !== '' && $(selected[i]).val() !== null){

                if(isNaN($(selected[i]).val())){
                    this.returnValidationMessage(className+'_'+i, fieldName+' must be a number');
                }

            }
        }
    }

    //validate Empty
    validateFileSize(fileIdAndSize, fieldName, className){
        //['fieldId,size:sizeReadable|className|fieldName|type']
        let explodedValue = fileIdAndSize.split(',');
        let fileSize = explodedValue[1].split(':');
        let fileSizeNo = fileSize[0];
        let fileSizeReadable = fileSize[1];
        let fileId = explodedValue[0];
        let fileField = document.getElementById(fileId);

        if(fileField.files.length == 0){ return; }
        if (fileField.files[0].size > fileSizeNo){
            this.returnValidationMessage(className, fieldName+' must be less than or equal to '+fileSizeReadable);
        }
    }

    //validate number
    validateNumber(value, fieldName, className){
        if(value === null || value === ''){ return;}
        if(isNaN(value)){
            this.returnValidationMessage(className, fieldName+' must be numeric');
        }
    }

    //validate Address
    validateEmailAddress(value, fieldName, className){
        if(value === ''){ return; }
        if(!this.emailValidator(value)){
            this.returnValidationMessage(className, fieldName+' must be an email');
        }
    }

    //chech if a value exiats in a string
    validateExistenceOfAValueInaString(value, fieldName, className){
        //valueToBeValidated+','+valueToBeCheckedFor+':rightExpression|ClassName|Field Name|conditional_empty'
        let explodedValue = value.split(',');
        let valueToBeValidated = explodedValue[0];//the value to validated
        if(valueToBeValidated !== '' || valueToBeValidated !== null){
            let valueToBeCheckedForAndrightExpression = explodedValue[1];//combination of valuetobechecked and right expression
            let explodedExpression = valueToBeCheckedForAndrightExpression.split(':');
            let valueToBeCheckedFor = explodedExpression[0];
            let rightExpression = explodedExpression[1];
            if(valueToBeValidated.includes(valueToBeCheckedFor) === false){
                this.returnValidationMessage(className, fieldName+' must be of correct format: '+rightExpression);
            }
        }
    }

    //validate empty on a condition
    validateEmptyOnCondition(value, fieldName, className){
        //main_value+':main_value_answer,'+sub_value+'|className|Sub Field 1 Name,Main Field Name|conditional_empty'
        let explodedValue = value.split(',');
        let mainValue = explodedValue[0].split(':');
        let explodedFieldName = fieldName.split(',');
        if(mainValue[0] === mainValue[1] && explodedValue[1] === ''){
            this.returnValidationMessage(className, explodedFieldName[0]+' is required');
            // if value for '+explodedFieldName[1]+' is provided as '+mainValue[1]
        }
    }

    //validate lenght
    validateStringLength(value, fieldName, className){
        let explodedValue = value.split(',');
        if(explodedValue[0] === ''){ return; }
        if(explodedValue[0].length > explodedValue[1]){
            this.returnValidationMessage(className, 'Total Characters for '+fieldName+' cannot exceed '+explodedValue[1]);
        }
    }

    passwordMatchValidation(passwordValues, fieldName, className){
        //['value1:value2|className|fieldName|type1']
        let explodedValue = passwordValues.split(':');
        let mainPassword = explodedValue[0].trim();
        let confirmPassword = explodedValue[1].trim();

        if(mainPassword === '' || confirmPassword === ''){
            this.returnValidationMessage(className, 'Please provide both password and password confirmation value');
            return;
        }
        if(mainPassword !== confirmPassword){
            this.returnValidationMessage(className, 'Passwords does not match');
        }
    }

    async validateImageDimensions(fileId, fieldName, className){//width: 600, height: 700

        try {
            let file = document.getElementById(fileId).files[0];
            if(typeof file == 'undefined'){
                this.returnValidationMessage(className, 'Please select image you want to use for this Ads Campaign');
                return;
            }
            const dimensions = await this.imageDimensions(file);
            if(dimensions.width <= dimensions.height){
                this.returnValidationMessage(className, 'Please use an image with landscape resolution');
            }
        } catch(error) {
            this.returnValidationMessage(className, error);
        }
    }

    async validateEmptyFileField(fileId, fieldName, className){
        //['fileId|className|fieldName|type']
        if( document.getElementById(fileId).files.length == 0 ){
            this.returnValidationMessage(className, fieldName+' is required!');
        }
    }

    async validateCheckboxCheck(fileIdPlusMessage, fieldName, className){//['fieldId,errorMessage|className|fieldName|type']
        let explodedFieldPlusMessage = fileIdPlusMessage.split(',');
        let fieldId = explodedFieldPlusMessage[0];
        let message = explodedFieldPlusMessage[1];
        if (!$("#"+fieldId).is(":checked")) {
            this.returnValidationMessage(className, message);
            return;
        }

    }

    async validateValueForCheckedCheckboxcondition(fileId1PlusMessagePlusField2, fieldName, className){
        //['fieldId1,errorMessage,fieldId2,valueToBeCheckedFor|className|fieldName|type']
        let explodedFieldPlusMessage = fileId1PlusMessagePlusField2.split(',');
        let fieldId = explodedFieldPlusMessage[0];
        let message = explodedFieldPlusMessage[1];
        let fieldId2Value = explodedFieldPlusMessage[2];
        let valueToBeCheckedFor = explodedFieldPlusMessage[3];
        if ($("#"+fieldId).is(":checked") && fieldId2Value === valueToBeCheckedFor) {
            this.returnValidationMessage(className, message);
            return;
        }

    }

    async validateVideoLength(fileIdPlusDurationPlusMessage, fieldName, className){
//['fieldID:videoDuration:errorMessage|className|fieldName|type']
        let explodedFileDetails = fileIdPlusDurationPlusMessage.split(':');
        let fileId = explodedFileDetails[0];
        let Duration = parseFloat(explodedFileDetails[1])
        let message = explodedFileDetails[3];
        let selectedFile = $('#'+fileId).prop('files');
        let fileExtensionCheck = checkIfInArray(this.checkFileExtension(fileId), ['mp4','3gp','webm','flv','avi']);
        if(selectedFile.length > 0 && fileExtensionCheck != -1){

            let videoDuration = document.getElementById(fileId).duration;
            alert(videoDuration+' '+Duration);
            if(videoDuration > Duration){
                this.returnValidationMessage(className, message);
            }
        }
    }

    async validateFileSizeVersionTwo(fileIdPlusDurationPlusMessage, fieldName, className){
        //['fieldID:fileSize:errorMessage|className|fieldName|type']
        let explodedFileDetails = fileIdPlusDurationPlusMessage.split(':');
        let fileId = explodedFileDetails[0];
        let fileSize = parseFloat(explodedFileDetails[1]);
        let message = explodedFileDetails[3];
        //get the selected file
        let selectedFile = $('#'+fileId).prop('files');

        if(selectedFile.length > 0){
            if (selectedFile[0].size > fileSize){
                this.returnValidationMessage(className, message);
                return;
            }
        }
    }

    //validate file type
    async validateFileTypes(fileIdPlusfileType, fieldName, className){
        //['fieldID:fileTye1,fileType2,fileType3...|className|fieldName|type']
        let explodedFileDetails = fileIdPlusfileType.split(':');
        let fileId = explodedFileDetails[0];
        let fileTypeArray = explodedFileDetails[1].split(',');
        //get the selected file
        let selectedFile = $('#'+fileId).prop('files');

        if(selectedFile.length > 0){
            //get the file type for the file
            let fileExtension = this.checkFileExtension(fileId);

            if(this.checkIfInArray(fileExtension, fileTypeArray) == -1){
                //get the file string value
                let stringValue = this.constructFileTypes(fileTypeArray);
                this.returnValidationMessage(className, fieldName+' can only be one of the following file types: '+stringValue);
            }
        }

    }

    returnValidationMessage(className, errorMessage){
        let error_array = [];
        if(className in this.errors){
            error_array = this.errors[className];
            error_array.push(errorMessage);
        }else{
            error_array.push(errorMessage);
        }
        this.errors[className] = error_array;
    }


    //['value|className|fieldName|type']
    async callValidator(thingsToValidate){

        //try {

        //this.errors = {};

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
                        this.validateEmpty(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                        break;
                    case 'email':
                        this.validateEmailAddress(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                        break;
                    case 'number':
                        this.validateNumber(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                        break;
                    case 'conditional_empty':
                        this.validateEmptyOnCondition(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                        break;
                    case 'value_existence_in_a_string':
                        this.validateExistenceOfAValueInaString(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                        break;
                    case 'word_length':
                        this.validateStringLength(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                        break;
                    case 'image_dimensions':
                        await this.validateImageDimensions(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                        break;
                    case 'empty_file_field':
                        await this.validateEmptyFileField(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                        break;
                    case 'image_size':
                        await this.validateFileSize(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                        break;
                    case 'password_match_validation':
                        this.passwordMatchValidation(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                        break;
                    case 'validate_checking_check':
                        this.validateCheckboxCheck(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                        break;
                    case 'validate_file_length':
                        this.validateVideoLength(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                        break;
                    case 'validate_file_size_two':
                        this.validateFileSizeVersionTwo(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                        break;
                    case 'validate_file_type':
                        this.validateFileTypes(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                        break;
                    case 'validate_empty_for_arrays':
                        this.validateEmptyForArray(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                        break;
                    case 'validate_value_depending_on_checkbox_condition':
                        this.validateValueForCheckedCheckboxcondition(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                        break;
                    case 'numeric_validation_for_array_values':
                        this.validateNumericForArray(explodedValidationDetails[0], explodedValidationDetails[2], explodedValidationDetails[1]);
                        break;
                    default:
                        alert('No Match');
                }

            }
        }

        if(Object.keys(this.errors).length > 0){
            return false;
        }
        return true;

        /*}catch (e) {
            alert(e);
        }*/

    }

    //display the error
    handleErrorStatement(error_statement, loginPage = '../login', showField = 'off', useClassForFieldFocus = 'no', useModal = 'no') {

        var counter = 0; let theKey = '', theTxt = '';
        let errorStatementLenght = Object.keys(error_statement).length;
        for(var i in error_statement){
            if(counter == 0){ theKey = i; }

            if(typeof error_statement[i] === 'string'){
                if(error_statement[i].indexOf(':') != -1){
                    error_statement[i] = error_statement[i].split(':');
                }
            }

            var txt = '';
            for(var j in error_statement[i]){

                incomingErrorArray.push(error_statement[i][j]);

                txt += "<p style='font-size:12px' class='f-size error_carrier t-color'><span >*</span> "+error_statement[i][j]+"</p>";
            }

            if(i === 'general_error'){
                if(useModal === 'yes'){
                    this.callErrorModal(txt);
                    $(".errorAreaHolder p").removeClass('t-color');
                }else{
                    returnFunctions.showSuccessToaster(txt, 'warning');
                    $(".error_carrier").removeClass('t-color');
                }

            }else{

                if(i.indexOf('.') != -1){

                    //split the value at point i
                    let mainIndex = i.split('.');
                    let mainErrorClass = mainIndex[0];
                    let currentPoint = parseFloat(mainIndex[1]);
                    let selectedMainErrorClass = $('.err_'+mainErrorClass);
                    for(let e = 0; e < selectedMainErrorClass.length; e++){
                        if(e == currentPoint){
                            $(selectedMainErrorClass[e]).html(txt).removeClass('hidden');

                            if(counter == 0){
                                let newClass = mainErrorClass+currentPoint;//create a new class from the combination of the field class and current index
                                $(selectedMainErrorClass[e]).siblings('input').addClass(newClass);//add a class to the input field
                                theKey = newClass;//reassign the key
                                useClassForFieldFocus = 'yes';
                            }
                        }
                    }
                }else{
                    if(useModal === 'yes'){
                        theTxt += txt;
                    }else{
                        $('.err_'+i).html(txt).removeClass('hidden');
                    }
                    //$('.err_'+i).html(txt).removeClass('hidden');
                }
                //show the field with the first error message
                if(parseFloat(counter) == parseFloat(errorStatementLenght - 1)){
                    if(showField === 'on'){
                        this.scrollIntoDomView(theKey, useClassForFieldFocus);
                        //returnFunctions.showSuccessToaster('Some validation errors occurred.', 'warning');
                    }
                    if(useModal === 'yes') {
                        this.callErrorModal(theTxt);
                    }
                }
                counter++;
            }

        }
        this.chckForLogout(incomingErrorArray, loginPage);
    }

    callErrorModal(error){
        $(".errorAreaHolder").html(error);
        $(".errorCarrierBox").removeClass("hidden");
        let elementHeight = $(".errorAreaHolderMain").height();
        if(elementHeight == 500){
            $(".errorCarrierBox").attr({'title':'scroll down with scroll the bar to view more errors'})
            $(".errorAreaHeadNot").removeClass('hidden');
        }
    }

    constructFileTypes(fileTypeArray){
        let stringValue = ''; let mainLen = parseFloat(fileTypeArray.length) - parseFloat(1);
        for(let i = 0; i < fileTypeArray.length; i++){
            if(mainLen == i){
                stringValue += 'or '+fileTypeArray[i]+' file';
            }else{
                stringValue += fileTypeArray[i]+' file,';
            }
        }
        return stringValue;
    }

    scrollIntoDomView(selectedElement, useClassForFieldFocus){
        let prefix = '';
        let offset = '';
        if(useClassForFieldFocus === 'no'){
            offset = $("#"+selectedElement).offset(); // Contains .top and .left
            prefix = '#';
        }else{
            offset = $("."+selectedElement).offset(); // Contains .top and .left
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
        $(prefix+selectedElement).focus();

    }

    chckForLogout(incomingErrorArray){
        if(this.checkIfInArray('Please Login to continue', incomingErrorArray) != -1){
            setTimeout(async function () {
                //get the user details
                let userType = await getRequest('../getTypeOfUser.php?get_user_type');
                let typeOfUser	= userType.typeOfUser;
                let page = typeOfUser === 'dev' ? '../adminLogin':'../login';
                window.location.href = page;
            }, 2000)
        }
    }

    //check if a value is a n array
    checkIfInArray(theValue, theArray){
        return jQuery.inArray(theValue, theArray);

    }

    //get file extension
    checkFileExtension(fileId) {
        let fileName = document.querySelector('#'+fileId).value;
        let extension = fileName.substring(fileName.lastIndexOf('.') + 1);
        return extension.toLowerCase();
    };

    emailValidator(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    imageDimensions(file){

        return new Promise(function (resolve, reject) {

            const img = new Image();

            // the following handler will fire after the successful loading of the image
            img.onload = () => {
                const { naturalWidth: width, naturalHeight: height } = img;
                resolve({ width, height })
            }

            // and this handler will fire if there was an error with the image (like if it's not really an image or a corrupted one)
            img.onerror = () => {
                reject('There was some problem with the image, its either corrupted or not an image file.')
            }

            img.src = URL.createObjectURL(file)

        });
    }

    // here's how to use the helper
    //{ target: { files } }
    async getImageInfo(file){
        //const [file] = files
        try {
            const dimensions = await this.imageDimensions(file);
            return {error_code:0, data:dimensions};
        } catch(error) {
            return {error_code:1, error:error}
        }
    }

}
