# Grav Prism Highlighter Simpler Plugin

`Prism Highlighter Simpler` is a [Grav](http://github.com/getgrav/grav) plugin that adds simple and powerful code highlighting functionality utilizing the [Prism.js](http://prismjs.com/) syntax highlighter.

It is mainly based on the [Prism Highlighter plugin by Trilby Media](https://github.com/trilbymedia/grav-plugin-prism-highlight).

But it doesn't need you to use shortcodes to include your code samples! You just have to use the usual Markdown syntax:

```
```bash
$ echo $USER
```


# Installation

<!-- Installing the Highlight plugin can be done in one of two ways. Our GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file. 

## GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's Terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install prism-highlight-simpler

This will install the Highlight plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/prism-highlight-simpler`. -->

## Manual Installation

To install this plugin, just download [the zip version of this repository](https://github.com/bricebou/grav-plugin-prism-highlight-simpler/archive/develop.zip) and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `prism-highlight-simpler`.

You should now have all the plugin files under

    /your/site/grav/user/plugins/prism-highlight-simpler


# Languages included

Prism.js supports currently [210 languages](http://prismjs.com/#languages-list), at the time of this edit, and they are all included in this plugin.

# Plugins Included

This build of Prism also includes the following plugins:

* Line Highlight
* Toolbar
* Copy to Clipboard

# Basic Usage

In your markdown, you can create a block of code, and assign the language to it. You can choose between the list above. 

Example using regular markdown fenced code syntax:

```php
  ```php
  <?php
  
  namespace Grav\Plugin;
  
  use \Grav\Common\Plugin;
  use \Grav\Common\Grav;
  use \Grav\Common\Page\Page;
  
  class PrismHighlightSimplerPlugin extends Plugin
  {
      /**
       * @return array
       */
      public static function getSubscribedEvents()
      {
          return [
              'onPageInitialized' => ['onPageInitialized', 0],
              'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
              'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
          ];
      }
  }
```

# Configuration

Configuration shall be set in `config/plugins/prism-highlight-simpler.yaml`.

```yaml
enabled: true
theme: prism-base16-ocean.dark.css
line-numbers: true  
default-language-toggle: true
default-language-value: txt
```

You can also override configuration settings at the page level by prefixing options with `prism-highlight-simpler:`. For example you could set a different theme, and turning on line numbers on a particular page with:

```yaml
title: My Page
prism-highlight-simpler:
  theme: base16-duotone-dark.light.css
  line-numbers: true 
```


### Themes

The themes available are those of the original plugin (listed in the [README](https://github.com/trilbymedia/grav-plugin-prism-highlight#user-content-themes)).

I've just added my personal theme, using Base2Tone, in different versions; the dark version is the default specified in the config file (`prism-base2tone-momh-dark.css`).