function checkAll() {
    if($(".mainCheckBox").is(':checked')){
        $(".smallCheckBox").prop('checked', true);
    }else{
        $(".smallCheckBox").prop('checked', false);
    }
}

//show a modal
/*
function bringOutModalMain(value) {
    //$(value).removeClass('hidden');
    $(value).modal('show');
}
*/

//remove a selected field
function removeRewardField(a, selected){
    $(a).closest(selected).remove();
}



//const successDisplay = (message) => swal(message, 'successful', 'success');

const successNoty = (message) => swal(message, 'successful', 'success');

const failJson = ({ responseJSON: response }) => {
    errorDisplay(`${response.error.message}`)
};

//every thing copy
var clipboard = new ClipboardJS('.copybtn');

clipboard.on('success', function(e) {
    successDisplay('Copied!!!');

    /*e.clearSelection();*/
});

clipboard.on('error', function(e) {
    errorDisplay('Copy failed');
});

//generics

function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
    try {
        decimalCount = Math.abs(decimalCount);
        decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

        const negativeSign = amount < 0 ? "-" : "";

        let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
        let j = (i.length > 3) ? i.length % 3 : 0;

        return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
    } catch (e) {
        console.log(e)
    }
}


//support update
$(document).ready(function () {
    supportNotifier();
})

async function supportNotifier() {

    //
    let postData = await theRequestHandler.getRequest(RequestHandler.BaseUrl+"get_support_notification");

    let {count} = postData;

    $(".notifier_class").html(`<i class="icon nalika-chat icon-wrap"></i> <span class="mini-click-non">Support <sup class="badge-info badge" style="color:white;">${count}</sup></span>`);

}