# Describe-it

> Lightweight PHP testing framework with describe-it syntax.

### Stability

This project is still in it's infancy and 
therefore is **not considered to be production ready**.

### Installation

Describe-it utilizes [Composer](https://getcomposer.org) 
to manage it's dependencies - make sure you have 
Composer installed on your system.

```bash
$ composer require --dev describe-it/describe-it
```

### Purpose

If you feel like your library is just too small to justify
incorporating a full-blown testing framework like PHPUnit or PHPSpec
then it's possible that describe-it is your thing. It's super small
and comes with just few even smaller dependencies.

### Example

This an example test case using describe-it syntax.

```php
describe('MyAwesomeClass', function() {
    context('Some of its features', function() {
    
        it('Should pass', function() {
            expect(10).equal_to(10.0);
        });
        
        it('But this should not', function() {
            expect(10).same_as(10.0);
        });
        
    });
});
```

### Features

* command-line test-runner
* test suites support
* expect assertions
* two formatters: dot & list
* optional json configuration file

### Configuration

You can configure describe-it using a `describe-it.json` file.

```json
{
    "formatter": "list",
    "suffix": "test",
    "suites": [
        {
            "name": "Features",
            "directory": "test/features"
        },
        {
            "name": "Issues",
            "directory": "test/issues"
        }
    ]
}
```

### Roadmap

* refactoring (formatter & runner classes are a bit chaotic)
* extract expectations to different package
* dot formatter
* tests & documentation
* custom bootstrap file
* interactive mode using `--watch`
* code-coverage (probably using `istanbul`)

### License

Describe-it is licensed under MIT license.
See [license file](license.md) for more information.

© 2016 [Sebastian Łepczyński](https://github.com/lepczynski-s)