<?php
class Rcl_Tabs{
    public $id;
    public $callback;
    public $user_LK;
    public $name;
    public $class;
    public $public;
    public $output;
    function __construct($data){

        $idkey = $data['id'];
        $name = $data['name'];
        $callback = $data['callback'];
        $args = $data['args'];

        $this->id = $idkey;
        $this->name = $name;
        $this->callback = $callback;
        $this->output = (isset($args['output']))? $args['output']: null;
        //print_r($data);
        if(isset($args['class'])) $this->class = $args['class'];
        if(isset($args['order'])) $ord = $args['order'];
        else $ord = 10;
        if(!$this->class) $this->class = 'fa-cog';
        $this->public = (!isset($args['public'])) ? 0 : $args['public'];
        //print_r($args);
        if(isset($args['path'])) $this->key = rcl_key_addon(pathinfo($args['path']));

        add_filter('the_block_wprecall',array(&$this, 'add_tab'),$ord,2);
        if($name){
            if(isset($this->output)) add_filter('rcl_'.$this->output.'_lk',array(&$this,'add_button'),$ord,2);
            else add_filter('the_button_wprecall',array(&$this, 'add_button'),$ord,2);
        }
    }
    function add_tab($block_wprecall='',$author_lk){
        global $user_ID,$rcl_options;
        switch($this->public){
            case 0: if(!$user_ID||$user_ID!=$author_lk) return $block_wprecall; break;
            case -1: if(!$user_ID||$user_ID==$author_lk) return $block_wprecall; break;
            case -2: if($user_ID&&$user_ID==$author_lk) return $block_wprecall; break;
        }
        if(!rcl_chek_view_tab($block_wprecall,$this->id)) return $block_wprecall;

        $status = (!$block_wprecall) ? 'active':'';

        $cl_content = rcl_callback_tab_func($this->callback,$author_lk);
        if(!$cl_content) return $content;

        //$cl_content = apply_filters('rcl_'.$this->callback.'_lk',$cl_content);

        $block_wprecall .= '<div id="tab-'.$this->id.'" class="'.$this->id.'_block recall_content_block '.$status.'">'
        . $cl_content
        . '</div>';

        return $block_wprecall;
    }
    function add_button($button,$author_lk){
        global $user_ID;
        switch($this->public){
            case 0: if(!$user_ID||$user_ID!=$author_lk) return $button; break;
            case -1: if(!$user_ID||$user_ID==$author_lk) return $button; break;
            case -2: if($user_ID&&$user_ID==$author_lk) return $button; break;
        }
        $args = array(
            'id_tab' => $this->id,
            'name' => $this->name,
            'class' => $this->class
        );
        if($this->output&&$button=='') $button = false;
        if(isset($this->key)) $args['key'] = $this->key;
        return rcl_get_button_tab($args,$button);
    }

}

function rcl_get_button_tab($args,$button=false){
	global $rcl_options,$user_LK;
	$link = rcl_format_url(get_author_posts_url($user_LK),$args['id_tab']);
	/*if(!$button) $status = 'active';
        else $status = '';*/
        $html_button = rcl_get_button($args['name'],$link,array('class'=>rcl_get_class_button_tab($button,$args['id_tab']),'icon'=>$args['class']));
	$button .= apply_filters('rcl_get_button_tab',$html_button,$args);

	return $button;
}

add_filter('rcl_get_button_tab','rcl_add_parent_tags_tab_button',10,2);
function rcl_add_parent_tags_tab_button($button,$args){
    return sprintf('<span class="rcl-tab-button" data-tab="%s" id="tab-button-%s">%s</span>',$args['id_tab'],$args['id_tab'],$button);
}

function rcl_chek_view_tab($block_wprecall,$idtab){
	global $rcl_options;
        $tb = (isset($rcl_options['tab_newpage']))? $rcl_options['tab_newpage']:false;
	if($tb){
		if((!isset($_GET['tab'])&&$block_wprecall)||(isset($_GET['tab'])&&$_GET['tab']!=$idtab)) return false;
	}
	return true;
}

function rcl_get_class_button_tab($button,$id_tab){
	global $rcl_options,$array_tabs;
	//print_r($rcl_options);
        $class = false;
        $tb = (isset($rcl_options['tab_newpage']))? $rcl_options['tab_newpage']:false;
	if(!$tb) $class = 'block_button';
	if($tb==2&&isset($array_tabs[$id_tab])) $class = 'ajax_button';
	if($button==''&&$button!==false) $class .= ' active';
	return $class;
}

function rcl_callback_tab_func($function,$author_lk){
    if(is_array($function)){
        $obj = new $function[0];
        $content = $obj->$function[1]($author_lk);
    }else{
        $content = $function($author_lk);
    }
    return apply_filters('rcl_tab_'.$function,$content);
}
