<div class="notification">
    <div class="the-time">{{ $notification->created_at->diffForHumans() }} </div>
    <div class="the-content">
        @if($notification->unread())
        <div class="notification-text">
            <div class="notification-info text-dark">
                <h5><span class="bubble"></span> Your business "{{ $notification->data['business_name'] }}" has been created!</h5> 
                <div class="position-relative">   
                    <p>Now, you can start to manage it!</p>
                </div>
            </div>
            <div class="text-right">
                <a class="text-danger mr-3" href="{{url('notification/delete/'.$notification->id)}}"> <i class="fa fa-close"></i> Delete notification</a>
                <a class="text-success" href="{{url('notification/read/'.$notification->id)}}"> <i class="fa fa-check"></i> Mark as read</a>
            </div>
        </div>
        @else
        <div class="notification-text">
            <div class="notification-info">
                <h5>Your business "{{ $notification->data['business_name'] }}" has been created!</h5> 
                <div class="position-relative">   
                   <p>Now, you can start to manage it!</p>
                </div>
            </div>
            <div class="text-right">
                <a class="text-danger mr-3" href="{{url('notification/delete/'.$notification->id)}}"> <i class="fa fa-close"></i> Delete notification</a>
            </div>
        </div>     
        @endif
    </div>
</div>