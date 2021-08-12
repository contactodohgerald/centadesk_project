@php $pageForBankArray = ['main_settings_page', 'verifications'];  @endphp
@if(@in_array( request()->segment(1), $pageForBankArray))
    <script>

        $(document).ready(function () {
            let bank_code = $(".bank_code");

            //let bank_name = $(".bank_name")
            for(let i = 0; i < bank_code.length; i++){
                let currentBankCode = $(bank_code[i]).attr('data-bank-code');
                let bankDetails = getBanks(currentBankCode);

                $(bank_code[i]).html(bankDetails)
            }
        });

        function dropBankName(a) {
            let selectedValue = $(a).find("option:selected").text();
            $(a).siblings('.bank_name').val(selectedValue)
        }

        function addNewFields(){
            let currentCount = $(".bank_code").length;
            currentCount = parseFloat(currentCount) + parseFloat(1);
            let bankDetails = getBanks();
            let text = `
            <hr class="deleteMe${currentCount}"><div class="deleteMe${currentCount}"><h4>${currentCount}</h4></div>
            <div class="form-group deleteMe${currentCount}">
                            <label for="bank_code" class="control-label">{{ __('Bank Name') }} </label>
                            <select required onchange="dropBankName(this)" id="bank_code" name="bank_code[]" class="bank_code form-control @error('bank_code') is-invalid @enderror" data-bank-code=""  >
                                ${bankDetails}
                            </select>
                            <input type="hidden" id="bank_name" name="bank_name[]" value="{{old('bank_name')}}" class="bank_name form-control @error('bank_name') is-invalid @enderror" placeholder="Bank Account Name" required data-error="Encryption Key is Required" />

                            @error('bank_code')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                </div>

                <div class="form-group deleteMe${currentCount}">
<label for="bank_account_no" class="control-label">{{ __('Bank Account Number') }} </label>
                            <input type="text" id="bank_account_no" name="bank_account_no[]" value="{{old('bank_account_no')}}" class="form-control @error('bank_account_no') is-invalid @enderror" placeholder="Bank Account Number" required data-error="Bank Account Number is Required" />
                            <input type="hidden" name="bankUniqueId[]">

                            @error('bank_account_no')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                </div>

                <div class="form-group deleteMe${currentCount}">
<label for="account_name" class="control-label">{{ __('Bank Account Name') }} </label>
                            <input type="text" id="account_name" name="account_name[]" value="{{old('account_name')}}" class="form-control @error('account_name') is-invalid @enderror" placeholder="Account Name" required data-error="Account Name is Required" />

                            @error('account_name')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                </div>

                <div class="form-group">
                    <button onclick="deleteConcernedFields(this)" data-to-delete="deleteMe${currentCount}"  type="button" class="btn btn-danger">Delete Bank details ${currentCount}</button>
                        </div>
                        `;

            $(text).insertBefore('.theSubmitButton')
        }

        function deleteConcernedFields(a) {
            let elementsToDelete = $(a).attr('data-to-delete');
            $('.'+elementsToDelete).remove();
        }

    </script>

@endif
