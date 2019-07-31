<script type="text/javascript">
    function initDateMaskOnKeyPress(inputId, datePattern) {
    var initialized = false;
    var normalizedPattern = datePattern.toLowerCase();
    if (!normalizedPattern.match(/dd/)) {
        normalizedPattern = normalizedPattern.replace(/d/, "dd");
    }
    if (!normalizedPattern.match(/mm/)) {
        normalizedPattern = normalizedPattern.replace(/m/, "mm");
    }
    if (!normalizedPattern.match(/yyyy/)) {
        normalizedPattern = normalizedPattern.replace(/yy/, "yyyy");
    }
    var mask = normalizedPattern.replace(/[A-Za-z]/g, "9");
    var placeholder = normalizedPattern.replace(/[A-Za-z]/g, "_");
    $("#" + inputId).on('keydown', function() {
        if (!initialized) {
            $("#" + inputId).mask(mask, {autoclear: false, placeholder: placeholder});
            initialized = true;
        }
    });
}

$(function() {
    var inputId = "birth_date".replace(/:/g, "\\:");
    var datePattern = "dd/MM/yyyy";
    initDateMaskOnKeyPress(inputId, datePattern);
});
$(function() {
    var inputId = "deadline".replace(/:/g, "\\:");
    var datePattern = "dd/MM/yyyy";
    initDateMaskOnKeyPress(inputId, datePattern);
});
</script>