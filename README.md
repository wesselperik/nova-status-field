<img src="https://raw.githubusercontent.com/wesselperik/nova-status-field/assets/logo.png" alt="Nova Status Field" width="500"/>
<hr>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/wesselperik/nova-status-field.svg?style=flat-square)](https://packagist.org/packages/wesselperik/nova-status-field)
[![Gitmoji](https://img.shields.io/badge/gitmoji-%20😜%20😍-FFDD67.svg?style=flat-square)](https://gitmoji.carloscuesta.me)


A Laravel Nova field for displaying a status icon, with optional tooltip and info text, on index and detail pages of your models.
This package utilizes several icons from the [Heroicons UI](https://heroicons.com/) icon pack (from designer [Steve Schroger](https://twitter.com/steveschoger)), which is also used in Laravel Nova.

## Installation

You can install the package using composer:

```bash
composer require wesselperik/nova-status-field
```

Next up, add the field to your desired Nova model. See the example below:

```php
// for example, in app/Nova/Post.php

use WesselPerik\StatusField\StatusField;

// ...

public function fields(Request $request) {
    return [
        // ...

        StatusField::make('Published')
                ->values([
                    'inactive'  => $this->published == 0,
                    'pending'   => $this->pending == 1,
                    'active'    => $this->published == 1
                ])
                ->tooltip("Super awesome tooltip!")
                ->info("Some extra info on the detail view")
                ->exceptOnForms()
    ];
}
```
Available values (with matching icons) are:
- inactive (cross)
- active (checkmark)
- pending (clock)
- info (info icon)
- warning (exclamation mark)
- help (questionmark)
- disabled (minus)

## License

The MIT License (MIT). Please see the [license file](LICENSE) for more information.
