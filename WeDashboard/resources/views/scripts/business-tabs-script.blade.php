<script type="text/javascript">

    $(document).ready(function() {
        /*---------------------------------------------------------*/
        $(".btn-next").click(function() { // Function Runs On NEXT Button Click
            $(this).parent().next().fadeIn('slow');
            $(this).parent().css({
                'display': 'none'
            });
        // Adding Class Active To Show Steps Forward;
        $('.active').next().addClass('active');
        });
        $(".btn-prev").click(function() { // Function Runs On PREVIOUS Button Click
            $(this).parent().prev().fadeIn('slow');
            $(this).parent().css({
                'display': 'none'
            });
            // Removing Class Active To Show Steps Backward;
            $('.active:last').removeClass('active');
        });
    });
</script>

<script type="text/javascript">
function isEmpty( el ){
    return !$.trim(el.html())
}
</script>

<script type="text/javascript">
    var country_id = $("#country_id").find(':selected').data('phone');
    $(".prefix").text("+ " + country_id);
function changePrefix() {
    var country_id = $("#country_id").find(':selected').data('phone');
    $(".prefix").text("+ " + country_id);
}
</script>

<script type="text/javascript">

var url = document.location.toString();
if (url.match('#')) {
    $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
} 

$('.nav-tabs a').on('shown.bs.tab', function (e) {
    window.location.hash = e.target.hash;
})

</script>

<script type="text/javascript">
    var currency = "NULL";
    if (isEmpty($(".currency"))){
        $(".currency").text(currency);
    }
function changeCurrency() {
    var currency = $("#currency").val();
    $(".currency").text(currency);
}
</script>