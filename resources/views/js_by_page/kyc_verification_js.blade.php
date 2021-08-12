<script>

    async function verificationRequest(a, action, unique_id) {

        let retVal = confirm('Do you wish to continue');
        if(retVal === true){
            $(a).text('Loading...').attr({'disabled':true});

            let postData = await postRequest(baseUrl+"api/KYCVerificationHandler", {action:action, unique_id:unique_id});
            let {error_code, success_statement, error_message} = postData;
            if(error_code == 0){
                $(a).text('Redirecting ....').attr({'disabled':false});
                showValidatorToaster(success_statement, 'success');
                setTimeout(function () {
                    window.location.href = baseUrl+'verify_kyc';
                }, 1000);
            }else {
                showValidatorToaster(error_message, 'warning');
                setTimeout(function () {
                    window.location.href = baseUrl+'verify_kyc';
                }, 1000);
            }
        }

    }
</script>
