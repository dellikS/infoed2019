<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Emails Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for various emails that
    | we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    /*
     * Activate new user account email.
     *
     */

    'activationSubject'  => 'Activare necesara',
    'activationGreeting' => 'Bun venit!',
    'activationMessage'  => 'Trebuie sa ai contul activat inainte de a incepe sa ne folosesti serviciile.',
    'activationButton'   => 'Activeaza',
    'activationThanks'   => 'Multumim pentru ca ne folositi aplicatia!',

    /*
     * Goobye email.
     *
     */
    'goodbyeSubject'  => 'Ne pare rau ca pleci...',
    'goodbyeGreeting' => 'Buna, :username,',
    'goodbyeMessage'  => 'Ne pare foarte rau ca nu o sa te mai vedem. Trebuie sa te instiintam ca acest cont va fi sters definitiv. Mutlumim pentru timpul petrecut alaturi de noi. Ai la dispozitie '.config('settings.restoreUserCutoff').' zile sa-ti restaurezi contul.',
    'goodbyeButton'   => 'Restaureaza-ti contul',
    'goodbyeThanks'   => 'Speram sa te revedem!',

];
