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

	function onAfterRoute() {

		$app       = JFactory::getApplication();
		$component = JRequest::getCmd('option');
		$doc       = JFactory::getDocument();
		$mode      = $this->params->get('mode');
		$view      = JRequest::getCmd('view', 0);

		if ($app->isAdmin()) {
			return;
		}

		switch ($mode) {
			case "k2":
				if ($component == "com_k2" && $view == "itemlist") {
					$js = <<<JS
				(function ($) {
					"use strict";
					$().ready(function () {
						// infinitescroll() is called on the element that surrounds
						// the items you will be loading more of
						$('#k2Container').infinitescroll({

							navSelector : ".k2Pagination",
							// selector for the paged navigation (it will be hidden)
							nextSelector: ".pagination a[title=Next]",
							// selector for the NEXT link (to page 2)
							itemSelector: ".itemContainer"
							// selector for all items you'll retrieve
						});
					});
				}(jQuery));
JS;
				}
				break;

			default:
				$js = NULL;
		}

		if (!is_null($js)) {
			$doc->addScript(JURI::base(TRUE) . '/media/js/jquery.infinitescroll.min.js');
			$doc->addScriptDeclaration($js);
		}
	}
}