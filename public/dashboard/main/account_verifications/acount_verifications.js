
$( document ).ready(function() {
    var banks = getBanks();

    $("#banks_user").html(banks);
    $("#banks_user").css({
        'width':'100% !important',
        'height':'300px !important'
    });
    //$('select').niceSelect();
    /*$('#banks_user').select2({
        width: 'resolve' // need to override the changed default
    });*/

    $("#add_bank").click(function(e){
        e.preventDefault();
        var bank = $('#banks_user').val();
        // Nice Select JS

        var accountNumber = $('#account_number_user').val();

        if(bank === ""){
            errorDisplay("Please choose your bank");
            return;
        }

        if(accountNumber === ""){
            errorDisplay("Please enter account number");
            return;
        }

        var fd = new FormData();
        fd.append('bank_user', bank);
        fd.append('account_number_user', accountNumber);
        $.ajax({
            url:verifyUrl,
            data: fd,// the formData function is available in almost all new browsers.
            type:"POST",
            contentType:false,
            processData:false,
            cache:false,
            dataType:"json", // Change this according to your response from the server.
            error:function(err){
                console.error(err);
                console.log(err);
                errorDisplay("Error occurred while verifying, please check your account number and bank detail again, contact the administrators if this continues")
            },
            success:function(response){
                if(response === "failed"){
                    errorDisplay("Error occured while verifying, please try again or contact the administrators if this continues");
                    return;
                }
                var info = JSON.parse(response);
                if(info.error === true){
                    errorDisplay(info.message);
                    return;
                }
                var bankInfo = info[0];
                $("#bank_code").val(bankInfo.bank_code);
                $("#bank").val(bankInfo.bank_name)
                $("#account_number").val(bankInfo.account_number);
                $("#account_name").val(bankInfo.account_name);
                var htmlInfo = `<p class='alert alert-success'>Bank Name: ${bankInfo.bank_name}<br/>Account Name: ${bankInfo.account_name}<br/>Account Number: ${bankInfo.account_number} </p>`;
                $("#bank_info").html(htmlInfo);
                successDisplay("Bank account verified successfully")
                $("#add_bank").html('VERIFY BANK');
                $('#save').attr("disabled", false);

            },
            beforeSend:function(){
                $("#add_bank").html('Verifying account info...');
                $('#save').attr("disabled", true);
            },
            complete:function(){
                // console.log("Request finished.");
                $("#add_bank").html('VERIFY BANK');
            }
        });
    });

    $("#save").click(function(e){
        e.preventDefault();
        var bank = $('#bank').val();
        var accountNumber = $('#account_number').val();
        var bankCode = $('#bank_code').val();
        var accountName = $('#account_name').val();
        // var fd = $('#bank_form').serialize();
        var fd = new FormData();
        fd.append('bank', bank);
        fd.append('bank_code', bankCode);
        fd.append('account_number', accountNumber);
        fd.append('account_name', accountName);
        $.ajax({
            url:addBankUrl,
            data: fd,// the formData function is available in almost all new browsers.
            type:"POST",
            contentType:false,
            processData:false,
            cache:false,
            dataType:"json", // Change this according to your response from the server.
            error:function(err){
                errorDisplay("Error occured while adding your bank information, please try again or contact the administrators if this continues, possible error: ");
            },
            success:function(response){

                if(response.status == 1){
                    successDisplay("Bank account added successfully")
                    //redirect user to dashboard
                    window.location.href=homeUrl;
                }else{
                    $("#add_bank").html('VERIFY BANK');
                    $('#save').html('Save and Continue');
                    errorDisplay("Error occurred while adding your bank information, please try again or contact the administrators if this continues,");

                }

            },
            beforeSend:function(){
                $('#save').attr("disabled", true);
                $("#save").html('Saving account info...');

            },
            complete:function(){
                // console.log("Request finished.");
                $("#add_bank").html('VERIFY BANK');
                $('#save').attr("disabled", false).html('Save and Continue');
            }
        });
    });

});