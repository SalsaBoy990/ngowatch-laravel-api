<script src="{{ asset('/assets/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    var route_prefix = "/filemanager";

    var editor_config = {
        path_absolute : "/",
        selector: 'textarea#update-content-editor',
        plugins: 'link table lists image code media',
        height: 700,
        browser_spellcheck: true,
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | image media | bullist numlist | code | table | indent outdent',
        forced_root_block: '',
        extended_valid_elements : "iframe[src|frameborder|style|allowfullscreen|scrolling|class|width|height|name|align]",

        file_picker_callback : function(callback, value, meta) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'filemanager?editor=' + meta.fieldname;
            if (meta.filetype == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.openUrl({
                url : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no",
                onMessage: (api, message) => {
                    callback(message.content);
                }
            });
        }
    }


    tinymce.init(editor_config);
</script>
