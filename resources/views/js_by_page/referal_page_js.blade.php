<script>

    $(document).on('click', '.downline_opener', function(){
        //downline_opener
        if($(this).next('.downlines').hasClass('hidden')){
            $(".downlines").addClass('hidden');
            $(this).next('.downlines').removeClass('hidden')
        }else{
            $(this).next('.downlines').addClass('hidden')
        }
    })

</script>
