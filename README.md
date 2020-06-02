# Nova Status Field

[![Latest Version on Packagist](https://img.shields.io/packagist/v/wesselperik/nova-status-field.svg?style=flat-square)](https://packagist.org/packages/wesselperik/nova-status-field)
[![Gitmoji](https://img.shields.io/badge/gitmoji-%20😜%20😍-FFDD67.svg?style=flat-square)](https://gitmoji.carloscuesta.me)


A Laravel Nova field for displaying a status icon on index and detail pages of your models.
This package utilizes several icons from the [Heroicons UI](https://github.com/sschoger/heroicons-ui) icon pack (from designer [Steve Schroger](https://twitter.com/steveschoger)), which is also used in Laravel Nova.

## Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require wesselperik/nova-status-field
```

Next up, add the tool to your desired Nova model. Do this like so:

```php
// for example, in app/Nova/User.php

use WesselPerik\StatusField\StatusField;

// ...

public function fields(Request $request) {
    return [
        // ...

        StatusField::make('Status')
                ->values([
                    'inactive'  => $this->active == 0,
                    'pending'   => $this->active == 1 && $this->approved == 0,
                    'active'    => $this->active == 1 && $this->approved == 1
                ])
                ->exceptOnForms()
    ];
}
```
Available values (with matching icons) are:
- inactive
- active
- pending
- info
- warning
- help

## License

The MIT License (MIT). Please see the [license file](LICENSE.md) for more information.
