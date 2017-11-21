<!--   Core JS Files   -->
<script src="/js/jquery/jquery-1.10.2.js" type="text/javascript"></script>
<script src="/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>

<!--    Custom script   -->
<script src="/js/backend/backend.js" type="text/javascript"></script>

<!--    Light Bootstrap Table Core javascript and methods for Demo purpose  -->
<script src="/js/backend/light-bootstrap-dashboard.js"></script>

<!--    TinyMCE    -->
<script src="/js/tinymce/tinymce.min.js"></script>

<script type="text/javascript">

    tinymce.init({
        selector: ".newsTextarea",
//        mode: "textareas",
        language : "fr_FR",
        plugins: [
            "advlist autolink autoresize autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
        ],
        toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | spellchecker | visualchars visualblocks pagebreak ",
        menubar: false,
        toolbar_items_size: 'small'
    });

</script>