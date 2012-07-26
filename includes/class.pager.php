<?php
/*****************************************************
 * Created by: Randy Baker
 * Created on: 23-JUL-2012
 * ---------------------------------------------------
 * Data Paging Class (class.pager.php)
 *****************************************************/

/***************************************
 * Class declaration(s)...
 **************************************/
class Pager 
{
	var $items_per_page;
	var $items_total;
	var $current_page;
	var $num_pages;
	var $mid_range;
	var $low;
	var $high;
	var $limit;
	var $return;
	var $default_ipp = 10;
	var $querystring;

	/***************************************
      * CONSTRUCTOR function...
      **************************************/
	function Pager()
	{
		$this->current_page = 1;
		$this->mid_range = 7;
		$this->items_per_page = ((!empty($_GET['ipp'])) ? ($_GET['ipp']) : ($this->default_ipp));
	}

	/***************************************
     * Perform the pagination...
     **************************************/
	function paginate()
	{
		$arrSearch = array(' ');
		$arrReplace = array('-');
		if ($_GET['ipp'] == 'All')
		{
			$this->num_pages = ceil($this->items_total / $this->default_ipp);
			$this->items_per_page = $this->default_ipp;
		} else {
			if (!is_numeric($this->items_per_page) || $this->items_per_page <= 0) 
			{
				$this->items_per_page = $this->default_ipp;
			}
			$this->num_pages = ceil($this->items_total / $this->items_per_page);
		}
		$this->current_page = (int) $_GET['page']; // This must be numeric > 0...
		if ($this->current_page < 1 || !is_numeric($this->current_page))
		{
			$this->current_page = 1;
		}
		if ($this->current_page > $this->num_pages) 
		{
			$this->current_page = $this->num_pages;
		}
		$prev_page = $this->current_page - 1;
		$next_page = $this->current_page + 1;
		if ($_GET)
		{
			$args = explode('&', $_SERVER['QUERY_STRING']);
			foreach ($args as $arg)
			{
				$keyval = explode('=', $arg);
				if ($keyval[0] != 'page' && $keyval[0] != 'ipp' && $keyval[0] != 'modifier')
				{
					$this->querystring .= '&'. $arg;
				}
			}
		}

		if ($_POST)
		{
			foreach($_POST as $key => $val)
			{
				if ($key != 'page' && $key != 'ipp' && $key != 'modifier') 
				{
					$this->querystring .= "&{$key}={$val}";
				}
			}
		}

		if ($this->num_pages > 10)
		{
			$this->return = ($this->current_page != 1 && $this->items_total >= 10) ? "<a class=\"paginate\" href=\"".str_replace($arrSearch, $arrReplace,$_SERVER['REDIRECT_SCRIPT_URI'])."?page={$prev_page}&ipp={$this->items_per_page}{$this->querystring}\">&laquo; Previous</a> " : "<span class=\"inactive\" href=\"#\">&laquo; Previous</span> ";
			$this->start_range = $this->current_page - floor($this->mid_range / 2);
			$this->end_range = $this->current_page + floor($this->mid_range / 2);
			if ($this->start_range <= 0)
			{
				$this->end_range += abs($this->start_range) + 1;
				$this->start_range = 1;
			}
			if ($this->end_range > $this->num_pages)
			{
				$this->start_range -= $this->end_range - $this->num_pages;
				$this->end_range = $this->num_pages;
			}
			$this->range = range($this->start_range, $this->end_range);
			for ($i=1; $i <= $this->num_pages; $i++)
			{
				if ($this->range[0] > 2 && $i == $this->range[0])
				{
					$this->return .= ' ... ';
				}
				
				// Loop through all pages...
				if ($i == 1 || $i == $this->num_pages || in_array($i, $this->range))
				{
					$this->return .= ($i == $this->current_page && $_GET['page'] != 'All') ? "<a title=\"Go to page {$i} of {$this->num_pages}\" class=\"current\" href=\"#\">{$i}</a> ":"<a class=\"paginate\" title=\"Go to page {$i} of {$this->num_pages}\" href=\"".str_replace($arrSearch, $arrReplace,$_SERVER['REDIRECT_SCRIPT_URI'])."?page={$i}&ipp={$this->items_per_page}{$this->querystring}\">{$i}</a> ";
				}
				if ($this->range[$this->mid_range - 1] < $this->num_pages - 1 && $i == $this->range[$this->mid_range - 1]) $this->return .= ' ... ';
			}
			$this->return .= (($this->current_page != $this->num_pages && $this->items_total >= 10) && ($_GET['page'] != 'All')) ? "<a class=\"paginate\" href=\"".str_replace($arrSearch, $arrReplace,$_SERVER['REDIRECT_SCRIPT_URI'])."?page={$next_page}&ipp={$this->items_per_page}{$this->querystring}\">Next &raquo;</a>\n":"<span class=\"inactive\" href=\"#\">&raquo; Next</span>\n";
			$this->return .= ($_GET['page'] == 'All') ? "<a class=\"current\" style=\"margin-left:10px\" href=\"#\">All</a> \n":"<a class=\"paginate\" style=\"margin-left:10px\" href=\"".str_replace($arrSearch, $arrReplace,$_SERVER['REDIRECT_SCRIPT_URI'])."?page=1&ipp=All{$this->querystring}\">All</a> \n";
		} else {
			for ($i=1; $i <= $this->num_pages; $i++)
			{
				$this->return .= ($i == $this->current_page) ? "<a class=\"current\" href=\"#\">{$i}</a> ":"<a class=\"paginate\" href=\"".str_replace($arrSearch, $arrReplace,$_SERVER['REDIRECT_SCRIPT_URI'])."?page={$i}&ipp={$this->items_per_page}{$this->querystring}\">{$i}</a> ";
			}
			$this->return .= "<a class=\"paginate\" href=\"".str_replace($arrSearch, $arrReplace,$_SERVER['REDIRECT_SCRIPT_URI'])."?page=1&ipp=All{$this->querystring}\">All</a> \n";
		}
		$this->low = ($this->current_page - 1) * $this->items_per_page;
		if ($this->low < 0)
		{
			$this->low = 0;
		}
		$this->high = ($_GET['ipp'] == 'All') ? $this->items_total : ($this->current_page * $this->items_per_page) - 1;
		$this->limit = ($_GET['ipp'] == 'All') ? '' : " LIMIT {$this->low}, {$this->items_per_page}";
	}

	/***************************************
     * Display number of items per page...
     **************************************/
	function display_items_per_page()
	{
		$items = '';
		$arrSearch = array(' ');
		$arrReplace = array('-');
		$ipp_array = array(10, 25, 50, 100, 'All');
		foreach ($ipp_array as $ipp_opt)
		{
			$items .= ($ipp_opt == $this->items_per_page) ? "<option selected value=\"{$ipp_opt}\">{$ipp_opt}</option>\n" : "<option value=\"{$ipp_opt}\">{$ipp_opt}</option>\n";
		}	
		return "<span class=\"paginate\">Items per page:</span><select class=\"paginate\" onchange=\"window.location='".str_replace($arrSearch, $arrReplace,$_SERVER['REDIRECT_SCRIPT_URI'])."?page=1&ipp='+this[this.selectedIndex].value+'{$this->querystring}';return false\">{$items}</select>\n";
	}

	/***************************************
     * Display  the 'Jump To' menu...
     **************************************/
	function display_jump_menu()
	{
		$arrSearch = array(' ');
		$arrReplace = array('-');
		for ($i=1; $i <= $this->num_pages; $i++)
		{
			$option .= ($i == $this->current_page) ? "<option value=\"{$i}\" selected>{$i}</option>\n" : "<option value=\"{$i}\">{$i}</option>\n";
		}
		return "<span class=\"paginate\">Page:</span><select class=\"paginate\" onchange=\"window.location='".str_replace($arrSearch, $arrReplace,$_SERVER['REDIRECT_SCRIPT_URI'])."?page='+this[this.selectedIndex].value+'&ipp={$this->items_per_page}{$this->querystring}';return false\">{$option}</select>\n";
	}

	/***************************************
     * Display the pages (nav)...
     **************************************/
	function display_pages()
	{
		return $this->return;
	}
}
?>