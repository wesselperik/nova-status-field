<img src="https://raw.githubusercontent.com/wesselperik/nova-status-field/assets/logo.png" alt="Nova Status Field" width="500"/>
<hr>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/wesselperik/nova-status-field.svg?style=flat-square)](https://packagist.org/packages/wesselperik/nova-status-field)
[![Gitmoji](https://img.shields.io/badge/gitmoji-%20😜%20😍-FFDD67.svg?style=flat-square)](https://gitmoji.carloscuesta.me)

### 🚀 Compatible with Laravel Nova 4.0!

A Laravel Nova field for displaying a status icon, with optional tooltip and info text, on index and detail pages of your models.
This package utilizes all icons from the [Heroicons](https://heroicons.com/) icon pack (from designer [Steve Schroger](https://twitter.com/steveschoger)), which is also used in Laravel Nova.

## Installation

You can install the package using composer:

```bash
composer require wesselperik/nova-status-field
```

Next up, add the field to your desired Nova model. See the example below:

```php
// for example, in app/Nova/Blog.php

use WesselPerik\StatusField\StatusField;

// ...

public function fields(Request $request) {
    return [
        // Use a single value for tooltips and info...
        StatusField::make('Published')
            ->icons([
                'minus-circle' => $this->published == 0,
                'clock'        => $this->pending == 1 && $this->published == 0,
                'check-circle' => $this->pending == 0 && $this->published == 1
            ])
            ->color('primary') // optional
            ->solid(true) // optional
            ->tooltip($this->status) // optional
            ->info("Blog status: ".$this->status) // optional
            ->exceptOnForms()

        // ...or change text based on the value
        StatusField::make('Published')
            ->icons([
                'minus-circle' => $this->published == 0,
                'clock'        => $this->pending == 1 && $this->published == 0,
                'check-circle' => $this->pending == 0 && $this->published == 1
            ])
            ->tooltip([
                'minus-circle' => 'Not published',
                'clock'        => 'Pending publication',
                'check-circle' => 'Published'
            ])
            ->info([
                'minus-circle' => 'This blog is not published yet.',
                'clock'        => 'This blog is pending publication.',
                'check-circle' => 'This blog is published on '.$this->published_at->format('d-m-Y').'.'
            ])
            ->color([
                'minus-circle' => 'red-500',
                'clock'        => 'blue-500',
                'check-circle' => 'green-500'
            ])
            ->exceptOnForms()
    ];
}
```
Available icons are all [Heroicons](https://heroicons.com/) by [Steve Schroger](https://twitter.com/steveschoger). By default, the icons are used in the outline style, but you can use the `solid()` function to change to the solid style (see the example above).

Available colors are the following [TailwindCSS text colors](https://tailwindcss.com/docs/text-color) included in Laravel Nova 4, which are:
- `primary`
- `gray`
- `white`
- `blue`
- `green`
- `red`

## Contributors

- [Wessel Perik](https://github.com/wesselperik)
- [Jeremy Holstein](https://github.com/jjjrmy)

## License

The MIT License (MIT). Please see the [license file](LICENSE) for more information.
