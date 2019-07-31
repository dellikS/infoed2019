@php

    if (Auth::User()->level() >= 2) {
        $levelAmount = 'level';

    }

@endphp

<section class="page-header-title">
    <h4 class="page-title">Dashboard</h4>
    @role('admin', true)
        <span class=" badge badge-primary mb-2" style="mt-2">
            Admin Access
        </span><br>
        <span class="text-light">
            Permissions:
            @permission('view.users')
                <span class="badge badge-primary margin-half margin-left-0">
                    {{ trans('permsandroles.permissionView') }}
                </span>
            @endpermission

            @permission('create.users')
                <span class="badge badge-info margin-half margin-left-0">
                    {{ trans('permsandroles.permissionCreate') }}
                </span>
            @endpermission

            @permission('edit.users')
                <span class="badge badge-warning margin-half margin-left-0">
                    {{ trans('permsandroles.permissionEdit') }}
                </span>
            @endpermission

            @permission('delete.users')
                <span class="badge badge-danger margin-half margin-left-0">
                    {{ trans('permsandroles.permissionDelete') }}
                </span>
            @endpermission

        </span>
    @else
        <span class="badge badge-warning mb-2" style="mt-2">
            User Access
        </span>
    @endrole
    <br>
    <span class="text-light">
        Access level:
        <span class="badge badge-primary margin-half">{{ Auth::User()->level() }}</span>
    </span>
</section>