# Adminer Input UUID generator

[![Adminer](https://img.shields.io/badge/adminer-%3E%3D5.0-blue)](https://www.adminer.org)

## Installation & usage

- How to install plugins to Adminer: http://www.adminer.org/plugins/

```php
$plugins = [
	/*
	1. param $columns = ['id'] - Into which column names should be added UUID generate button (also param 2 must match)
		['id'] - adds button next to 'id' input for all tables
		['id', 'users::external_id'] - adds next to id input for all tables and next to external_id input in users table
	2. param $matchingTypes = ['uuid'] - Next to which column types button will be placed
	3. param $buttonText = 'Generate UUID' - the text label of the button
	*/
    new AdminerUUIDGenerator(),
];
```

# Changelog

## 2.0

- Added support for Adminer 5

## 1.0

- Initial release