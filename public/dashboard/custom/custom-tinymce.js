
$(document).ready(function () {
  let current_page = $('title').text();

  if(current_page == 'Add New Beat'){

    tinymce.init({
      selector: 'textarea#course_desc',
      plugins : ['link preview anchor'],
      height:400,
    });

  }
});
