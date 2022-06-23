# Baseline scanning

We've defined a set of [company-wide standards](https://roxmedia.atlassian.net/wiki/spaces/DEV/pages/2176450561/Tech+stack+tools#Baselines) for:

- Accessibility
- Performance
- Security
- SEO

To make it easier to adhere to the standards and reduce the amount of manual work required to test for adherence we've included several Github Action workflows, as defined in [.github/workflows](../../.github/workflows).

## Workflows

This repo contains separate workflows for the [master](../../.github/workflows/pr-master.yml) and [development](../../.github/workflows/pr-development.yml) branches.

Each workflow runs a number of checks against the PR. If one of the checks fails it won't be possible to merge the PR into the branch. The developer will have to update their PR after which the scans will automatically run again.

- Performance scan: [lighthouse.yml](../../.github/workflows/lighthouse.yml)
- Security scan: [owasp-zap.yml](../../.github/workflows/owasp-zap.yml)
- SEO scan: [lighthouse.yml](../../.github/workflows/lighthouse.yml)
- PHPUnit tests: [phpunit-tests.yml](../../.github/workflows/phpunit-tests.yml)

The scans all depend on the [build-laravel.yml](../../.github/workflows/build-laravel.yml) workflow that builds the Laravel application and runs `npm run prod` to compile the frontend assets.
Each scan runs the `php artisan serve` command to expose an endpoint within the workflow that can be used to run the scans.

## Configuration

Some of the scans have to be required using a special config file. These files can be found in [./ci](../../ci) and are named after the scan.
The URLs that are used to run the scans are defined in [./ci/urls.txt](../../ci/urls.txt).
