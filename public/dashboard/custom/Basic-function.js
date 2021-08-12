// num_suffix   // setLoader   // remv_loader   // postRequest  // throwSweetalert    // getKeyByValue    // return_element_key_in_array  // ajaxRequest    // throw_snackbar   // append_id   // display_img_thumbnail

// let snack_options = {
//     message: "Error! Bitcoin Wallet Address already exist.",
//     width: "600px",
//     fixed: true,
//     status: "warning", // success | warning | danger | info
//     timeout: 5000, // ms
//     dismissible: true, // can be configured to hide its close button
//     position: "br", // "tl","tc","tr","bl", "bc", "br"
// };

function throw_snackbar(message, status) {
    SnackBar({
        message: message,
        width: "400px",
        fixed: true,
        status: status, // success | warning | danger | info
        timeout: 5000, // ms
        dismissible: true, // can be configured to hide its close button
        position: "tr", // "tl","tc","tr","bl", "bc", "br"
    });

}

function loader_set() {
    // $("#the_load_screen").animate({ opacity: '0.2' });
    $('#the_load_screen').removeAttr('style');
}
function loader_rmv() {
    $('#the_load_screen').attr('style', 'display:none');
}

function num_suffix(i) {
    var j = i % 10,
        k = i % 100;
    if (j == 1 && k != 11) {
        return i + "st";
    }
    if (j == 2 && k != 12) {
        return i + "nd";
    }
    if (j == 3 && k != 13) {
        return i + "rd";
    }
    return i + "th";
}
function set_form_data(object) {
    let form_data = new FormData();
    object.forEach(e => {
        form_data.append(e.name, e.value);
    });
    return form_data;
}

function setLoader() {
    // $('.loader').attr('style', 'display:block');
    // setTimeout(() => {
    $('.loader').show();
    $(".loader").animate({ opacity: '1' });
    // }, 1000);

}

function remvLoader() {
    $(".loader").animate({ opacity: '0.2' });
    setTimeout(() => {
        $('.loader').removeAttr('style');
    }, 500);

}

// former postRequest funtion was having a problem with formData
function ajaxRequest(url, data) {
    loader_set();
    return new Promise(function (resolve, reject) {

        $.ajax({
            type: "post",
            url: url,
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                loader_rmv();
                resolve(response);
            }
        });
    })
}


/*function postRequest(url, params) {
    setLoader();
    return new Promise(function (resolve, reject) {

        $.post(url, params, function (data, status) {

            if (status === 'success') {
                remvLoader();
                resolve(data)
            } else {
                remvLoader();
                reject(status)
            }
        })

    })
}*/
function throwSweetalert(returned, page_redirect, allow_redirect) {
    if (returned.error == 1) {
        // swal('Sorry',returned.msg,'error');
        swal({
            title: 'Sorry',
            text: returned.msg,
            type: 'error',
            padding: '2em'
        })
    } else if (returned.error == 0) {
        if (allow_redirect == 1) {
            // swal('Congratulations',returned.msg,'success');
            swal({
                title: 'Congratulations',
                text: returned.msg,
                type: 'success',
                padding: '2em'
            })
            setTimeout(() => {
                window.location.href = page_redirect;
            }, 2000);
        }
    }
}

function throwToastr(returned, page_redirect, allow_redirect) {
    if (returned.error == 1) {
        // swal('Sorry',returned.msg,'error');

        toastr.error(msg)
    } else if (returned.error == 0) {
        if (allow_redirect == 1) {
            // swal('Congratulations',returned.msg,'success');

            toastr.success(returned.msg)
            setTimeout(() => {
                window.location.href = page_redirect;
            }, 2000);
        }
    }
}
function getObjKeyByValue(object, value) {
    for (var prop in object) {
        if (object.hasOwnProperty(prop)) {
            if (object[prop] === value)
                return prop;
        }
    }
}
function return_element_key_in_array(array, val_exist) {
    for (let i = 0; i < array.length; i++) {
        if (array[i] == val_exist) {
            return i;
        } else {
            return 0;
        }
    }

}

function validator(returned, page_redirect) {
    loader_set();
    if (returned.status == true) {

        loader_rmv();
        throw_snackbar(returned.message, 'success');
        window.scrollTo({ top: 0, behavior: 'smooth' });
        setTimeout(() => {
            window.location.href = page_redirect;
        }, 2000);

    } else {

        loader_rmv();
        for (var key in returned.errors) {
            let error = returned.errors[key];
            if (error.length == 1) {
                throw_snackbar(returned.errors[key], 'error');
            } else if (error.length > 1) {
                error.forEach(e => {
                    throw_snackbar(e, 'error');
                })
            }
        }
        // window.scrollTo({ top: 0, behavior: 'smooth' });

    }
}
function youtube_regex(url) {
    var regExp = /^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    var match = url.match(regExp);
    if (match && match[2].length == 11) {
        return match[2];
    } else {
        return false;
    }
}

function display_img_thumbnail(input, element_id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#' + element_id).attr('src', e.target.result);
        }
        // convert to base64 string
        reader.readAsDataURL(input.files[0]);
    }
}


function append_id(name, append_to, modal, this_) {
    /*
    name=>form_field name
    append_to => name of input_field
    modal => selector of modal
    */

    let input_id = $(this_).attr('id');
    let input_field = `<input type="hidden" value="${input_id}" name="${name}">`;
    $(input_field).appendTo(append_to);
    console.log(input_id);
    // $(modal).modal('toggle');
}
