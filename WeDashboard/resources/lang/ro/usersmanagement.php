<?php

return [

    // Titles
    'showing-all-users'     => 'Arata toti utilizatorii',
    'users-menu-alt'        => 'Arata meniul de manageriat utilizatori',
    'create-new-user'       => 'Creeaza utilizator nou',
    'show-deleted-users'    => 'Arata utilizatorii stersi',
    'editing-user'          => 'Editarea utilizatorului :name',
    'showing-user'          => 'Arata :name utilizatorului',
    'showing-user-title'    => 'Informatiile lui :name',

    // Flash Messages
    'createSuccess'   => 'Utilizator creeat cu succes! ',
    'updateSuccess'   => 'Utilizator actualizat cu succes! ',
    'deleteSuccess'   => 'Utilizator sters cu succes! ',
    'deleteSelfError' => 'Nu te poti sterge pe tine! ',

    // Show User Tab
    'viewProfile'            => 'Vizualizare profil',
    'editUser'               => 'Editeaza contul',
    'deleteUser'             => 'Sterge contul',
    'usersBackBtn'           => 'Inapoi la conturi',
    'usersPanelTitle'        => 'Informatii cont',
    'labelUserName'          => 'Utilizator:',
    'labelEmail'             => 'Adresa email:',
    'labelFirstName'         => 'Nume:',
    'labelLastName'          => 'Prenume:',
    'labelRole'              => 'Rol:',
    'labelStatus'            => 'Status:',
    'labelAccessLevel'       => 'Accesse:',
    'labelPermissions'       => 'Permisiuni:',
    'labelCreatedAt'         => 'Creeat la:',
    'labelUpdatedAt'         => 'Actualizat la:',
    'labelIpEmail'           => 'Email Signup IP:',
    'labelIpEmail'           => 'Email Signup IP:',
    'labelIpConfirm'         => 'IP de confirmare:',
    'labelIpAdmin'           => 'Admin Signup IP:',
    'labelIpUpdate'          => 'Ultima actualizare IP:',
    'labelDeletedAt'         => 'Sters la',
    'labelIpDeleted'         => 'IP sters:',
    'usersDeletedPanelTitle' => 'Informatii sterse',
    'usersBackDelBtn'        => 'Inapoi la utilizatorii stersi',

    'successRestore'    => 'Utilizator restaurat.',
    'successDestroy'    => 'Inregistrare utilizator distrusa.',
    'errorUserNotFound' => 'Utilizator negasit.',

    'labelUserLevel'  => 'Nivel',
    'labelUserLevels' => 'Nivele',

    'users-table' => [
        'caption'   => '{1} :userscount utilizatori totali|[2,*] :userscount total utilizatori',
        'id'        => 'ID',
        'name'      => 'Utilizator',
        'fname'     => 'Nume',
        'lname'     => 'Prenume',
        'email'     => 'Email',
        'role'      => 'Rol',
        'created'   => 'Creat',
        'updated'   => 'Actualizat',
        'actions'   => 'Actiuni',
        'updated'   => 'Actualizat',
    ],

    'buttons' => [
        'create-new'    => 'Utilizator nou',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Sterge</span><span class="hidden-xs hidden-sm hidden-md"> utilizator</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Arata</span><span class="hidden-xs hidden-sm hidden-md"> utilizator</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editeaza</span><span class="hidden-xs hidden-sm hidden-md"> utilizator</span>',
        'back-to-users' => '<span class="hidden-sm hidden-xs">Inapoi la </span><span class="hidden-xs">utilizatori</span>',
        'back-to-user'  => 'Inapoi  <span class="hidden-xs">la utilizatori</span>',
        'delete-user'   => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Sterge</span><span class="hidden-xs"> utilizator</span>',
        'edit-user'     => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Editeaza</span><span class="hidden-xs"> utilizator</span>',
    ],

    'tooltips' => [
        'delete'        => 'Delete',
        'show'          => 'Show',
        'edit'          => 'Edit',
        'create-new'    => 'Create New User',
        'back-users'    => 'Inapoi la users',
        'email-user'    => 'Email :user',
        'submit-search' => 'Submit Users Search',
        'clear-search'  => 'Clear Search Results',
    ],

    'messages' => [
        'userNameTaken'          => 'Username is taken',
        'userNameRequired'       => 'Username is required',
        'fNameRequired'          => 'First Name is required',
        'lNameRequired'          => 'Last Name is required',
        'emailRequired'          => 'Email is required',
        'emailInvalid'           => 'Email is invalid',
        'passwordRequired'       => 'Password is required',
        'PasswordMin'            => 'Password needs to have at least 6 characters',
        'PasswordMax'            => 'Password maximum length is 20 characters',
        'captchaRequire'         => 'Captcha is required',
        'CaptchaWrong'           => 'Wrong captcha, please try again.',
        'roleRequired'           => 'User role is required.',
        'user-creation-success'  => 'Successfully created user!',
        'update-user-success'    => 'Successfully updated user!',
        'delete-success'         => 'Successfully deleted the user!',
        'cannot-delete-yourself' => 'You cannot delete yourself!',
    ],

    'show-user' => [
        'id'                => 'User ID',
        'name'              => 'Username',
        'email'             => '<span class="hidden-xs">User </span>Email',
        'role'              => 'User Role',
        'created'           => 'Created <span class="hidden-xs">at</span>',
        'updated'           => 'Updated <span class="hidden-xs">at</span>',
        'labelRole'         => 'User Role',
        'labelAccessLevel'  => '<span class="hidden-xs">User</span> Access Level|<span class="hidden-xs">User</span> Access Levels',
    ],

    'search'  => [
        'title'             => 'Showing Search Results',
        'found-footer'      => ' Record(s) found',
        'no-results'        => 'No Results',
        'search-users-ph'   => 'Search Users',
    ],

    'modals' => [
        'delete_user_message' => 'Are you sure you want to delete :user?',
    ],
];
