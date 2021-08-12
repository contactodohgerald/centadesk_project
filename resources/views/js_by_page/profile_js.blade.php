<script>

    async function instructorsComment(a, instructor_id){
        $(a).text('Loading.....').attr({'disabled':true});

        let comment = $("#comments_hold").val();

        if (comment === ''){
            $(a).text('Comment').attr({'disabled':true});
            showValidatorToaster('Comment Field is empty, try inputting a comment before continuing', 'warning');
            return;
        }

        let postData = await postRequest(baseUrl+'api/createInstructorComment', {comment:comment, instructor_id:instructor_id, user_id:userUniqueId});
        let {error_code, success_statement, error_message} = postData;
        if(error_code == 0){
            $(a).text('Comment').attr({'disabled':false});
            showValidatorToaster(success_statement, 'success');
            setTimeout(function () {
                location.reload();
            }, 1000)
        }else{
            $(a).text('Comment').attr({'disabled':false});
            showValidatorToaster(error_message, 'warning');
        }
    }

    async function replyInstructorsComment(a, main_comment_id){
        let comment = prompt('Reply to a comment');
        if (comment != null){
            $(a).text('Loading.....').attr({'disabled':true});

            let postData = await postRequest(baseUrl+'api/replyInstructorComment', {comment:comment, main_comment_id:main_comment_id, user_id:userUniqueId});
            let {error_code, success_statement, error_message} = postData;
            if(error_code == 0){
                $(a).text('Reply').attr({'disabled':false});
                showValidatorToaster(success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 1000)
            }else{
                $(a).text('Reply').attr({'disabled':false});
                showValidatorToaster(error_message, 'warning');
            }
        }
    }

    async function likeAndDislikeMainReview(a, action, main_review_id) {
        let postData = await postRequest(baseUrl+'api/processReviewLikeStatus', {main_review_id:main_review_id, user_unique_id:userUniqueId, action:action});
        let {error_code, success_statement, error_message} = postData;
        if(error_code == 0){
            showValidatorToaster(success_statement, 'success');
            if (action === 'like'){
                $(a).addClass('text-danger')
            }else {
                $(a).addClass('text-danger')
            }
        }else{
            showValidatorToaster(error_message, 'warning');
        }

    }
</script>
