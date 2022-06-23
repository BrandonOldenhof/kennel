# Features

This project is an elaborate attempt to make our projects more consistent, both in their structure and quality. It contains the following:

1. [Devcontainer configuration with workspace settings & extensions](#1-Devcontainer-configuration-with-workspace-settings--extensions)
2. [VSCode extensions, Code linters & formatters with configuration](#2-VSCode-extensions-Code-linters--formatters-with-configuration)
3. [Command to optimize images](#3-Command-to-optimize-images)
4. [Automatic daily image optimization](#4-Automatic-daily-image-optimization)
5. [Browsersync for hot-reloading while developing](#5-Browsersync-for-hot-reloading-while-developing)
6. [Pre-configured security optimizations](#6-Pre-configured-security-optimizations)
7. [TailwindCSS configuration](#7.-TailwindCSS-configuration)
8. [Preset directory structure for resources](#8-Preset-directory-structure-for-resources)
9. [Prebuilt frontend components for buttons, tables & forms,](#9-Prebuilt-frontend-components-for-buttons-tables--forms)
10. [Prebuilt error pages](#10-Prebuilt-error-pages)
11. [Full CRUD example including functionality, database changes, views, authorization & tests](#11-Full-CRUD-example-including-functionality-database-changes-views-authorization--tests)
12. [Accessibility scanning](#12.-Accessibility-scanning)
13. [PR security scanning workflow with OWASP ZAP](#13-PR-security-scanning-workflow-with-OWASP-ZAP)
14. [PR performance scanning workflow with Lighthouse](#14-PR-performance-scanning-workflow-with-Lighthouse)
15. [PR environment configuration with Enlightn](#15-PR-environment-configuration-with-Enlightn)
16. [PR Unit testing workflow with PHPUnit](#16-PR-Unit-testing-workflow-with-PHPUnit)
17. [Pull request template](#17-Pull-request-template)
18. [Bug reporting template](#18-Bug-reporting-template)

## 1. Devcontainer configuration with workspace settings & extensions

The installation instructions can be found in the [main readme](../../readme.md) while more information about the setup can be found in the [devcontainer documentation](./devcontainer.md).

## 2. VSCode extensions, Code linters & formatters with configuration

> Do you have suggestions for extensions, or are you having issues with one of the recommended extensions? Contact [brandon@rox.nl](mailto:brandon@rox.nl)! Don't make changes by yourself because it means the code standards will be different between projects.

We've prepared several workspace presets in [devcontainer.json](../../.devcontainer/devcontainer.json) and [settings.json](../../.vscode/settings.json) & [extensions.json](../../.vscode/extensions.json). These settings & extensions are shared between you and the other developers in the team, and they are leading. The extensions are highly recommended in your local environments and they are automatically installed in the devcontainer.
The editor settings generally overwrite VSCodes user settings.

> If your user settings cause conflicts with the linters please send a message to [brandon@rox.nl](mailto:brandon@rox.nl) so that the workspace settings can be updated to overwrite your user settings to prevent future issues.

There are a couple of linters installed and configured in this project. This will help us maintain good code quality throughout the projects. Each linter has its own configuration.
The linters & formatters included in this repository, and their purpose, can be found in the [Tech stack tools](https://roxmedia.atlassian.net/wiki/spaces/DEV/pages/2176450561/Tech+stack+tools) Confluence page.

**Conventions and configurations should not be modified unless the [brandon@rox.nl](mailto:brandon@rox.nl) agrees to make an exception.**

[Husky](https://github.com/typicode/husky) has been configured to run linters & formatters when the `git push` command is executed. Any type of warnings or errors thrown by the linters will throw an error when committing or pushing your changes. The code has to be fixed before being able to commit and push to the repository .

It's important that all these linters are used to ensure consistency across projects.

**Do not disable the git hooks.**

## 3. Command to optimize images

The [OptimizeImages.php](../../app/Console/Commands/OptimizeImages.php) command can be run with `php artisan image:optimize {path}`, where `{path}` is an optional argument that defaults to the [public/images](../../storage/app/public/images/) directory.

Note: because the command uses the `storage_path()` method it can only run in a subdirectory of the [storage/app](../../storage/app/) directory.

## 4. Automatic daily image optimization

It can be enabled by setting the `IMAGE_OPTIMIZATION` [.env](../../.env) variable to `true`. Setting this variable to `true` will enable the schedule defined in the [Kernel](app/Console/Kernel.php) which will optimize all images in the [storage/app/public/images](../../storage/app/public/images/) directory every night at 01:00.

The directory, frequency and time can be changed in [Kernel](app/Console/Kernel.php):

```php
  $schedule->command('image:optimize private/images')->weekly();
```

Note: because the command uses the `storage_path()` method it can only run in a subdirectory of the [storage/app](../../storage/app/) directory.

## 5. Browsersync for hot-reloading while developing

BrowserSync can automatically monitor your files for changes, and inject your changes into the browser without requiring a manual refresh.
More information [here](https://laravel.com/docs/mix#browsersync-reloading)

Running BrowserSync:

1. Configure the `MIX_BROWSERSYNC_PROXY`. It has to contain URL you use to view the frontend to work properly.
2. Set the `APP_URL` to [http://localhost:3000](http://localhost:3000) in your [.env](../../.env) file.
3. Run `npm run watch`.

## 6. Pre-configured security optimizations

### Middleware optimizations

- Content-Security-Policy (CSP) header: always active through [AddContentSecurityPolicyHeader middleware](../../app/Http/Middleware/AddContentSecurityPolicyHeader.php), it prevents unsafe scrips from being run through inline scripts. The configuration already supports the following scripts: GTM, Google Analytics, Google Fonts, Youtube, Cookiebot & Vimeo.
- HSTS header: always active through [AddHstsHeader middleware](../../app/Http/Middleware/AddHstsHeader.php). More on HSTS on [MDN](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Strict-Transport-Security).
- Referrer-Policy header: always active through [AddReferrerPolicyHeader middleware](../../app/Http/Middleware/AddReferrerPolicyHeader.php), this header disallows accessing of cookies by third-parties.
- X-Content-Type header: always active through [AddXContentTypeOptionsHeader middleware](../../app/Http/Middleware/AddXContentTypeOptionsHeader.php), this header prevents MIME-type sniffing by browsers.
- X-Frame-Options header: always active through [AddXFrameOptionsHeader middleware](../../app/Http/Middleware/AddXFrameOptionsHeader.php). More on XFrame on [MDN](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-Frame-Options).
- HTTPS forcing: always active when `APP_ENV` is set to `production` through [ForceHttps middleware](../../app/Http/Middleware/ForceHttps.php)
- Basic Auth: only active when `BASIC_AUTH` is set to `true` through [BasicAuth middleware](../../app/Http/Middleware/BasicAuth.php). This is primarily useful for the Testing & Acceptance environments. The basic auth functionality uses the credentials from the Users table, where the "email" field is used as the username and the "password" field is used as the password. More on Laravel's basic auth in the [Laravel Docs](https://laravel.com/docs/authentication#http-basic-authentication).

Testing tools:

- https://csp-evaluator.withgoogle.com/
- https://observatory.mozilla.org/

The middleware are fully unit-tested and should never be fully disabled or removed because they ensure a minimum level of security for our application.

### Other optimizations

- Configuration of user passwords through the [.env file](../../.env): this should be used to prevent user passwords from being hardcoded into the [UserSeeder](../../database/seeders/UserSeeder.php). More passwords can be configured by adding new keys to the `users` key in the [rox config file](../../config/rox.php).

## 7. TailwindCSS configuration

Preset configuration can be found in the [tailwind.config.js](../../tailwind.config.js) file.
The compilation settings can be found in [webpack.mix.js](../../webpack.mix.js) file.

## 8. Preset directory structure for resources

The [resources](../../resources) directory follows the [7-1 pattern](https://sass-guidelin.es/#the-7-1-pattern) for the blade files & SCSS to make sure that custom SCSS for any of the blade files can be easily found.

## 9. Prebuilt frontend components for buttons, tables & forms

The [components](../../resources/views/components/partials) directory contains several prebuilt [anonymous components](https://laravel.com/docs/blade#anonymous-components) that can be used in other views. An example implementation can be found in the [user views](../../resources/views/pages/users).
Note: these components are the basics. They should be modified to fit your needs.

## 10. Prebuilt error pages

The [components](../../resources/views/errors) directory contains the default error pages for any application. They only contain the most basic information and a button redirecting the user to the homepage, but no navigation or footer.

Note: these components are the basics. They should be modified to fit your needs.

## 11. Full CRUD example including functionality, database changes, views, authorization & tests

The [UserController.php](../../app/Http/Controllers/UserController.php) and the related files contains the required examples to render all the CRUD views for user management and should be used as a starting point.

- Model: [UserModel.php](../../app/Models/User.php)
- Factory: [UserFactory.php](../../database/factories/UserFactory.php)
- Migration: [create_users_table.php](../../database/migrations/2014_10_12_000000_create_users_table.php)
- Seeder: [UserSeeder.php](../../database/seeders/UserSeeder.php)
- Controller: [UserController.php](../../app/Http/Controllers/UserController.php)
- Requests:
  - [UserDestroyRequest.php](../../app/Http/Requests/UserDestroyRequest.php)
  - [UserStoreRequest.php](../../app/Http/Requests/UserStoreRequest.php)
  - [UserUpdateRequest.php](../../app/Http/Requests/UserUpdateRequest.php)
- Views:
  - [create.blade.php](../../resources/views/pages/users/create.blade.php)
  - [edit.blade.php](../../resources/views/pages/users/edit.blade.php)
  - [index.blade.php](../../resources/views/pages/users/index.blade.php)
- Policy: [UserPolicy.php](../../app/Policies/UserPolicy.php)
- Unit tests: [UserCrudTest.php](../../tests/Feature/Crud/UserCrudTest.php)

## 12. Accessibility scanning

The AXE accessibility scanning is disabled by default but can be enabled by setting the `ACCESSIBILITY_SCANNING` [.env](../../.env) variable to `true` and the `APP_ENV` is not set to `production`. When enabled, the AXE scanner will run its checks on every page load and output its feedback into the browser console.

It relies on the [axe-core](https://github.com/dequelabs/axe-core) dependency, its configuration in [webpack.mix.js](../../webpack.mix.js) and the inclusion of [axe.js](../../public/js/axe.js) in the [template.blade.php & error.blade.php](../../resources/views/base/) files.

## 13. PR security scanning workflow with OWASP ZAP

The OWASP ZAP tool is used for security scanning. It requires quite a bit of project-specific configuration to work properly. Contact [brandon@rox.nl](mailto:brandon@rox.nl) for help and more information with setting this up. When the check is complete it will add a comment containing the score to the PR that started the check.

This workflow will only run against PRs targetting the `Master` branch and can be found in [owasp-zap.yml](../../.github/workflows/owasp-zap.yml).

## 14. PR performance scanning workflow with Lighthouse

Lighthouse is used to test performance & SEO of the application. The URLs that it will check can be defined in [ci/urls.txt](../../ci/urls.txt) where each URL should be added to a new line. When the check is complete it will add a comment containing the score to the PR that started the check.

This workflow will only run against PRs targetting the `Master` branch and can be found in [lighthouse.yml](../../.github/workflows/lighthouse.yml).

## 15. PR environment configuration with Enlightn

This workflow will only run against PRs targetting the `Master` branch and can be found in [enlightn.yml](../../.github/workflows/enlightn.yml). When the check is complete it will add a comment containing the score to the PR that started the check.

## 16. PR Unit testing workflow with PHPUnit

This workflow will only run against PRs targetting the `Master` or the `Development` branch and can be found in [phpunit-tests.yml](../../.github/workflows/phpunit-tests.yml). If a test fails you can see the output of the test in the "checks" tab of the PR.

## 17. Pull request template

The [.github](../../.github) directory contains the [pull request template](../../.github/pull_request_template.md) that will prefill the desciption box whenever a new PR is created. This PR template is based on best practices and enables other automations, such as the Teamwork Sync Action, to run properly. More information about PRs can be found on the [Pull Requests](https://roxmedia.atlassian.net/wiki/spaces/DEV/pages/2226716675/Pull+Requests) page in Confluence.

## 18. Bug reporting template

The Bug reporting template can be found in [bug_reporting_template.md](../../.github/issue_template.md) and is mainly used for reference. Bugs should always be added to the projects Teamwork project instead of the Github.
