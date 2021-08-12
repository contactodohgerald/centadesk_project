async function assignRoles(a, option) {
    let mainText = $(a).html();
    try {


        let retVal = confirm('Do you really want to assign selected roles to users');
        if(retVal === true){
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){
                    dataArray.push($(selected[i]).val());
                }
            }

            $(a).html('Loading...').attr({'disabled':true});

            if(dataArray.length == 0){
                //returnFunctions.showSuccessToaster('Please select at least Role to continue', 'warning');
                errorDisplay('Please select at least one role to continue');
                $(a).html(mainText).attr({'disabled':false});
                return;
            }

            let userTypeId = $('#typeOfUserIdHolder').val();
            let postData = await postRequest(baseUrl+"store_role_for_user/"+userTypeId, {role_id:dataArray, option:option});

            if(postData.status == true){
                $(a).html(mainText).attr({'disabled':false});
                //returnFunctions.showSuccessToaster(postData.success_statement, 'success');
                successDisplay(postData.message)
                setTimeout(function () {
                    location.reload();
                }, 5000);
                return;

            }
            errorDisplay(postData.message);
            //handleTheErrorStatement(postData.error_message, 'off', 'no', 'yes');
        }
    }catch(e){
        errorDisplay(e);
        $(a).html(mainText).attr({'disabled':false});
    }

}

function roleField() {

    let field = `
        <div class="row field_holder">
        <div class="col-sm-12"><hr style="color: #fff;"></div>
                            <div class="col-sm-6">
                            
                                <div class="widget-text-box">
                                    <h4>Roles</h4>
                                    <div class="form-select-list">
                                        <input type="text" name="role[]" class="form-control"  placeholder="Role">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="widget-text-box">
                                    <h4>Description</h4>
                                    <div class="form-select-list">
                                        <textarea name="description[]" class="form-control" placeholder="Description"></textarea>
                                       
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                            <button class="btn btn-danger" onclick="deleteRoleField(this)" title="Delete Role Field" type="button"><span class="fa fa-trash"></span></button>
                            </div>

                        </div>
    `


    $(field).insertBefore('#add_field');

}

function userTypeField() {

    let field = `
        <div class="row field_holder">
        <div class="col-sm-12"><hr style="color: #fff;"></div>
                            <div class="col-sm-6">
                            
                                <div class="widget-text-box">
                                    <h4>Type of User</h4>
                                    <div class="form-select-list">
                                        <input type="text" name="type_of_user[]" class="form-control"  placeholder="Type of User">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="widget-text-box">
                                    <h4>Description</h4>
                                    <div class="form-select-list">
                                        <textarea name="description[]" class="form-control" placeholder="Description"></textarea>
                                       
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                            <button class="btn btn-danger" onclick="deleteRoleField(this)" title="Delete Role Field" type="button"><span class="fa fa-trash"></span></button>
                            </div>

                        </div>
    `


    $(field).insertBefore('#add_field');

}

function deleteRoleField(a) {
    $(a).closest('.field_holder').remove();
}