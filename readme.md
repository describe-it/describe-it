# Describe-it

> Lightweight PHP testing framework with describe-it syntax.

### Stability

This project is still in it's infancy and 
therefore is **not considered to be production ready**.

### Installation

Describe-it utilizes [composer](https://getcomposer.org) 
to manage it's dependencies - make sure you have 
composer installed on your system.

```bash
$ composer require --dev lepczynski-s/describe-it
```

### Features

* command-line test-runner
* test suites support
* expect-style assertions
* two formatters: dot & list
* optional json configuration file

### Example

This an example test case using describe-it syntax.

```php
describe('MyAwesomeClass', function() {
    context('Some of its features', function() {
    
        it('Should pass', function() {
            expect(10)->to_be->equal_to(10.0);
        });
        
        it('But this should not', function() {
            expect(10)->to_be->same_as(10.0);
        });
        
    });
});
```

### Configuration

You can configure describe-it using a `describe-it.json` file.

```json
{
    "formatter": {
        "type": "list",
        "indent": 4,
        "passed": true,
        "success": "+",
        "failure": "-"
    },
    "outputs": [
    ],
    "suites": [
        {
            "name": "Features",
            "directory": "test/features",
            "suffix": "test"
        },
        {
            "name": "Issues",
            "directory": "test/issues",
            "suffix": "test"
        }
    ]
}
```

### Roadmap

* execution context
* dot formatter
* tests & documentation
* custom bootstrap file
* interactive mode using `--watch`
* code-coverage (probably using `istanbul`)

### License

Describe-it is licensed under MIT license.
See [license file](license.md) for more information.

© 2016 [Sebastian Łepczyński](https://github.com/lepczynski-s)
