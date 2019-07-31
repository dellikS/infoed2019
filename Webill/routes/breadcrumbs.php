<?php

Breadcrumbs::for('home', function ($trail) {
     $trail->push(__('navigation.home'), route('home'));
});

        Breadcrumbs::for('services', function ($trail) {
            $trail->parent('home');
            $trail->push(__('navigation.services'), route('services-general'));
        });

                Breadcrumbs::for('webill', function ($trail) {
                    $trail->parent('services');
                    $trail->push('Webill', route('services-webill'));
                });

                Breadcrumbs::for('webiz', function ($trail) {
                    $trail->parent('services');
                    $trail->push('Webiz', route('services-webiz'));
                });

        Breadcrumbs::for('legal', function ($trail) {
            $trail->parent('home');
            $trail->push(__('footer.legal'), route('legal-general'));
        });

            Breadcrumbs::for('privacy', function ($trail) {
                $trail->parent('legal');
                $trail->push(__('footer.privacy'), route('legal-privacy'));
            });

            Breadcrumbs::for('cookies', function ($trail) {
                $trail->parent('legal');
                $trail->push(__('footer.cookies'), route('legal-cookies'));
            });