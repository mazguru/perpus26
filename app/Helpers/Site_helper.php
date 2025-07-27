<?php

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;
use App\Models\LinksModel;
use App\Models\TagsModel;
use App\Models\BannersModel;
use App\Models\QuotesModel;
use App\Models\ImageSlidersModel;
use App\Models\QuestionsModel;
use App\Models\AnswersModel;
use App\Models\PostCommentsModel;
use App\Models\VideosModel;
use App\Models\AlbumsModel;
use App\Models\MenuModel;
use App\Models\CategoriesModel;
use App\Models\PostsModel;

if (!function_exists('get_latest_posts')) {
	function get_latest_posts($limit = 0)
	{
		return model(PostsModel::class)->get_latest_posts($limit);
	}
}


if (!function_exists('get_menus')) {
	function get_menus()
	{
		return model(MenuModel::class)->nested_menus();
	}
}

if (!function_exists('recursive_list')) {
	function recursive_list($menus)
	{
		$nav = '';
		foreach ($menus as $menu) {
			$url = $menu['menu_url'] == '#' ? '#' : base_url($menu['menu_url']);
			if ($menu['menu_type'] == 'links') {
				$url = $menu['menu_url'];
			}
			$nav .= '<li>';
			$nav .= '<a href="' . $url . '" target="' . $menu['menu_target'] . '">' . strtoupper($menu['menu_title']) . '</a>';
			$sub_nav = recursive_list($menu['children']);
			if ($sub_nav) {
				$nav .= "<ul>" . $sub_nav . "</ul>";
			}
			$nav .= "</li>";
		}
		return $nav;
	}
}


if (!function_exists('strip_tags_truncate')) {
	function strip_tags_truncate($string, $length = 150)
	{
		$string = strip_tags($string);
		if (strlen($string) <= $length) return $string;
		$string = substr($string, 0, $length);
		$last_space = strrpos($string, ' ');
		if ($last_space !== false) {
			$string = substr($string, 0, $last_space);
		}
		return $string . '...';
	}
}
