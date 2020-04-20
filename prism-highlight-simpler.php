<?php

namespace Grav\Plugin;

use Grav\Common\Inflector;
use \Grav\Common\Plugin;
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
        ];
    }

    /**
     * Initialize configuration
    */
    public function onPageInitialized()
    {
        if ($this->isAdmin()) {
            $this->active = false;
            return;
        }

        $defaults = (array)$this->config->get('plugins.prism-highlight-simpler');

        /** @var Page $page */
        $page = $this->grav['page'];
        if (isset($page->header()->prism)) {
            $this->config->set('plugins.prism-highlight-simpler', array_merge($defaults, $page->header()->prism));
        }
        if ($this->config->get('plugins.prism-highlight-simpler.enabled')) {
            $this->enable([
                'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
            ]);
        }
    }

    public function onTwigSiteVariables()
    {
        $theme = $this->config->get('plugins.prism-highlight-simpler.theme');
        $this->grav['assets']->addCss('plugin://prism-highlight-simpler/css/prism.css');
        $this->grav['assets']->addCss('plugin://prism-highlight-simpler/css/themes/' . $theme);
        $this->grav['assets']->addJs('plugin://prism-highlight-simpler/js/prism.js', null, true, null, 'bottom');

        $default_language = $this->config->get('plugins.prism-highlight-simpler.default-language-toggle');
        $default_language_class = $this->config->get('plugins.prism-highlight-simpler.default-language-value');
        $line_numbers = $this->config->get('plugins.prism-highlight-simpler.line-numbers');
        
        $inline = "";
        
        if ($default_language || $line_numbers) {
            $inline .= "var __prism_nodes = null;\n";
        }

        if ($default_language) {
            $inline .= "__prism_nodes = document.querySelectorAll('pre:not([class*=\"language-\"])');\n";
            $inline .= $this->_addJsClass('language-'.$default_language_class);
        }

        if ($line_numbers) {
            $inline .= "__prism_nodes = document.querySelectorAll('pre');\n";
            $inline .= $this->_addJsClass('line-numbers');
        }

        if ($inline) {
            $this->grav['assets']->addInlineJs($inline, null, 'bottom');
        }
    }

    public static function themeOptions()
    {
        $options = [];

        $theme_files = glob(__dir__ . '/css/themes/*.css');
        foreach ($theme_files as $theme_file) {
            $theme = basename($theme_file);
            $options[$theme] = Inflector::titleize($theme);
        }

        return $options;
    }

    private function _addJsClass($class = '') {
        return "__prism_nodes.forEach(function(node) { node.classList.add('" . $class . "'); });\n";
    }
}
