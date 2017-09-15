<?php

use App\Pages_Data;

function dataPages($key, $page_id, $lang_id){
        
    $match = ['title' => $key, 'page_id' => $page_id, 'lang_id' => $lang_id];

    $results = Pages_Data::where($match)->value('data');

    return $results;

}


function treePages($data, $str = '', $parent_id=0, $level=-1, $lang = '') {

    $html = '<ul class="ui-sortable">';
    $level++;
    $yes=0;

    if($data){
        foreach($data as $item) {

            if ($item->parent_id == $parent_id) {
              $html .= '<li id="'.$item->id.'">';
              $html .= '<span class="button-checkbox">
                          <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;'.dataPages('title', $item->id, Session::get('applocale')).'</button>
                          <input class="hidden" name="chckbx[]" type="checkbox" value="'.$item->id.'">
                        </span>';
              $html .= treePages($data, $str, $item->id, $level, Session::get('applocale'));
              $html .= '</li>';
              $yes++;
            }

        }
    }else{
        return '<div class="alert alert-danger" role="alert">გვერდი არ მოიძებნა ბაზაში...</div>';
    }
    
    $html .= '</ul>';
    if ( ! $yes ) $html = '';
    return $html;
}


function treePagesCreate($data, $str = '-', $parent_id=0, $level=-1, $lang = '') {

    $html = '';
    $level++;
    $yes=0;

    foreach($data as $item) {

      if ($item->parent_id == $parent_id) {
        $html .= '<option value="'.$item->id.'">'.str_repeat($str,$level).' '.dataPages('title', $item->id, Session::get('applocale')).'</option>';
        $html .= treePagesCreate($data, $str, $item->id, $level, Session::get('applocale'));
        $yes++;
      }

    }

    $html .= '';
    if ( ! $yes ) $html = '';
    return $html;
}


function data_for_select_tree_edit($name, $data, $selected_id = 0, $class = '', $str=' -', $parent_id=0, $level=-1, $main_id = 0, $lang = '') {
	$html = '';
	$level++;
	$yes=0;
	
	foreach($data as $item) {

		if($item->parent_id == $parent_id) {

			$selected = '';
			if ($item->id == $selected_id) $selected = ' selected="true"';
			$html .= '<option value="'.$item->id.'" '.$selected.'>'.str_repeat($str,$level).' '.dataPages('title', $item->id, Session::get('applocale')).'</option>';
			$html .= data_for_select_tree_edit($name, $data, $selected_id, '', $str, $item->id, $level, 0, Session::get('applocale'));
			$yes++;
		}

	}
	
	$html .= '';
	if ( ! $yes ) $html = '';
	return $html;
}


?>
