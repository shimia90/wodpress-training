<?php
class Zendvn_Mp_Mb_Taxonomy {

    private $_prefix_name  =   'zendvn-mp-taxonomy-category';

    private $_prefix_id    =   'zendvn-mp-taxonomy-category-';

    public function __construct() {

        if(is_admin()) {
            add_action('category_add_form_fields', array($this, 'add_form'));

            add_action('category_edit_form_fields', array($this, 'edit_form'));

            if(isset($_GET['taxonomy']) && $_GET['taxonomy'] == 'category') {

                add_action('admin_enqueue_scripts', array($this, 'add_js_file'));

                add_action('admin_enqueue_scripts', array($this, 'add_css_file'));
            }

            //add_css_file

            add_action('edited_category', array($this, 'save'));

            add_action('create_category', array($this, 'save'));
        } else {
            add_filter('template_include', array($this, 'load_template'));
        }

    }

    public function load_template($template_file) {
        global $wp;
        global $wp_query;
        global $zendvn_mp_taxonomy_category;

        if(is_category()) {
            $cat_id         =   $wp_query->query_vars['cat'];
            $option_name    =   $this->_prefix_name . '-'. $cat_id;
            $option_value   =   get_option($option_name, array());
            $zendvn_mp_taxonomy_category    =   $option_value;
            if(count($option_value) > 0) {
                $file = ZENDVN_MP_METABOX_DIR . '/templates/category.php';
                if(file_exists($file)) {
                    $template_file  =   $file;
                }
            }


        }

        return $template_file;
    }

    public function save($term_id) {

        if(isset($_POST[$this->_prefix_name])) {
            $option_name    =   $this->_prefix_id . $term_id;
            update_option($option_name, $_POST[$this->_prefix_name]);
        }
    }

    public function add_form() {
        global $post;
        $htmlObj    =   new ZendvnHtml();

        //Tao phan tu chua Button
        $inputID 	= $this->create_id('button');
        $inputName 	= $this->create_id('button');
        $inputValue = translate('Media Library Image');
        $arr 		= array('class' =>'button-secondary','id' => $inputID);
        $options	= array('type'=>'button');
        $btnMedia	= $htmlObj->button($inputName,$inputValue,$arr,$options);

        //Tao phan tu chua Picture
        $inputID 	= $this->create_id('picture');
        $inputName 	= $this->create_name('picture');
        $inputValue = '';
        $arr 		= array('size' =>'40','id' => $inputID);
        $html 		= '<div class="form-field">'
                        . $htmlObj->label(translate('Picture'), array('for' => 'tag-name'))
                        . $htmlObj->textbox($inputName,$inputValue,$arr)
                        . ' ' . $btnMedia
                        . $htmlObj->pTag('Mo ta cho phan hinh anh')
                        .'</div>';
        echo $html;

        echo $htmlObj->btn_media_script($this->create_id('button'),$this->create_id('picture'));

        // Tao phan tu profile
        $inputID        =   $this->create_id('summary');
        $inputName      =   $this->create_name('summary');
        $inputValue     =   '';
        $arr            =   array('id' => $inputID, 'rows' => 6, 'cols' => 60);

        $html           =      '<div class="form-field">'
                                    . $htmlObj->label(translate('Summary'), array('for' => 'tag-name'))
                                    . $htmlObj->textarea($inputName, $inputValue, $arr)
                                    . $htmlObj->pTag('Mo ta cho Summary')
                                . '</div>';

        echo $html;
    }

    public function edit_form($term) {

        $option_name    =   $this->_prefix_id . $term->term_id;
        $option_value   =   get_option($option_name);

        global $post;
        $htmlObj    =   new ZendvnHtml();

        //Tao phan tu chua Button
        $inputID 	= $this->create_id('button');
        $inputName 	= $this->create_id('button');
        $inputValue = translate('Media Library Image');
        $arr 		= array('class' =>'button-secondary','id' => $inputID);
        $options	= array('type'=>'button');
        $btnMedia	= $htmlObj->button($inputName,$inputValue,$arr,$options);

        //Tao phan tu chua Picture
        $inputID 	     = $this->create_id('picture');
        $inputName 	     = $this->create_name('picture');
        $inputValue      = @$option_value['picture'];
        $arr 		     = array('size' =>'40','id' => $inputID);
        $lblPicture 	 = $htmlObj->label(translate('Picture'), array('for' => $inputID));
        $inputPicture    = $htmlObj->textbox($inputName,$inputValue,$arr);
        $pPicture        = $htmlObj->pTag('Mo ta cho phan hinh anh', array('class' => 'description'));
        //echo $html;

        $jsMedia         = $htmlObj->btn_media_script($this->create_id('button'),$this->create_id('picture'));

        // Tao phan tu profile
        $inputID        =   $this->create_id('summary');
        $inputName      =   $this->create_name('summary');
        $inputValue     =   @$option_value['summary'];
        $arr            =   array('id' => $inputID, 'rows' => 6, 'cols' => 60);

        $lblSummary     =   $htmlObj->label(translate('Summary'), array('for' => $inputID));
        $inputSummary   =   $htmlObj->textarea($inputName, $inputValue, $arr);
        $pSummary       =   $htmlObj->pTag('Mo ta cho Summary', array('class' => 'description'));

        //echo $html;

        require_once ZENDVN_MP_PLUGIN_VIEW_DIR . '/taxonomy-category.php';
    }

    private function create_name($value) {
        return $this->_prefix_name . '[' . $value . ']';
    }

    private function create_id($value) {
        return $this->_prefix_id . $value;
    }

    public function add_js_file() {
        wp_register_script('zendvn_mp_mb_btn_media', ZENDVN_MP_JS_URL . '/zendvn-media-button.js', array('jquery', 'media-upload', 'thickbox'), '1.0');
        wp_enqueue_script('zendvn_mp_mb_btn_media');
    }

    public function add_css_file() {
        wp_enqueue_style('thickbox');
    }

}