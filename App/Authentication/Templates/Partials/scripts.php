<!--   Core JS Files  -->
<script src="/js/jquery/jquery.min.js" type="text/javascript"></script>
<script src="/js/backend/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>

<!-- Light Bootstrap Dashboard Core javascript and methods -->
<script src="/js/backend/light-bootstrap-dashboard44ca.js?v=1.4.0"></script>

<script type="text/javascript">
    $().ready(function(){
        lbd.checkFullPageBackgroundImage();

        setTimeout(function(){
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>