<?php defined('_JEXEC') or die;

/**
 * File       infinite-joomla.php
 * Created    6/11/13 2:38 PM
 * Author     Matt Thomas | matt@betweenbrain.com | http://betweenbrain.com
 * Support    https://github.com/betweenbrain/
 * Copyright  Copyright (C) 2013 betweenbrain llc. All Rights Reserved.
 * License    GNU GPL v3 or later
 */

// Import library dependencies
jimport('joomla.plugin.plugin');

class plgSystemInfinitejoomla extends JPlugin {

	function onBeforeRender() {

		$app          = JFactory::getApplication();
		$doc          = JFactory::getDocument();
		$container    = htmlspecialchars($this->params->get('container', '#k2Container'));
		$itemSelector = htmlspecialchars($this->params->get('itemSelector', '.itemContainer'));
		$navSelector  = htmlspecialchars($this->params->get('navSelector', '.k2Pagination'));
		$nextSelector = htmlspecialchars($this->params->get('nextSelector', '.pagination a[title=Next]'));

		if ($app->isAdmin()) {
			return;
		}

		$js = <<<JS
(function ($) {
	"use strict";
	$().ready(function () {
		$('{$container}').infinitescroll({
			navSelector : "{$navSelector}",
			nextSelector: "{$nextSelector}",
			itemSelector: "{$itemSelector}"
		});
	});
}(jQuery));
JS;

		$doc->addScript(JURI::base(TRUE) . '/media/js/jquery.infinitescroll.min.js');
		$doc->addScriptDeclaration($js);
	}
}