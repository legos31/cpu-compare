/* ------------------------------------------------------------------------------
 *
 *  # Summernote editor
 *
 *  Demo JS code for editor_summernote.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var Summernote = function() {


    //
    // Setup module components
    //

    // Summernote
    var _componentSummernote = function() {
        if (!$().summernote) {
            console.warn('Warning - summernote.min.js is not loaded.');
            return;
        }

        var sendFile = function(file, editor, welEditable) {
            let data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                type: "POST",
                url: "/admin/posts/upload",
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    editor.insertImage(welEditable, url);
                }
            });
        }

        // Basic examples
        // ------------------------------

        // Default initialization
        $('.summernote').summernote({
            lang: 'ru-RU',
            onImageUpload: function(files, editor, welEditable) {
                console.log(123)
                sendFile(files[0], editor, welEditable);
            }
        });



        // Control editor height
        $('.summernote-height').summernote({
            height: 400
        });

        // Air mode
        $('.summernote-airmode').summernote({
            airMode: true
        });


        // Click to edit
        // ------------------------------

        // Edit
        $('#edit').on('click', function() {
            $('.click2edit').summernote({focus: true});
        })

        // Save
        $('#save').on('click', function() {
            var aHTML = $('.click2edit').summernote('code');
            $('.click2edit').summernote('destroy');
        });
    };

    // Uniform
    var _componentUniform = function() {
        if (!$().uniform) {
            console.warn('Warning - uniform.min.js is not loaded.');
            return;
        }

        // Styled file input
        $('.note-image-input').uniform({
            fileButtonClass: 'action btn bg-warning-400'
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentSummernote();
            _componentUniform();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    Summernote.init();
});
