$( document ).ready(function() {
    jQuery("time.timeago").timeago();
    $('#summernote').summernote({
      height: 100,                 // set editor height
      minHeight: null,             // set minimum height of editor
      maxHeight: null,             // set maximum height of editor
      // focus: true,                  // set focus to editable area after initializing summernote
      // onImageUpload: function(files, editor, welEditable) {
      //           sendFile(files[0], editor, welEditable);
      //       }
    });
    $('.select_role').change(function(){
      this.form.submit();
    });
});
