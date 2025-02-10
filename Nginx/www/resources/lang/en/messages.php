<?php

return [
    'app' => [
        'title' => 'Game Application',
        'name' => 'Game App'
    ],
    'register' => [
        'title' => 'Registration',
        'name_label' => 'Your Name',
        'phone_number_label' => 'Phone Number',
        'submit_button' => 'Register',
        'error' => 'Registration error'
    ],
    'register_success' => [
        'title' => 'Registration Successful',
        'message' => 'Thank you for registering!',
        'game_link' => 'Your unique game link',
        'warning' => 'Please save this link. You will need it to access the game.',
        'copy_button' => 'Copy Link',
        'play_button' => 'Play Game',
        'copy_success' => 'Link copied to clipboard!',
        'copy_error' => 'Error copying link'
    ],
    'game' => [
        'title' => 'Game',
        'lucky_button' => 'I\'m Feeling Lucky',
        'history_button' => 'History',
        'regenerate_button' => 'Generate New Link',
        'deactivate_button' => 'Deactivate Link',
        'current_result' => 'Current Result',
        'number' => 'Number',
        'result' => 'Result',
        'win_amount' => 'Win Amount',
        'history' => 'Last 3 Games',
        'regenerate_confirm' => 'Are you sure you want to generate a new link? The current link will be deactivated.',
        'deactivate_confirm' => 'Are you sure you want to deactivate this link?'
    ],
    'errors' => [
        'game_error' => 'Error during the game',
        'history_error' => 'Error loading history',
        'invalid_link' => 'Invalid access link',
        'regenerate_error' => 'Error generating new link',
        'deactivate_error' => 'Error deactivating link'
    ]
];
