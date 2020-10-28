# Laravel Translation Extended (wip)

[![Latest Stable Version](https://poser.pugx.org/darthsoup/laravel-translation-extended/v)](//packagist.org/packages/darthsoup/laravel-translation-extended)
![phpunit](https://github.com/darthsoup/laravel-translation-extended/workflows/phpunit/badge.svg)
[![License](https://poser.pugx.org/darthsoup/laravel-translation-extended/license)](https://packagist.org/packages/darthsoup/laravel-translation-extended)

## Installation

Install the package through [Composer](http://getcomposer.org/).

Run the Composer require command from the Terminal:

```bash
composer require darthsoup/laravel-translation-extended
```

Run `composer update` to pull in the files.

After pulling the files open your `config/app.php` file and replace
`Illuminate\Translation\TranslationServiceProvider::class` with `DarthSoup\TranslationExtended\TranslationServiceProvider::class` in the Service Provider Section.

Run the Assets publish command from the Terminal: `php artisan vendor:publish --provider=DarthSoup\TranslationExtended\TranslationServiceProvider` 

## Support

[Please open an issue in github](https://github.com/darthsoup/laravel-translation-extended/issues)

## License

This package is released under the MIT License. See the bundled
[LICENSE](https://github.com/darthsoup/laravel-translation-extended/blob/master/LICENSE) file for details.
