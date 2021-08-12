<script>

    async function verifyToken(a){
    
        let token = $(a).val().trim();
       
        if(token.length == 6){
    
            $(a).attr({'disabled':true});
    
            let token_ = $(a).val();//token_ 
            let email = $("#email_check").val();
    
            let validate = await validationModule.callValidator([
                token_+'|token_|Token|empty',
            ]);
            if(validate.status === false){
                validationModule.handleErrorStatement(validate.message);
                return;
            }
    
            let verifyToken = await thePostRequest(baseUrl+'api/verify_token', {token_:token_, email:email});
            let {status, success_message, error_message} = verifyToken;
    
            if (status === false) {
                $(a).attr({'disabled':false});
                swal.fire("ERROR!", error_message, "error");
                $(".show_after_token_confirm").addClass('hidden');
                return ;
            }
    
            if (status === true){
                $('.show_before_token_confirm').addClass('hidden');
                $(".show_after_token_confirm").removeClass('hidden');
                goTo('Password Reset', 'Password Reset', baseUrl+'/reset-password-area/'+email+'/'+'change');
                
            }
    
        }
    
    }
    //send_reset_password_text
    
    async function sendResetPasswordText(){
        
        let email = $("#email_check").val();
    
        let verifyToken = await theGetRequest(baseUrl+'api/send_reset_password_text/'+email);
        
        let {status, error_message, success_message, data:theUrl} = verifyToken;
    
        if (status === false) {
            swal.fire("ERROR!", error_message, "error");
            return;
        }
    
        if (status === true){
        
            $.ajax({
                type: 'POST',
                crossDomain: true,
                dataType: 'jsonp',
                headers: {
                        'Access-Control-Allow-Origin': 'https://www.bulksmsnigeria.com',
                        'X-Content-Type-Options':'nosniff',
                        'Content-Type':'application/json'
                },
                url: theUrl,
                success:function(jsondata){
                    console.log(jsondata);
                }
            })
        }
    
    }
    sendResetPasswordText();
    
    
    async function ResetPassword(a){
        let mainText = $(a).html();
        let email = $("#email_check").val();
        let password = $("#password_").val();
        let password_confirmation = $("#password_confirmation_").val();
    
        let validate = await validationModule.callValidator([
            password+'|password|Password|empty',
            password_confirmation+'|password_confirmation|Confirm Password|empty',
        ]);
        if(validate.status === false){        
            validationModule.handleErrorStatement(validate.message);
            return;
        }
    
        $(a).html('Loading....').attr({'disabled':true});
        let changePassword = await thePostRequest(baseUrl+'api/change_user_password', {email:email, password:password, password_confirmation:password_confirmation});
        let {status, success_message, error_message} = changePassword;
    
        if (status === false) {
            $(a).html(mainText).attr({'disabled':false});
            swal.fire("ERROR!", error_message, "error");
            return;
        }
    
        if (status === true){
            $(a).html(mainText).attr({'disabled':false});
            swal.fire("Success!", success_message, "success");
            setTimeout(function(){
                window.location.href = '{{route('login', ['signin'])}}'
            }, 1000)
        }
    
    }
    
    </script>