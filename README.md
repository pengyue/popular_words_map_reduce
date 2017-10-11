SecretSales Candidate Task
===============================

### Objective

To demonstrate your OOP and unit testing skills.

### Task

Write a console command tool that consumes a text file from the URL below, and outputs the
100 most frequent words in the following format:
word1,count
word2,count
word3,count
...
URL: https://s3-eu-west-1.amazonaws.com/secretsales-dev-test/interview/flatland.txt

### Assessment

The goal of the task is to show your understanding of modern coding standards
and practices. Our focus is not only on solving the problem, but the elegancy of the solution and
tests - it’s certainly ok to overengineer it.

================ Task README =====================


# SecretSales Report Task project

The project is to create a command to generate a top x popular words report on a given number.
It uses Symfony 3 framework and implemented with customized template, it utilizes dependency injection,
service container, unit tests, integration tests, behat tests, SOLID design pattern such as observer pattern.
100% code coverage on the main logic directories (src/) could be achieved, however, due to time limit, a few demo test class are written.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. 
See deployment for notes on how to deploy the project on a live system.

To start this project, use composer update to install all the dependencies


### Prerequisites

None


### Installing

A step by step series of examples that tell you have to get a development env running.

The report can be generate by running a symfony console command, the console command is located at
bin/console, the source data file is at var/storage/data.csv, and the output report file will 
generated at var/storage/report.csv. The code review report can be located at var/storage/code-coverage, 
the behat tests can be located at ./features 

Firs of all, install the project dependencies

```
Composer update
```

To generate top 100 popular words, 100 could be any positive integer run the command

```
php bin/console report:popular_words 100
```

Please review the report csv file when each command is run, for example, it look like

```
Popular_Word,Count
the,1980
of,1412
and,973
to,971
a,813
i,709
in,605
that,463
is,383
```


## Running the tests

There are 3 kinds of automated tests, unit tests, integration test and behat tests

### Break down into end to end tests

To run unit tests with default Nyancat output.

```
vendor/phpunit/phpunit/phpunit tests/unit
```

To run unit tests with plain PHPUnit output.

```
vendor/phpunit/phpunit/phpunit tests/unit --printer PHPUnit_TextUI_ResultPrinter
```

To run integration tests.

```
vendor/phpunit/phpunit/phpunit tests/integration
```

To run tests with generated code coverage, however, due to not all the tests have been written, code-coverage might not be good, but it would be simple to implement

```
vendor/phpunit/phpunit/phpunit tests/ --coverage-clover=var/code-coverage/phpcov-unit.xml --coverage-html=var/code-coverage/phpcov-unit.html
```

To run behat tests.

```
vendor/behat/behat/bin/behat
```


### Dependency checks

The code has been run with the deptrac to verify any dependency violations. The dependencies diagram
can be found at var/artifacts/deptrac/dependeencies.png.

To run the command below to generate the report, before running the command, please install graphviz first.
(Please refer to https://github.com/sensiolabs-de/deptrac for installation), you also need to install graphviz by

```
sudo apt-get install graphviz -y
```

```
php deptrac.phar analyze depfile.yml --formatter-graphviz-dump-image=var/artifacts/deptrac/dependencies.png
```

### Docker build

The Dockerfile has been added, to generate a new image, please run command below, 
remember removing 'vendor' and 'var/cache/*' before

```
docker build -t secretsales-task .
```


### And coding style tests

The code follows PSR/2 code standard, and use PSR-0 autoloading


## Deployment

There is no live deployment


## Contributing

None


## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/pengyue/Awin-ReportTask/tags). 


## Authors

* **Peng Yue** - *Initial work* - [ReportTask](https://github.com/pengyue/Awin-ReportTask)

See also the list of [contributors](https://github.com/pengyue/Awin-ReportTask/contributors) who participated in this project.


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
