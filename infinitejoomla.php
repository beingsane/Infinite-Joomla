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

class plgSystemInfinitejoomla extends JPlugin
{

	function onBeforeRender()
	{
		$app = JFactory::getApplication();
		$doc = JFactory::getDocument();

		if ($app->isAdmin())
		{
			return;
		}

		$doc->addScript(JURI::base(true) . '/media/js/jquery.infinitescroll.min.js');

		// See https://github.com/infinite-scroll/infinite-scroll#options for more options that can be added here.
		$js = "
      window.InfiniteConfig = {
          container   : '" . $this->params->get('container') . "',
          navSelector : '" . $this->params->get('navSelector') . "',
          nextSelector: '" . $this->params->get('nextSelector') . "',
          itemSelector: '" . $this->params->get('itemSelector') . "',
          contentSelector: '" . $this->params->get('contentSelector') . "',
          baseURL     : '',
          finishedMsg : '" . $this->params->get('finishedMsg') . "',
          msgText     : '" . $this->params->get('msgText') . "'
      }
  ";
		$doc->addScriptDeclaration($js);
	}
}