<?php

/**
 * Copyright © Owebia. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Owebia\SharedPhpConfig\Block\System\Config\Form\Field;

abstract class Config extends AbstractField
{
    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    abstract protected function getFullscreenTitle(\Magento\Framework\Data\Form\Element\AbstractElement $element);

    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    abstract protected function getHelpUrl(\Magento\Framework\Data\Form\Element\AbstractElement $element);

    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function getHeader(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $elementId = $element->getHtmlId();

        $helpUrl = $this->getHelpUrl($element);
        $helpButton = !$helpUrl ? '' : <<<EOD
            <a target="_blank" class="icon icon-help" href="{$this->escapeHtml($helpUrl)}"
                title="{$this->escapeHtml(__('Help'))}"><span>{$this->escapeHtml(__('Help'))}</span></a>
            EOD;

        return <<<EOD
    <script>
        require([
            'jquery'
        ], function($) {
            $('#$elementId').phpConfigEditor();
        });
    </script>
    <div class="pceHead">
        <div class="pceFullscreenOnly">
            <div class="row">
                <div class="col-l-8 col-m-6">
                    <span class="page-title">{$this->escapeHtml($this->getFullscreenTitle($element))}</span>
                </div>
                <div class="pceToolbar col-l-4 col-m-6">
                    $helpButton
                    <a href="#" class="icon icon-check pceFullscreenOff"
                        title="{$this->escapeHtml(__('Reduce'))}"><span>{$this->escapeHtml(__('Reduce'))}</span></a>
                </div>
            </div>
        </div>
        <div class="pceFullscreenHidden pceToolbar">
            {$this->getToolbarContent($element)}
        </div>
    </div>
EOD;
    }

    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function getToolbarContent(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $elementId = $element->getHtmlId();

        $helpUrl = $this->getHelpUrl($element);
        $helpButton = !$helpUrl ? '' : <<<EOD
            <a target="_blank" class="icon icon-help" href="{$this->escapeHtml($helpUrl)}"
                title="{$this->escapeHtml(__('Help'))}"><span>{$this->escapeHtml(__('Help'))}</span></a>
            EOD;

        return <<<EOD
            <a href="#" class="icon icon-edit pceFullscreenOn"
                title="{$this->escapeHtml(__('Edit'))}"><span>{$this->escapeHtml(__('Edit'))}</span></a>
            $helpButton
            <a target="_blank" class="icon icon-svg" href="{$this->getUrl('owebia_advancedsettingcore/debug/index')}"
                title="{$this->escapeHtml(__('View Debug'))}">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="22" height="23" viewBox="0 0 416 448">
                    <g id="icomoon-ignore"></g>
                    <path d="M408 240q0 6.5-4.75 11.25t-11.25 4.75h-56q0 42.75-16.75 72.5l52 52.25q4.75 4.75 4.75
11.25t-4.75 11.25q-4.5 4.75-11.25 4.75t-11.25-4.75l-49.5-49.25q-1.25 1.25-3.75 3.25t-10.5 7.125-16.25 9.125-20.5
7.25-24.25 3.25v-224h-32v224q-12.75 0-25.375-3.375t-21.75-8.25-16.5-9.75-10.875-8.125l-3.75-3.5-45.75 51.75q-5
5.25-12 5.25-6 0-10.75-4-4.75-4.5-5.125-11.125t3.875-11.625l50.5-56.75q-14.5-28.5-14.5-68.5h-56q-6.5
0-11.25-4.75t-4.75-11.25 4.75-11.25 11.25-4.75h56v-73.5l-43.25-43.25q-4.75-4.75-4.75-11.25t4.75-11.25 11.25-4.75 11.25
4.75l43.25 43.25h211l43.25-43.25q4.75-4.75 11.25-4.75t11.25 4.75 4.75 11.25-4.75 11.25l-43.25 43.25v73.5h56q6.5 0 11.25
4.75t4.75 11.25zM288 96h-160q0-33.25 23.375-56.625t56.625-23.375 56.625 23.375 23.375 56.625z"></path>
                </svg>
            </a>
EOD;
    }

    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function getFooterContent(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return '';
    }

    /**
     * Retrieve element HTML markup
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     * @SuppressWarnings("CamelCaseMethodName")
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return <<<EOD
    <div id="pce_{$element->getHtmlId()}" class="phpConfigEditor">
        {$this->getHeader($element)}
        <div class="pceFieldContainer">{$element->getElementHtml()}</div>
        <div class="pceStatus">
            {$this->getFooterContent($element)}
        </div>
    </div>
EOD;
    }
}
