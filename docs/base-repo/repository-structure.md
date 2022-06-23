# Project Structure

Two new directories, `App/Repositories` and `App/Services`, were added to Laravels default installation to provide better structure to our applications. Nonetheless, this doesn't mean you shouldn't be concerned about your projects' architecture by implementing the appropriate patterns.

## Application structure

### App/Repositories

As the name suggests the applications' repositories can be found in the `./app/Repositories` directory. At the root level you can find all the interfaces for each repository type. The implementation of these repositories can be found inside of the Eloquent directory. This does mean that if you are using something else other than eloquent, you should create a new directory and create your repositories there. You can register new repositories in `./app/Providers/RepositoryServiceProvider.php`.

> **Note:** Every repository should have its own interface.

### App/Services

You can write all of your services in `./app/Services`.

## SCSS

### Structure

We're following the [7-1 SASS architecture](https://sass-guidelin.es/#the-7-1-pattern) and the recommended boilerplate as defined by the [SASS guidelines](https://sass-guidelin.es/).

## Blade

### Structure

We're following the [7-1 SASS architecture](https://sass-guidelin.es/#the-7-1-pattern) and the recommended boilerplate as defined by the [SASS guidelines](https://sass-guidelin.es/).

### Available components

There are several components that can be used across different projects. Each component is fully styled and can be found in their respective directory in [resources/components/partials](../../resources/views/components/partials/):

- Buttons
  - Primary
  - Secondary
  - Icon
- Tables
  - Heading
  - Cell
- Forms
  - Layouts
  - Feedback messages
  - Fields
    - Input
    - Toggle

Examples of their implementations can be found in the views in the [pages/users](../../resources/views/pages/users/) directory
