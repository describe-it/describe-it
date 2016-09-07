# Describe-it

> Super simple PHP testing framework using describe-it syntax.

### Purpose

If you think that requiring about 20 megabytes of 
PHPUnit into your small, few files, library is
an overkill then describe-it may be your thing.

### Features

* command-line test-runner
* test suites support
* expect assertions
* two formatters: dot & list
* optional json configuration file

### Installation

```bash
$ composer require --dev describe-it/describe-it
```

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
* tests & documentation
* custom bootstrap file
* interactive mode using `--watch`
* code-coverage (probably using `istanbul`)

### License

Describe-it is licensed under MIT license.
See [license file](license.md) for more information.

© 2016 [Sebastian Łepczyński](https://github.com/lepczynski-s)