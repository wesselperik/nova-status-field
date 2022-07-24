<img src="https://raw.githubusercontent.com/wesselperik/nova-status-field/assets/logo.png" alt="Nova Status Field" width="500"/>
<hr>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/wesselperik/nova-status-field.svg?style=flat-square)](https://packagist.org/packages/wesselperik/nova-status-field)
[![Gitmoji](https://img.shields.io/badge/gitmoji-%20😜%20😍-FFDD67.svg?style=flat-square)](https://gitmoji.carloscuesta.me)

### 🚀 Compatible with Laravel Nova 4.0!

A Laravel Nova field for displaying a status icon, with optional tooltip and info text, on index and detail pages of your models.
This package utilizes several icons from the [Heroicons UI](https://heroicons.com/) icon pack (from designer [Steve Schroger](https://twitter.com/steveschoger)), which is also used in Laravel Nova.

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
            ->values([
                'minus-circle'  => $this->published == 0,
                'question-mark-circle'   => $this->pending == 1 && $this->published == 0,
                'check-circle'    => $this->pending == 0 && $this->published == 1
            ])
            ->tooltip($this->status) // optional
            ->color('primary')
            ->info("Blog status: ".$this->status) // optional
            ->exceptOnForms()

        // ...or change text based on the value
        StatusField::make('Published')
            ->values([
                'minus-circle'  => $this->published == 0,
                'question-mark-circle'   => $this->pending == 1 && $this->published == 0,
                'check-circle'    => $this->pending == 0 && $this->published == 1
            ])
            ->tooltip([
                'minus-circle'  => 'Not published',
                'question-mark-circle'   => 'Pending publication',
                'check-circle'    => 'Published'
            ])
            ->info([
                'minus-circle'  => 'This blog is not published yet.',
                'question-mark-circle'   => 'This blog is pending publication.',
                'check-circle'    => 'This blog is published on '.$this->published_at->format('d-m-Y').'.'
            ])
            ->color([
                'minus-circle'  => 'red-500',
                'question-mark-circle'   => 'current',
                'check-circle'    => 'green-500'
            ])
            ->exceptOnForms()
    ];
}
```
Available icons are:
[https://heroicons.com/](Hero Icons)

Available colors are:
[https://tailwindcss.com/docs/text-color](TailwindCSS Text Colors)

## License

The MIT License (MIT). Please see the [license file](LICENSE) for more information.
