# Devcontainer environment

We're using Docker in the form of a [VSCode Devcontainer](https://code.visualstudio.com/docs/remote/containers) for our local development. This has a couple of benefits:

1. Required extensions will be automatically installed, but only in the Devcontainer, not your normal VSCode setup. This means you wont have any extra extensions slowing down your VSCode outside of this workspace.
2. Everyone shares the same local environment configuration. No more misconfigurations in Valet, MAMP or Docker.
3. People working in this workspace don't need PHP or Node installed locally. This means that designers and frontenders can run backend applications without needing to install all the backend dependencies locally.

[Laravel Sail](https://laravel.com/docs/sail) is the basis of this setup. Laravel Sail contains several Dockerfiles with presets that will work with Laravel. It also comes with support for Devcontainers.

Refer to the [main readme.md](../../readme.md) for more installation instructions.

## Using GIT in the Devcontainer

If you run into issues when trying to push to the remote you should have a look at the [Sharing Git credentials with your container](https://code.visualstudio.com/docs/remote/containers#_sharing-git-credentials-with-your-container) section of the devcontainer documentation.

## Automatic tasks

The Devcontainer automatically runs `npm run watch` when the Devcontainer is opened, running Browsersync to automatically refresh your browser when you change any views, scss, js or PHP files in the `./app` directory.
The benefit of this is that you don't have to switch between your editor and browser to refresh it to see your latest changes; Browsersync handles that for you.

More information about enabling or disabling automatic task running can be found in the [VSCode documentation on task run behaviour](https://code.visualstudio.com/docs/editor/tasks#_run-behavior)
