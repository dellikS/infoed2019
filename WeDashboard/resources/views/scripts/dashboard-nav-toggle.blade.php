<script type="text/javascript">

        function tog_notif(){
            if ($('#notification-sidebar.sidebar').hasClass('slide')){
                $('#notification-sidebar.sidebar').removeClass('slide');
                $('.overlay').addClass('slide');
            }		
        }
        
        function tog_user(){
            if ($('#user-sidebar.sidebar').hasClass('slide')){
                $('#user-sidebar.sidebar').removeClass('slide');
                $('.overlay').addClass('slide');
            }		
        }
        
        function tog_menu(){
            $('.overlay').toggleClass('slide');
            if ($('#sidebar').hasClass('slide') && $('#sidebar-collapse').hasClass('is-active')){
                $('#sidebar').removeClass('slide');
                $('#sidebar-collapse').removeClass('is-active');
                $('.overlay').addClass('slide');
            }	
        }
        
        function tog_all(){
            $('#sidebar').removeClass('slide');
            $('.overlay').removeClass('slide');
            $('.sidebar').removeClass('slide');
            $('#sidebar-collapse').removeClass('is-active');
        }
        
        $('#sidebar-collapse').click(function(e) {
            e.stopPropagation();
            $('#sidebar').toggleClass('slide');
            $('.overlay').toggleClass('slide');
            $('#sidebar-collapse').toggleClass('is-active');
            tog_user();
            tog_notif();
        });
        

        $('#user-options').click(function(e) {
            e.stopPropagation();
            $('#user-sidebar.sidebar').toggleClass('slide');
            tog_menu();
            tog_notif();
        });
        
        $('#notification-toggle').click(function(e) {
            e.stopPropagation();
            $('#notification-sidebar').toggleClass('slide');
            tog_menu();
            tog_user();
        });

        $('#admin-options-toggle').click(function(e) {
            e.stopPropagation();
            $('#admin-options-list').toggleClass('show');
            $('#admin-area').toggleClass('selected');
        });
        
        $('body,html').click(function(e){
            var container = $("#sidebar, #user-menu, #notification-menu");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                tog_all();
            }
        });
    </script>