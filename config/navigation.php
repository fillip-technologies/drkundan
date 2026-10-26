<?php

/*
|--------------------------------------------------------------------------
| Site Navigation
|--------------------------------------------------------------------------
|
| Header and footer menus (built by App\Support\Navigation). Menu names and
| structure follow Dr_Kundan_Final_Navigation_Mega_Menu.docx.
|
| - Menus with a 'category' list that category from the service catalog in
|   resources/data/services, so items, descriptions, icons and publishing
|   state are managed in those JSON files.
| - Other menus list their items here. 'url' is a path on this site;
|   'action' => call | whatsapp | email uses the contact details in
|   resources/data/site.json. Items without a url are shown as plain text.
|
*/

return [

    /*
    |--------------------------------------------------------------------------
    | Optional Items (* in the document)
    |--------------------------------------------------------------------------
    |
    | Non-service items that are only shown once confirmed. Optional services
    | are published or unpublished in the service JSON files instead.
    |
    */

    'optional_items' => [
        // Doctors
        'neurosurgeon' => true, // Dr. Kundan Kumar, MCh Neurosurgery.
        'pediatric_neurologist' => false,
        'neuropsychiatrist' => false,
        'rehabilitation_specialist' => false,

        // About Us ("only where verified")
        'accreditations' => false,

        // Contact Us ("if applicable"): branch Directions links exist on /clinics; no parking details yet.
        'directions_parking' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Main Navigation
    |--------------------------------------------------------------------------
    |
    | Top-level header items in display order. Items with a 'menu' key open
    | the menu of the same key; 'active' lists request()->is() patterns. The
    | About Us and Patient Resources menus are listed in the footer instead.
    |
    */

    'main' => [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Specialities', 'menu' => 'specialities'],
        ['label' => 'Conditions', 'menu' => 'conditions'],
        ['label' => 'Doctor', 'menu' => 'doctors', 'active' => ['about']],
        ['label' => 'Diagnostics', 'menu' => 'diagnostics'],
        ['label' => 'Rehabilitation', 'menu' => 'rehabilitation'],
        ['label' => 'Contact Us', 'menu' => 'contact', 'active' => ['contact']],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menus
    |--------------------------------------------------------------------------
    |
    | 'type' => 'mega' opens a full-width panel; 'dropdown' a compact panel
    | under its trigger. 'columns' sets how many columns an ungrouped list
    | flows into. 'icon' is a Font Awesome class.
    |
    */

    'menus' => [

        'specialities' => ['type' => 'mega', 'columns' => 3, 'category' => 'specialities', 'priority' => ['spine-pain', 'neurosurgery', 'neuro-rehabilitation']],

        // Icons on the condition group headings only, to keep the 17 items easy to scan.
        'conditions' => ['type' => 'mega', 'category' => 'conditions', 'itemIcons' => false],

        'doctors' => [
            'type' => 'dropdown',
            'groups' => [
                ['items' => [
                    ['label' => 'Neurosurgeon', 'url' => '/about#doctor-profile', 'icon' => 'fa-solid fa-user-doctor', 'optional' => 'neurosurgeon'],
                ]],
            ],
            // Individual Doctor Profile (doctor details come from site.json)
            'profile' => [
                'doctor' => 'kundan-kumar',
                'items' => [
                    ['label' => 'Qualifications', 'url' => '/about#qualifications', 'icon' => 'fa-solid fa-graduation-cap'],
                    ['label' => 'Registration', 'url' => null, 'icon' => 'fa-solid fa-id-card'],
                    ['label' => 'Experience', 'url' => '/about#experience', 'icon' => 'fa-solid fa-briefcase-medical'],
                    ['label' => 'Areas of expertise', 'url' => '/about#expertise', 'icon' => 'fa-solid fa-award'],
                    ['label' => 'OPD schedule', 'url' => '/clinics#branches', 'icon' => 'fa-regular fa-calendar-days'],
                ],
            ],
        ],

        'diagnostics' => ['type' => 'mega', 'columns' => 3, 'category' => 'diagnostics'],

        'rehabilitation' => ['type' => 'mega', 'columns' => 4, 'category' => 'rehabilitation'],

        'contact' => [
            'type' => 'dropdown',
            'align' => 'right',
            'groups' => [
                ['items' => [
                    ['label' => 'Clinic Address & Map', 'url' => '/#location', 'icon' => 'fa-solid fa-location-dot'],
                    ['label' => 'OPD Timings', 'url' => '/clinics#branches', 'icon' => 'fa-regular fa-clock'],
                    ['label' => 'Call Clinic', 'action' => 'call', 'icon' => 'fa-solid fa-phone'],
                    ['label' => 'WhatsApp Clinic', 'action' => 'whatsapp', 'icon' => 'fa-brands fa-whatsapp'],
                    ['label' => 'Email', 'action' => 'email', 'icon' => 'fa-regular fa-envelope'],
                    ['label' => 'Directions / Parking Information', 'url' => '/clinics#branches', 'icon' => 'fa-solid fa-diamond-turn-right', 'optional' => 'directions_parking'],
                ]],
            ],
        ],

        // Footer menus (resources/views/components/footer.blade.php)

        'about' => [
            'type' => 'dropdown',
            'groups' => [
                ['items' => [
                    ['label' => 'About the Clinic', 'url' => '/clinics'],
                    ['label' => 'Clinical Approach', 'url' => '/clinics#clinical-approach'],
                    ['label' => 'Infrastructure & Facilities', 'url' => null],
                    ['label' => 'Technology & Equipment', 'url' => '/clinics#technology'],
                    ['label' => 'Gallery', 'url' => null],
                    ['label' => 'Accreditations / Professional Associations', 'url' => null, 'optional' => 'accreditations'],
                ]],
            ],
        ],

        'patient-resources' => ['type' => 'mega', 'columns' => 2, 'category' => 'patient-resources'],

    ],

];
