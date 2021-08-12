<script>
    let baseUrl = 'http://127.0.0.1:8000/';

    //chenge the url of a page without reloading the page
    function goTo(page, title, url) {
        if ("undefined" !== typeof history.pushState) {
            history.pushState({page: page}, title, url);
        } else {
            window.location.assign(url);
        }
    }

    function thePostRequest(url, params){

        return new Promise(function (resolve, reject) {

            $.ajaxSetup({
                headers:{
                    'Source': "web"
                }
            });

            $.post(url, params, function (data, status, jqXHR) {
                if(status === 'success'){
                    resolve(data)
                }else{
                    reject(status)
                }
            }).fail(function(error) {//statusText: "Method Not Allowed"
                displayNetWorkError( 'A Network Error was encountered, message: ``'+error.statusText+'`` was returned. Please contact system administrator.' );
            })

        })
    }

    function theGetRequest(url){

        return new Promise(function (resolve, reject) {

            $.ajaxSetup({
                headers:{
                    'Source': "web"
                }
            });

            $.get(url, function (data, status) {
                if(status === 'success'){
                    resolve(data)
                }else{
                    reject(status)
                }
            }).fail(function(error) {//statusText: "Method Not Allowed"
                displayNetWorkError( 'A Network Error was encountered, message: ``'+error.statusText+'`` was returned. Please contact system administrator.' );
            })
        })
    }

    function displayNetWorkError(message) {
        swal.fire("ERROR!", message, "error");
    }

    function displaySuccessModal(message) {
        swal.fire("SUCCESS!", message, "success");
    }

    function thePostRequestData(url, params) {

        return new Promise(function (resolve, reject) {

            $.ajaxSetup({
                headers:{
                    'Source': "api"
                }
            });

            $.ajax({
                url: url,
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: params,
                type: 'post',
                success: function(response){
                    resolve(response);
                },
                error: function (XMLHttpRequest, textStatus, error) {

                    swal.fire("ERROR!", 'A Network Error was encountered, Please contact system administrator', "error");
                    //reject(error);
                }
            });

        })

    }
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>