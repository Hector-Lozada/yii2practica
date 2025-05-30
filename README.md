<p align="center">
  <a href="https://github.com/yiisoft" target="_blank">
    <img src="https://avatars0.githubusercontent.com/u/993323" height="100px" alt="Yii Logo">
  </a>
</p>

<h1 align="center">Yii 2 Basic Project Template</h1>
<p align="center">
  <i>Minimal, elegant, and ready for rapid development.</i>
</p>

---

Yii 2 Basic Project Template is a streamlined skeleton application for [Yii 2](https://www.yiiframework.com/), designed for building robust and maintainable web projects swiftly. It includes essential features such as user authentication and a contact page, with pre-configured settings so you can focus on developing your application's core functionality.

<p align="center">
  <a href="https://packagist.org/packages/yiisoft/yii2-app-basic"><img src="https://img.shields.io/packagist/v/yiisoft/yii2-app-basic.svg" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/yiisoft/yii2-app-basic"><img src="https://img.shields.io/packagist/dt/yiisoft/yii2-app-basic.svg" alt="Total Downloads"></a>
  <a href="https://github.com/yiisoft/yii2-app-basic/actions?query=workflow%3Abuild"><img src="https://github.com/yiisoft/yii2-app-basic/workflows/build/badge.svg" alt="build"></a>
</p>

---

## Directory Structure

```
assets/         Asset bundles & resources
commands/       Console commands
config/         Application configuration
controllers/    Web controllers
mail/           Mail view files
models/         Data models
runtime/        Runtime-generated files
tests/          Automated tests
vendor/         Composer dependencies
views/          View templates
web/            Entry script & web resources
```

---

## Requirements

- PHP **7.4** or newer

---

## Installation

### 1. Composer (Recommended)

```bash
composer create-project --prefer-dist yiisoft/yii2-app-basic basic
```
Then visit: [http://localhost/basic/web/](http://localhost/basic/web/)

### 2. Archive

- Download from [yiiframework.com](https://www.yiiframework.com/download/)
- Extract to your web root (`basic/`)
- Set a secret cookie validation key in `config/web.php`:

```php
'request' => [
    'cookieValidationKey' => '<your-secret-key>',
],
```
Access: [http://localhost/basic/web/](http://localhost/basic/web/)

### 3. Docker

```bash
docker-compose run --rm php composer install
docker-compose up -d
```
App available at: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## Configuration

#### Database

Edit `config/db.php`:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => 'your_password',
    'charset' => 'utf8',
];
```

> **Tip:** Create your database manually before running the app.

---

## Testing

- Uses [Codeception](https://codeception.com/)
- Test suites: `unit`, `functional`, `acceptance`

```bash
vendor/bin/codecept run          # Run all tests
vendor/bin/codecept run unit     # Unit tests only
vendor/bin/codecept run functional   # Functional tests only
```

#### Acceptance Testing

1. Copy `tests/acceptance.suite.yml.example` → `tests/acceptance.suite.yml`
2. Install full Codeception:
    ```bash
    composer require codeception/codeception --dev
    ```
3. Run Selenium or use Docker:
    ```bash
    java -jar selenium-server-standalone.jar
    # or
    docker run --net=host selenium/standalone-firefox:2.53.0
    ```
4. (Optional) Prepare a test database and run migrations:
    ```bash
    tests/bin/yii migrate
    ```
5. Serve test web app:
    ```bash
    tests/bin/yii serve
    ```
6. Run acceptance tests:
    ```bash
    vendor/bin/codecept run acceptance
    ```

#### Code Coverage

Uncomment relevant lines in `codeception.yml` to enable coverage:

```bash
vendor/bin/codecept run --coverage --coverage-html --coverage-xml
```
Results are in `tests/_output/`.

---

## License

Yii 2 Basic Project Template is released under the [BSD-3-Clause License](LICENSE.md).

---

<p align="center"><sub>Elegant. Minimal. Yii 2 Basic.</sub></p>
