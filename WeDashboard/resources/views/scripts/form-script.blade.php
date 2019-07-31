<script type="text/javascript">
$('.dropdown-menu li a').click(function() {
    $('.dropdown-menu li').removeClass('active');
});

$('.profile-trigger').click(function() {
    $('.panel').alterClass('card-*', 'card-default');
});

$('.settings-trigger').click(function() {
    $('.panel').alterClass('card-*', 'card-info');
});

$('.admin-trigger').click(function() {
    $('.panel').alterClass('card-*', 'card-warning');
    $('.edit_account .nav-pills li, .edit_account .tab-pane').removeClass('active');
    $('#changepw')
        .addClass('active')
        .addClass('in');
    $('.change-pw').addClass('active');
});

$('.warning-pill-trigger').click(function() {
    $('.panel').alterClass('card-*', 'card-warning');
});

$('.danger-pill-trigger').click(function() {
    $('.panel').alterClass('card-*', 'card-danger');
});

$('#user_basics_form').on('keyup change', 'input, select, textarea', function(){
    $('#account_save_trigger').attr('disabled', false).removeClass('disabled').show();
});

$('#business_basics_form').on('keyup change', 'input, select, textarea', function(){
    $('#business_save_trigger').attr('disabled', false).removeClass('disabled').show();
});

$('#business_project_form').on('keyup change', '.form-control, select, textarea', function(){
    $('#business_project_save_trigger').attr('disabled', false).removeClass('disabled').show();
});

$('#business_recruitment_form').on('keyup change', 'input, select, textarea', function(){
    $('#business_recruitment_save_trigger').attr('disabled', false).removeClass('disabled').show();
});

$('#user_profile_form').on('keyup change', 'input, select, textarea', function(){
    $('#confirmFormSave').attr('disabled', false).removeClass('disabled').show();
});

$('#checkConfirmDelete').change(function() {
    var submitDelete = $('#delete_account_trigger, #delete_project_trigger');
    var self = $(this);

    if (self.is(':checked')) {
        submitDelete.attr('disabled', false);
    }
    else {
        submitDelete.attr('disabled', true);
    }
});

$("#password_confirmation").keyup(function() {
    checkPasswordMatch();
});

$("#password, #password_confirmation").keyup(function() {
    enableSubmitPWCheck();
});

$('#password, #password_confirmation').hidePassword(true);

$('#password').password({
    shortPass: 'The password is too short',
    badPass: 'Weak - Try combining letters & numbers',
    goodPass: 'Medium - Try using special charecters',
    strongPass: 'Strong password',
    containsUsername: 'The password contains the username',
    enterPass: false,
    showPercent: false,
    showText: true,
    animate: true,
    animateSpeed: 50,
    username: false, // select the username field (selector or jQuery instance) for better password checks
    usernamePartialMatch: true,
    minimumLength: 6
});

function checkPasswordMatch() {
    var password = $("#password").val();
    var confirmPassword = $("#password_confirmation").val();
    if (password != confirmPassword && confirmPassword != "" && password != "") {
        $("#pw_status").html("Passwords do not match!");
    }
    else {
        $("#pw_status").empty();
    }
}

function enableSubmitPWCheck() {
    var password = $("#password").val();
    var confirmPassword = $("#password_confirmation").val();
    var submitChange = $('#pw_save_trigger');
    if (password != confirmPassword) {
        submitChange.attr('disabled', true);
    }
    else {
        submitChange.attr('disabled', false);
    }
}
</script>

<script>
    $('#salary-range').on('input', function() {
        $('#salary-output').html($(this).val());
    });
</script>

<script>
$(function()
    {
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var controlArray = $('.controls'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlArray);


        newEntry.find('input').val('');
        controlArray.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="fa fa-minus"></span>');
        })
        
        .on('click', '.btn-remove', function(e)
        {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });
});

</script>