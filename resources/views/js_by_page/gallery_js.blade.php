<script>

// create image thumbnail on select
$('#cover_img').change(function (e) {
    e.preventDefault();
    let cover_img = $('#cover_img').prop('files')[0];
    display_img_thumbnail(this,'thumbnail_cover_img');
});

 // process form for creating course
 $('.add-new-gallery').click(async function(e) {
            e.preventDefault();
            let data = [];
            let title = $('#title').val();
            data.push({
                name: "title",
                value: title
            });
          
            let cover_img = $('#cover_img').prop('files')[0];
            data.push({
                name: "cover_img",
                value: cover_img
            });
            data.push({
                name: "userUniqueId",
                value: userUniqueId
            });

            let form_data = set_form_data(data);
            let postData = await ajaxRequest(baseUrl+"api/addNewGallery", form_data);
            let {error_code, success_statement, error_message} = postData;
            if(error_code == 0){
                showValidatorToaster(success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 1000)
            }else {
                showValidatorToaster(error_message, 'warning');
            }
        });

        $("#delete_gallery").click(async function confirmBlogPosts(a) {
            a.preventDefault();
            let retVal = confirm('Do you wish to continue?');
            if(retVal === true){
                $(this).text('Loading.....').attr({'disabled':true});
                let selected = $(".smallCheckBox");
                let dataArray = [];
                for(let i = 0; i < selected.length; i++){
                    if($(selected[i]).is(':checked')){

                        dataArray.push($(selected[i]).val());
                    }
                }
                if(dataArray.length == 0){
                    $(this).text('Delete Gallery/Event').attr({'disabled':false});
                    errorDisplay('Please select at least one gallery to continue');
                    return;
                }

                let postData = await postRequest(baseUrl+'api/deleteGallery', {dataArray:dataArray.join('|')});
                let {error_code, success_statement, error_message} = postData;
                if(error_code == 0){
                    $(this).text('Delete Gallery/Event').attr({'disabled':false});
                    showValidatorToaster(success_statement, 'success');
                    setTimeout(function () {
                        location.reload();
                    }, 2000)
                }else{
                    $(a).text('Delete Gallery/Event').attr({'disabled':false});
                    showValidatorToaster(error_message, 'success');
                }
            }

        });


</script>