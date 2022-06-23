# Important links

- [Repository structure](repository-structure.md)
- [Continous integration](continous-integration.md)
- [Devcontainer](devcontainer.md)
- [FAQ](faq.md)
- [Repository settings](repository-settings.md)

# Introduction

This project is an elaborate attempt to make our projects more consistent, both in their structure and quality. It contains the following:

1. Devcontainer configuration with workspace settings & extensions
2. VSCode extensions, Code linters & formatters with configuration
3. Command to optimize images
4. Automatic daily image optimization
5. Browsersync for hot-reloading while developing
6. Pre-configured security optimizations
7. TailwindCSS configuration
8. Preset directory structure for resources
9. Prebuilt frontend components for buttons, tables & forms,
10. Prebuilt error pages
11. Full CRUD example including functionality, database changes, views, authorization & tests
12. Accessibility scanning
13. PR security scanning workflow with OWASP ZAP
14. PR performance scanning workflow with Lighthouse
15. PR environment configuration with Enlightn
16. PR Unit testing workflow with PHPUnit
17. Pull request template
18. Bug reporting template

More about these features and their configuration in the [features](./features.md) documentation.

## Getting started

1. Create a new repository using the [base-laravel-template repository](https://github.com/roxdigital/base-laravel-template) as the template. More information about how to do this can be found [here](https://docs.github.com/en/repositories/creating-and-managing-repositories/creating-a-repository-from-a-template).
2. Clone the repository to your local machine.
3. Update the main [readme.md](../../readme.md) with the relevant information & push the change to GitHub.
4. Follow the installation instructions in the main [readme.md](../../readme.md) to set up your local environment.

### Syncing changes from upstream to your repo

This base repository will be updated periodically.
To receive the latest changes in the template you have to add this base template repo as an upstream using `git remote add upstream git@github.com:roxdigital/base-laravel-template.git` and pull the latest changes into your repo using `git pull upstream master`.

It's best to do this on a separate feature branch so you can create a PR in your own repo.

> Note: This WILL cause merge conflicts so make sure you have some time in your planning to fix them.

## Bug Reporting

To report any bugs, please add a new task to the [Bugs Backlog](https://projecten.roxmedia.nl/#/tasklists/1087056), according to our company [bug report template](https://roxmedia.atlassian.net/wiki/spaces/AI/pages/1145765903/Bug+reporting). Because Teamwork also supports Markdown you can also copy the contents of the Markdown file in the [issue template](../../.github/issue_template.md) to get started.

## Any Questions?

If you have any queries you can always reach out to brandon@rox.nl.

# Important links

- [Development Guidelines](https://roxmedia.atlassian.net/wiki/spaces/DEV/pages/1159987201/Development+Guidelines)
- [Git branch model](https://roxmedia.atlassian.net/wiki/spaces/DEV/pages/11010102/Git+branch+model)
- [PR best practices](https://roxmedia.atlassian.net/wiki/spaces/DEV/pages/1145634851/PR+Best+Practices)
- [Bug report template](https://roxmedia.atlassian.net/wiki/spaces/AI/pages/1145765903/Bug+reporting)
