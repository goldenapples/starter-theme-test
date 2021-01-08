# Altis Starter Theme

This repository contains a minimalist yet opinionated starter framework for theme development on top of [Altis](https://www.atis-dxp.com/resources/developer-docs). The repository is structured identicaly to the Altis starter project you would install via Composer.

The main pieces of custom code in this project are

- [The starter theme itself](./content/themes/starter): Frontend-facing templates, scripts, and styles
- [The custom blocks plugin](./content/mu-plugins/starter-blocks): Block definitions, block editor plugins, and editor-facing tooling & styles

## Getting Started

### Prerequisites

You need certain pieces of software on your computer before setting up this project locally.

- [Composer](https://getcomposer.org/) for installing PHP dependencies
- [Node](https://nodejs.org/en/) for installing JavaScript dependencies
  - Note: we recommend installing Node with [nvm](https://github.com/nvm-sh/nvm) so you can better control which version is used; run `nvm use` to adopt this project's recommended version
- [Docker](https://docs.docker.com/get-docker/) for running the local server environment
### Installation

To set up this repository for local development, clone it down onto your computer and run the following steps to install Composer and npm dependencies.

```bash
git clone git@github.com:humanmade/starter-theme.git
cd starter-theme
composer install
npm install

composer server start
composer server cli -- theme enable starter --network --activate
```

Once you run `composer server start`, Docker will pull down the local server containers and set up your development environment. The `composer server cli` command then uses WP-CLI to activate our starter theme.

**Your site should now be running at [starter-theme.altis.dev](https://starter-theme.altis.dev)!**

### Setting local constants

To make local development easier, you may want to turn on `WP_DEBUG` or other constants. To do so, create a file `.config/local-config.php` with whatever constant definitions you need:

```php
<?php
/**
 * .config/local-config.php will be loaded when present.
 */

define( 'WP_DEBUG', true );
define( 'SCRIPT_DEBUG', true );

```

### Development Commands

 Command         | Purpose
---------------- | --------
 `npm run lint`  | Run ESLint and PHPCS using the HM Coding Standards
 `npm start`     | Start a hot-reloading local development server
 `npm run build` | Build scripts & styles into production asset bundles

Note that when using the hot-reloading dev server, you may experience browser security errors when the secure `starter-theme.altis.dev` website tries to load files from `localhost` using a self-signed Webpack security certificate. To work around this, you may need to open the URL displaying the console error in your browser and manually accept the certificate.

Depending on the version of browser you use (some Chromium derivatives, for example) and your prior settings, it is possibly easier to specifically configure your browser to "Allow" Insecure Content on the `starter-theme.altis.dev` site. In Chrome you can do this by navigating through the privacy or security settings to adjust the value of "Insecure Content" in the [`starter-theme.altis.dev` browser security preferences](chrome://settings/content/siteDetails?site=https%3A%2F%2Fstarter-theme.altis.dev%2F).
