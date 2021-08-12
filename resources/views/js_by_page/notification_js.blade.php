<script>

//delete selected notification
$(document).on('click', '#deleteNotification', function(){
    deleteSelectedNotification();
})


async function deleteSelectedNotification() {

    let retVal = confirm('Do you wish to continue?');
    if(retVal === true){
        let selected = $(".smallCheckBox");
        let dataArray = [];
        for(let i = 0; i < selected.length; i++){
            if($(selected[i]).is(':checked')){

                dataArray.push($(selected[i]).val());
            }
        }

        if(dataArray.length == 0){
            errorDisplay('Please select at least one Notification to continue');
            return;
        }
        
        let postData = await postRequest(baseUrl+'api/deletNotification', {dataArray:dataArray.join('|')});
        let {error_code, success_statement, error_message} = postData;
        if(error_code == 0){
            showValidatorToaster(success_statement, 'success');
            setTimeout(function () {
                location.reload();
            }, 1000)
        }else {
            showValidatorToaster(error_message, 'warning');
        }
    }

}




</script>