<?php
/**
 * @version		$Id: k2.php 1812 2013-01-14 18:45:06Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2013 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die ;

jimport('joomla.plugin.plugin');
jimport('joomla.html.parameter');

class plgSearchK2cat extends JPlugin
{

    function onContentSearchAreas()
    {
        return $this->onSearchAreas();
    }

    function onContentSearch($text, $phrase = '', $ordering = '', $areas = null)
    {
        return $this->onSearch($text, $phrase, $ordering, $areas);
    }

    function onSearchAreas()
    {
        JPlugin::loadLanguage('plg_search_k2cat', JPATH_ADMINISTRATOR);
        static $areas = array('k2' => 'K2_ITEMSCATS');
        return $areas;
    }

    function onSearch($text, $phrase = '', $ordering = '', $areas = null)
    {
        JPlugin::loadLanguage('plg_search_k2', JPATH_ADMINISTRATOR);
        jimport('joomla.html.parameter');
        $mainframe = JFactory::getApplication();
        $db = JFactory::getDBO();
        $jnow = JFactory::getDate();
        $now = K2_JVERSION == '15' ? $jnow->toMySQL() : $jnow->toSql();

        $nullDate = $db->getNullDate();
        $user = JFactory::getUser();
        if (K2_JVERSION != '15')
        {
            $accessCheck = " IN(".implode(',', $user->getAuthorisedViewLevels()).") ";
        }
        else
        {
            $aid = $user->get('aid');
            $accessCheck = " <= {$aid} ";
        }
        $tagIDs = array();
        $itemIDs = array();

        require_once (JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_search'.DS.'helpers'.DS.'search.php');
        require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php');

        $searchText = $text;
        if (is_array($areas))
        {
            if (!array_intersect($areas, array_keys($this->onSearchAreas())))
            {
                return array();
            }
        }

        $plugin = JPluginHelper::getPlugin('search', 'k2cat');
        $pluginParams = class_exists('JParameter') ? new JParameter($plugin->params) : new JRegistry($plugin->params);

        $limit = $pluginParams->def('search_limit', 50);

        $text = JString::trim($text);
        if ($text == '')
        {
            return array();
        }

        $rows = array();

        if ($limit > 0)
        {

            if ($pluginParams->get('search_tags'))
            {
                $tagQuery = JString::str_ireplace('*', '', $text);
                $words = explode(' ', $tagQuery);
                for ($i = 0; $i < count($words); $i++)
                {
                    $words[$i] .= '*';
                }
                $tagQuery = implode(' ', $words);
                $escaped = K2_JVERSION == '15' ? $db->getEscaped($tagQuery, true) : $db->escape($tagQuery, true);
                $tagQuery = $db->Quote($escaped, false);

                $query = "SELECT id FROM #__k2_tags WHERE MATCH(name) AGAINST ({$tagQuery} IN BOOLEAN MODE) AND published=1";
                $db->setQuery($query);
                $tagIDs = K2_JVERSION == '30' ? $db->loadColumn() : $db->loadResultArray();

                if (count($tagIDs))
                {
                    JArrayHelper::toInteger($tagIDs);
                    $query = "SELECT itemID FROM #__k2_tags_xref WHERE tagID IN (".implode(',', $tagIDs).")";
                    $db->setQuery($query);
                    $itemIDs = K2_JVERSION == '30' ? $db->loadColumn() : $db->loadResultArray();
                }
            }

            if ($phrase == 'exact')
            {
                $text = JString::trim($text, '"');
                $escaped = K2_JVERSION == '15' ? $db->getEscaped($text, true) : $db->escape($text, true);
                $text = $db->Quote('"'.$db->getEscaped($text, true).'"', false);
            }
            else
            {
	            /*
                $text = JString::str_ireplace('*', '', $text);
                $words = explode(' ', $text);
                for ($i = 0; $i < count($words); $i++)
                {
                    if ($phrase == 'all')
                        $words[$i] = '+'.$words[$i];
                    $words[$i] .= '*';
                }
                $text = implode(' ', $words);
                $escaped = K2_JVERSION == '15' ? $db->getEscaped($text, true) : $db->escape($text, true);
                $text = $db->Quote($escaped, false);
	            */
            }


            $query = "
		SELECT i.id, i.name AS title,
	    i.description AS text
    	FROM #__k2_categories AS i

		WHERE (";

	    $query .= 'i.name LIKE "%'.$text.'%")';

		/*
            if ($pluginParams->get('search_tags') && count($itemIDs))
            {
                JArrayHelper::toInteger($itemIDs);
                $query .= " i.id IN (".implode(',', $itemIDs).") OR ";
            }
            //$query .= "MATCH(i.title, i.introtext, i.`fulltext`,i.extra_fields_search,i.image_caption,i.image_credits,i.video_caption,i.video_credits,i.metadesc,i.metakey) AGAINST ({$text} IN BOOLEAN MODE)
		)
		. "
		*/

	    $query .= " AND i.trash = 0 AND i.published = 1 AND i.trash = 0";

	    /*
            if (K2_JVERSION != '15' && $mainframe->isSite() && $mainframe->getLanguageFilter())
            {
                $languageTag = JFactory::getLanguage()->getTag();
                $query .= " AND c.language IN (".$db->Quote($languageTag).", ".$db->Quote('*').") AND i.language IN (".$db->Quote($languageTag).", ".$db->Quote('*').") ";
            }
	        /*
            $query .= " GROUP BY i.id ";

            switch ($ordering)
            {
                case 'oldest' :
                    $query .= 'ORDER BY i.created ASC';
                    break;

                case 'popular' :
                    $query .= 'ORDER BY i.hits DESC';
                    break;

                case 'alpha' :
                    $query .= 'ORDER BY i.title ASC';
                    break;

                case 'category' :
                    $query .= 'ORDER BY c.name ASC, i.title ASC';
                    break;

                case 'newest' :
                default :
                    $query .= 'ORDER BY i.created DESC';
                    break;
            }*/


            $db->setQuery($query, 0, $limit);
            $list = $db->loadObjectList();
            $limit -= count($list);
            if (isset($list))
            {
                foreach ($list as $key => $item)
                {
                    $list[$key]->href = JRoute::_(K2HelperRoute::getCategoryRoute($item->id));
	                $list[$key]->created = "";
	                $list[$key]->section = "";
                }
            }
            $rows[] = $list;
        }

        $results = array();
        if (count($rows))
        {
            foreach ($rows as $row)
            {
                $new_row = array();
                foreach ($row as $key => $item)
                {
                    $item->browsernav = '';
                    $item->tag = $searchText;
                    if (searchHelper::checkNoHTML($item, $searchText, array('text', 'title', 'metakey', 'metadesc', 'section', 'image_caption', 'image_credits', 'video_caption', 'video_credits', 'extra_fields_search', 'tag')))
                    {
                        $new_row[] = $item;
                    }
                }
                $results = array_merge($results, (array)$new_row);
            }
        }

        return $results;
    }

}
