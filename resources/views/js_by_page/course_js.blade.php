
<script>

    $(document).ready(function (){
        let course_id = $(".course_unique_id").val();

        getRatings(course_id, userUniqueId, '#rate');

        getRatingsForView(course_id)

    })

    async function getRatings(course_id, user_unique_id, location){

        let returnData = await getRequest(baseUrl+'api/getAllReviews/'+course_id);

        let {data, error_code} = returnData;

        if (error_code == 0){

            let ratings = returnRating(data, user_unique_id);

            $(location).html(courseRatingHtml('empty-star', 'full-star', ratings, course_id));

        }

    }

    async function getRatingsForView(course_id){
        let dataHold = '', ratings = [], user_array = [];
        let returnData = await getRequest(baseUrl+'api/getAllCourses/'+course_id);
        let {data, error_code} = returnData;

        if (error_code == 0){

            let {reviews} = data;

            if (reviews.length > 0){
                for (let i = 0; i < reviews.length; i++){

                    let {rating, review_message, user_unique_id, created_at, users} = reviews[i];

                    ratings.push(rating);

                    user_array.push(user_unique_id);

                    dataHold += `<div class="review_item">
                                    <div class="review_usr_dt">
                                        <img src="images/left-imgs/img-1.jpg" alt="user">
                                        <div class="rv1458">
                                            <h4 class="tutor_name1">${capitalizeFirstLetter(users.name)} ${capitalizeFirstLetter(users.last_name)}</h4>
                                            <span class="time_145">${moment(created_at, "YYYYMMDD").fromNow()}</span>
                                        </div>
                                    </div>
                                    <div class="rating-box mt-20">
                                        ${courseRatingHtmlForView('empty-star', 'full-star', rating)}
                                    </div>
                                    <p class="rvds10">${review_message}</p>
                                </div>`;
                }
            }else {
                dataHold += `<div class="alert alert-danger text-center">NO Review For This Course</div>`;
            }

            let sum = 0;
            for (var len = 0; len < ratings.length; len++){
                sum = parseFloat(ratings[len]) + parseFloat(sum);
            }

            let calculate = parseFloat(sum)/user_array.length

            let sumRatingHold = `<i class="uil uil-star"></i>${calculate}`

            let totalRate = ` ${courseRatingHtmlForView('empty-star', 'full-star', Math.floor(calculate))}`

            $('.rating_ratio').html(sumRatingHold);

            $(".reviewHold").html(dataHold);

            $('.total_rating').html(totalRate)

        }

    }

    async function activateCoursesStatus(a) {
        let retVal = confirm('Do you wish to continue?');
        if(retVal === true){
            $(a).text('Loading.....').attr({'disabled':true});
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){

                    dataArray.push($(selected[i]).val());
                }
            }

            if(dataArray.length == 0){
                $(a).text('Confirm Courses Status').attr({'disabled':false});
                errorDisplay('Please select at least one course to continue');
                return;
            }

            let postData = await postRequest(baseUrl+'api/activateCoursesStatus', {dataArray:dataArray.join('|')});
            let {error_code, success_statement, error_message} = postData;
            if(error_code == 0){
                $(a).text('Confirm Courses Status').attr({'disabled':false});
                showValidatorToaster(success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 2000)
            }else{
                $(a).text('Confirm Courses Status').attr({'disabled':false});
                showValidatorToaster(error_message, 'warning');
            }
        }

    }

    async function saveCourse(course_id, user_id) {
        let postData = await postRequest(baseUrl+'api/saveCourse', {course_unique_id:course_id, user_unique_id:user_id});
        let {error_code, success_statement, error_message} = postData;
        if(error_code == 0){
            showValidatorToaster(success_statement, 'success');
            $('.uil-heart').addClass('text-danger')
            // setTimeout(function () {
            //     location.reload();
            // }, 5000)
        }else{
            //errorDisplay(error_message);
            //showSuccessToaster(error_message, 'warning')
            showValidatorToaster(error_message, 'warning');
        }

    }

    async function deleteSavedCourse(a, action) {
        let retVal = confirm('Do you wish to Remove Course?');
        if(retVal === true){
            $(a).text('Loading.....').attr({'disabled':true});
            let selected = $(".saved_course_id").val();

            let postData = await postRequest(baseUrl+'api/removeSavedCourse', {saved_course_id:selected, user_unique_id:userUniqueId, action:action});
            let {error_code, success_statement, error_message} = postData;
            if(error_code == 0){
                $(a).text('Saved Course Removed').attr({'disabled':false});
                showValidatorToaster(success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 2000)
            }else{
                $(a).text('Remove').attr({'disabled':false});
               // errorDisplay(error_message);
                showValidatorToaster(error_message, 'warning');
            }
        }

    }

    async function likeAndDislikeCourse(action) {

        let course_id = $(".course_unique_id").val();

        let postData = await postRequest(baseUrl+'api/processCourseLikeStatus', {course_unique_id:course_id, user_unique_id:userUniqueId, action:action});
        let {error_code, success_statement, error_message} = postData;
        if(error_code == 0){
            showValidatorToaster(success_statement, 'success');
            if (action === 'like'){
                $('.uil-thumbs-up').addClass('text-danger')
            }else {
                $('.uil-thumbs-down').addClass('text-danger')
            }
        }else{
            //errorDisplay(error_message);
            showValidatorToaster(error_message, 'warning');
        }

    }

    function addAnime(a) {
        $(a).addClass('full-star')
    }
    function removeAnime(a) {
        $(a).removeClass('full-star')
        $(a).addClass('empty-star')
    }

    //generate the course rating html
    function courseRatingHtml(btnGrey = 'empty-star', btnWarning = 'full-star', rating = 0, course_id) {
            return `
            <span class="row">
            <div class="col-sm-12" >
                <form method="POST">
                     <span class="form-group">
                        <span data-rating-number="1" onclick="rateCourseFunction(this)" onmouseenter="addAnime(this)" onmouseout="removeAnime(this)" title="rate this course" class="rating-star main-star  ${(parseFloat(rating) >= parseFloat(1)) ? btnWarning: btnGrey} " aria-hidden="true"></span>
                        <span data-rating-number="2" onclick="rateCourseFunction(this)" onmouseenter="addAnime(this)" onmouseout="removeAnime(this)" title="rate this course" class="rating-star main-star  ${parseFloat(rating) >= parseFloat(2) ? btnWarning: btnGrey}" aria-hidden="true"></span>

                        <span data-rating-number="3" onclick="rateCourseFunction(this)" onmouseenter="addAnime(this)" onmouseout="removeAnime(this)" title="rate this course"  class="rating-star main-star ${parseFloat(rating) >= parseFloat(3) ? btnWarning: btnGrey}" aria-hidden="true"></span>

                        <span data-rating-number="4" onclick="rateCourseFunction(this)" onmouseenter="addAnime(this)" onmouseout="removeAnime(this)" title="rate this course" class="rating-star main-star ${parseFloat(rating) >= parseFloat(4) ? btnWarning: btnGrey}" aria-hidden="true"></span>

                        <span data-rating-number="5" onclick="rateCourseFunction(this)" onmouseenter="addAnime(this)" onmouseout="removeAnime(this)" title="rate this course" class="rating-star main-star ${parseFloat(rating) >= parseFloat(5) ? btnWarning: btnGrey}" aria-hidden="true"></span>

                        <input type="hidden" class="form-control rating" name="rating" value="${rating === 0 ? 0 : rating}">
                        <input type="hidden" class="form-control courseUniqueId" name="itemId" value="${course_id}">
                        </span>
                </form>
            </span>
        </span>
         `
        }

    //generate the course rating html
    function courseRatingHtmlForView(btnGrey = 'empty-star', btnWarning = 'full-star', rating = 0) {
        return `
           <span class="form-group">
                        <span title="rate this course" class="rating-star main-star  ${(parseFloat(rating) >= parseFloat(1)) ? btnWarning: btnGrey} " aria-hidden="true"></span>
                        <span title="rate this course" class="rating-star main-star  ${parseFloat(rating) >= parseFloat(2) ? btnWarning: btnGrey}" aria-hidden="true"></span>

                        <span title="rate this course"  class="rating-star main-star ${parseFloat(rating) >= parseFloat(3) ? btnWarning: btnGrey}" aria-hidden="true"></span>

                        <span title="rate this course" class="rating-star main-star ${parseFloat(rating) >= parseFloat(4) ? btnWarning: btnGrey}" aria-hidden="true"></span>

                        <span title="rate this course" class="rating-star main-star ${parseFloat(rating) >= parseFloat(5) ? btnWarning: btnGrey}" aria-hidden="true"></span>
                        </span>
         `
    }

    function returnRating(ratingArray, user_unique_id){
        let rate = 0;
        if(user_unique_id === null){
            rate = 0;
        }else{
            if(ratingArray.length > 0){
                for(let i in ratingArray){
                    if(ratingArray[i].user_unique_id == user_unique_id){
                        rate = ratingArray[i].rating;
                        break;
                    }else{
                        rate = 0;
                    }

                }
            }else{
                rate = 0;
            }
        }
        return rate;

    }

    async function rateCourseFunction(a){
        let retVal = prompt('Write a Review');
        if (retVal != null){

            //check for login
            if(userUniqueId === null){
                errorDisplay('Please Login First, to continue');
                return;
            }

            $(a).closest('.form-group').find('.main-star').addClass('empty-star');//add the grey button on all the rating buttons
            $(a).closest('.form-group').find('.main-star').removeClass('full-star stopHere');//remove warning button from all the rate button
            let allButton = $(a).closest('.form-group').find('.main-star');
            $(a).addClass('stopHere');//add a mark on the button where the user clicked
            //let rating =
            for(let i = 0; i < allButton.length; i++){//loop through all the rating buttons
                $(allButton[i]).removeClass('empty-star');
                $(allButton[i]).addClass('full-star');
                if($(allButton[i]).hasClass('stopHere')){
                    let courseUniqueId = $(allButton[i]).siblings('.courseUniqueId').val();
                    let rating = $(allButton[i]).attr('data-rating-number');
                    let postData = await postRequest(baseUrl+'api/storeReview', {userId:userUniqueId, courseId:courseUniqueId, message:retVal, rating:rating});
                   let {error_code, success_statement, error_message} = postData;
                    if(error_code == 0){
                        showValidatorToaster(success_statement, 'success');
                        setTimeout(function () {
                            location.reload();
                        }, 1000)
                    }else{
                       // errorDisplay(error_message);
                        showValidatorToaster(error_message, 'warning');
                    }
                    break;
                }
            }
        }
    }

    async function deleteCourse(a) {
        let retVal = confirm('Do you wish to continue?');
        if(retVal === true){
            $(a).text('Loading.....').attr({'disabled':true});
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){

                    dataArray.push($(selected[i]).val());
                }
            }

            if(dataArray.length == 0){
                $(a).text('Delete Courses').attr({'disabled':false});
                errorDisplay('Please select at least one course to delete');
                return;
            }

            let postData = await postRequest(baseUrl+'api/delete-course', {dataArray:dataArray.join('|')});
            let {error_code, success_statement, error_message} = postData;
            if(error_code == 0){
                $(a).text('Delete Courses').attr({'disabled':false});
                showValidatorToaster(success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 2000)
            }else{
                $(a).text('Delete Courses').attr({'disabled':false});
                showValidatorToaster(error_message, 'warning');
            }
        }

    }

</script>
