<?php

return [

    /*
    |--------------------------------------------------------------------------
    | General TTS Settings
    |--------------------------------------------------------------------------
    */

    'enable' => [
        'aws' => env('CONFIG_ENABLE_AWS'),
        'aws_standard' => env('CONFIG_ENABLE_AWS_STANDARD'),
        'aws_neural' => env('CONFIG_ENABLE_AWS_NEURAL'),
        'azure' => env('CONFIG_ENABLE_AZURE'),
        'azure_standard' => env('CONFIG_ENABLE_AZURE_STANDARD'),
        'azure_neural' => env('CONFIG_ENABLE_AZURE_NEURAL'),
        'gcp' => env('CONFIG_ENABLE_GCP'),
        'gcp_standard' => env('CONFIG_ENABLE_GCP_STANDARD'),
        'gcp_neural' => env('CONFIG_ENABLE_GCP_NEURAL'),
        'ibm' => env('CONFIG_ENABLE_IBM'),
    ],

    'voice_type' => env('CONFIG_VOICE_TYPE', 'both'),

    'ssml_effect' => env('CONFIG_SSML_EFFECT', 'enable'),

    'max_chars_limit' => env('CONFIG_MAX_CHAR_LIMIT', 3000),

    'free_chars_limit' => env('CONFIG_MAX_FREE_TIER_CHAR_LIMIT', 1000),

    'free_chars' => env('CONFIG_MAX_FREE_CHARS', 0),

    'default_storage' => env('CONFIG_DEFAULT_STORAGE', 'local'),

    'clean_storage' => env('CONFIG_CLEAN_STORAGE', 'never'),

    'user_neural' => env('CONFIG_USER_NEURAL_VOICES', 'disable'),

    'vendor_logos' => env('CONFIG_VENDOR_LOGOS', 'show'),

    'default_language' => env('CONFIG_DEFAULT_LANGUAGE'),

    'default_voice' => env('CONFIG_DEFAULT_VOICE'),

    'background_audio_size' => env('BACKGROUND_AUDIO_SIZE'),

];
