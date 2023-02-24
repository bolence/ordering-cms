<?php


if (
    gethostname() == 'Bole-iMac.local'
    || gethostname() == 'pb07'
    || gethostname() == 'centos007'
    || gethostname() == 'Boskos-MacBook-Air.local'
    || gethostname() == 'Boskos-iMac.local'
) {

    return [

        'pdf' => [
            'enabled' => true,
            'binary' => '/usr/local/bin/wkhtmltopdf',
            'timeout' => false,
            'options' => [],
            'env'     => [],
        ],

        'image' => [
            'enabled' => true,
            'binary'  => '/usr/local/bin/wkhtmltoimage',
            'timeout' => false,
            'options' => [],
            'env'     => [],
        ],

    ];
} else {

    return [


        'pdf' => [
            'enabled' => true,
            'binary' => '"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf"',
            'timeout' => false,
            'options' => [],
            'env'     => [],
        ],

        'image' => [
            'enabled' => true,
            'binary'  => '"C:\Program Files\wkhtmltopdf\bin\wkhtmltoimage"',
            'timeout' => false,
            'options' => [],
            'env'     => [],
        ],

    ];
}
