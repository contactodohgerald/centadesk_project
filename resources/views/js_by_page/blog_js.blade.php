<script>
    $(document).ready(function () {
        //bringoutSelect2('.tags-select2', 10, 'Please Select');

        //initialize tinymce text editor
        tinymce.init({
            selector: 'textarea#message',
            plugins: ['link preview anchor'],
            height: 400,
        });

        $('.btn_add').click(function(e) {
            e.preventDefault();
            let new_url = `<div id="" class="ui-accordion ui-widget ui-helper-reset">
                                    <a href="javascript:void(0)" class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
                                        <div class="section-header-left">
                                            <span class="section-title-wrapper">
                                                <span class="ui left icon input swdh19">
                                                    <input class="prompt srch_explore" type="text" placeholder="Enter Blog Tag" name="blog-tag">
                                                </span>
                                            </span>
                                        </div>
                                    </a>
                                </div>`;
            $(new_url).appendTo('.download_urls');
        });

        // process form for creating course
        $('#save_blog_tag').click(async function(e) {
            e.preventDefault();
            // download urls
            let url_array = [];
            let url = $('.download_urls').serializeArray();
            url.forEach(e => {
                url_array.push(e.value);
            });

            let postData = await postRequest(baseUrl+"api/store-blog-tags", {tags:url_array});
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

        // create image thumbnail on select
        $('#cover_img').change(function (e) {
            e.preventDefault();
            let cover_img = $('#cover_img').prop('files')[0];
            display_img_thumbnail(this,'thumbnail_cover_img');
        });

        // process form for creating course
        $('.add-new-blog').click(async function(e) {
            e.preventDefault();
            let data = [];
            let title = $('#title').val();
            data.push({
                name: "title",
                value: title
            });
            let tags = $('#tags').val();
            data.push({
                name: "tags",
                value: tags
            });
            let desc = tinymce.get("message").getContent();
            data.push({
                name: "desc",
                value: desc
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
            let postData = await ajaxRequest(baseUrl+"api/addNewBlog", form_data);
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

        $("#confirm_blog_post").click(async function confirmBlogPosts(a) {
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
                    $(this).text('Confirm Blog Post').attr({'disabled':false});
                    errorDisplay('Please select at least one blog post to continue');
                    return;
                }

                let postData = await postRequest(baseUrl+'api/confirmBlogPost', {dataArray:dataArray.join('|')});
                let {error_code, success_statement, error_message} = postData;
                if(error_code == 0){
                    $(this).text('Confirm Blog Post').attr({'disabled':false});
                    showValidatorToaster(success_statement, 'success');
                    setTimeout(function () {
                        location.reload();
                    }, 2000)
                }else{
                    $(a).text('Confirm Blog Post').attr({'disabled':false});
                    showValidatorToaster(error_message, 'success');
                }
            }

        });
    });
</script>
