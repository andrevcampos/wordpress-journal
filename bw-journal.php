<?php

/*
Plugin Name: BM_Journal
Plugin URI: https://breezemarketing.co.nz
Description: Journal
Version: 1.0
Author URI: https://breezemarketing.co.nz
Author: Andre Campos
Text Domain: bm-journal
*/ 


// Add Announcement button to wordpress admin menu.
add_action('admin_menu', 'my_menu_pages_query_journal');
function my_menu_pages_query_journal(){
    add_menu_page('Journal', 'Journal', 'manage_options', 'my-menu-journal', 'my_menu_query_output_journal', null, 7 );
    add_submenu_page( 'my-menu-journal', 'New Journal', 'New Journal', 'manage_options', 'my_menu_query_output_journal_add', 'my_menu_query_output_journal_add' );
}

function my_menu_query_output_journal() {

     $plugin_url = plugin_dir_url( __FILE__ );
    // wp_enqueue_style( 'css', $plugin_url . 'css/admin.css' );
     wp_enqueue_script( 'jsjournal', $plugin_url . 'js/js.js' );

    $journalid = $_GET['jid'];
    $journaltype = $_GET['jtype'];
    $pageurl = admin_url(sprintf('admin.php?%s', http_build_query($_GET)));
    $pieces = explode("admin.php", $pageurl);
    $pageurl = $pieces[0];

    if(!$journalid)
    {
        $exampleListTable = new Example_List_Table();
        $exampleListTable->prepare_items();
        echo '<div class="wrap">';
            echo '<div id="icon-users" class="icon32"></div>';
            echo '<h2>Journal List</h2>';
            $exampleListTable->display();
        echo '</div>';

    }else{

        if($journaltype == "edit"){

            $eurl = $plugin_url . 'bm-journal-edit.php';
            $image_url = get_post_meta( $journalid, 'image_url', true );
            $title = get_post_meta( $journalid, 'title', true );
            $subtitle = get_post_meta( $journalid, 'subtitle', true );
            $message = get_post_meta( $journalid, 'message', true );
            $link = get_post_meta( $journalid, 'link', true );
            
                echo '

                <div class="wrap">
                    <h2>Edit Journal</h2>
                </div>
                
                <br>

                <div class="wrap">
                    <h3>Title*</h3>
                </div>

                <input type="text" value="'.$title.'" name="ejournaltitle" id="ejournaltitle" class="regular-text"><br><br>

                <div class="wrap">
                    <h3>Sub-Title</h3>
                </div>

                <input type="text" value="'.$subtitle.'" name="ejournalsubtitle" id="ejournalsubtitle" class="regular-text"><br><br>

                <div class="wrap">
                    <h3>Message*</h3>
                </div>

                <textarea id="ejournalmessage" name="ejournalmessage" rows="4" cols="50">'.$message.'</textarea><br><br>

                <div class="wrap">
                    <h3>Image*</h3>
                </div>

                <input type="text" value="'.$image_url.'" name="eimage_urll2" id="eimage_urll2" class="regular-text">

                <input type="button" style="width:150px;" name="euploadd-btn" id="euploadd-btn" class="button-secondary" value="Upload Image"><br><br>

                <div class="wrap">
                    <h3>Link</h3>
                </div>

                <input type="text" value="'.$link.'" name="ejournallink" id="ejournallink" class="regular-text"><br><br>

                <div class="wrap">

                    <div id="ebm-journal-button" onclick="ejournalbuttonsave(\''.$eurl.'\', \''.$journalid.'\', \''.$pageurl.'\')" style="cursor: pointer;width:80px;height:25px;size:16px;background-color: #428bca;color:white;text-align:center;padding-top:5px">Edit</div>

                    <div id="ejournalmessage2" style="color:black;size:16px;padding-top:5px;display:none"></div>
                    <div id="ejournalerror" style="color:red;size:16px;padding-top:5px;display:none"></div>

                </div>
                
                <script type="text/javascript">

                jQuery(document).ready(function($){

                    $("#euploadd-btn").click(function(e) {

                        e.preventDefault();

                        var image = wp.media({ 

                            title: "Upload Image",

                            multiple: false

                        }).open()

                        .on("select", function(e){

                            var uploaded_image = image.state().get("selection").first();

                            console.log(uploaded_image);

                            var eimage_urll2 = uploaded_image.toJSON().url;

                            $("#eimage_urll2").val(eimage_urll2);

                        });

                    });

                });

                </script>';

        }
        if($journaltype == "delete"){

            $durl = $plugin_url . 'bm-journal-delete.php';
            $image_url = get_post_meta( $journalid, 'image_url', true );
            $title = get_post_meta( $journalid, 'title', true );
            $subtitle = get_post_meta( $journalid, 'subtitle', true );
            $message = get_post_meta( $journalid, 'message', true );
            
                echo '

                <div class="wrap">
                    <h2>Delete Journal</h2>
                </div>
                
                <br>

                <div class="wrap">
                    <h3>Title*</h3>
                </div>

                <input type="text" value="'.$title.'" name="djournaltitle" id="djournaltitle" class="regular-text" readonly><br><br>

                <div class="wrap">
                    <h3>Sub-Title</h3>
                </div>

                <input type="text" value="'.$subtitle.'" name="djournalsubtitle" id="djournalsubtitle" class="regular-text" readonly><br><br>

                <div class="wrap">
                    <h3>Message*</h3>
                </div>

                <textarea id="djournalmessage" name="djournalmessage" rows="4" cols="50" readonly>'.$message.'</textarea><br><br>

                <div class="wrap">
                    <h3>Image*</h3>
                </div>

                <input type="text" value="'.$image_url.'" name="dimage_urll2" id="dimage_urll2" class="regular-text" readonly><br><br>

                <div class="wrap">
                    <h3>Link</h3>
                </div>

                <input type="text" value="'.$link.'" name="djournallink" id="djournallink" class="regular-text" readonly><br><br>

                <div class="wrap">

                    <div id="dbm-journal-button" onclick="djournalbuttonsave(\''.$durl.'\', \''.$journalid.'\', \''.$pageurl.'\')" style="cursor: pointer;width:180px;height:35px;font-size:16px;background-color:red;color:white;text-align:center;padding-top:10px">Confirm and Delete</div>

                    <div id="djournalmessage2" style="color:black;size:16px;padding-top:5px;display:none"></div>
                    <div id="djournalerror" style="color:red;size:16px;padding-top:5px;display:none"></div>

                </div>';
        }
    }
}

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Create a new table class that will extend the WP_List_Table
 */
class Example_List_Table extends WP_List_Table
{
    /**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $data = $this->table_data();
        usort( $data, array( &$this, 'sort_data' ) );

        $perPage = 5;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);

        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );

        $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);

        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }

    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns()
    {
        $columns = array(
            'id' => 'ID',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'link' => 'Link',
            'message' => 'Message',
            'postdate' => 'Post Date',
        );

        return $columns;
    }

    function column_title($item)
    {
        // links going to /admin.php?page=[your_plugin_page][&other_params]
        // notice how we used $_REQUEST['page'], so action will be done on curren page
        // also notice how we use $this->_args['singular'] so in this example it will
        // be something like &dathangnhanh=2
        $actions = array(
            'edit' => sprintf('<a href="?page=my-menu-journal&jid=%s&jtype=edit">%s</a>', $item['id'], __('Edit', 'cltd_example')),
            'delete' => sprintf('<a href="?page=my-menu-journal&jid=%s&jtype=delete">%s</a>',  $item['id'], __('Delete', 'cltd_example')),
        );

        return sprintf('%s %s',
            $item['title'],
            $this->row_actions($actions)
        );

    }

    

    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns()
    {
        return array();
    }

    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns()
    {
        return array('id' => array('id', false));
    }

  
    private function table_data()
    {
        $args = array(
            'post_type' => "bm-journal",
            'posts_per_page'=>-1, 
            'numberposts'=>-1
          );
        $latest_posts = get_posts( $args );
        $data = array();
        if(count($latest_posts) > 0 ){
            foreach($latest_posts as $post) {
                $image_url = get_post_meta( $post->ID, 'image_url', true );
                $title = get_post_meta( $post->ID, 'title', true );
                $subtitle = get_post_meta( $post->ID, 'subtitle', true );
                $link = get_post_meta( $post->ID, 'link', true );
                $message = get_post_meta( $post->ID, 'message', true );
                $pieces = explode(" ", $post->post_date);
                $postdate = $pieces[0];
                $data2 = array(
                    'id' => $post->ID,
                    'title' => $title,
                    'subtitle' => $subtitle,
                    'link' => $link,
                    'message' => $message,
                    'postdate' => $postdate,
                    );
                array_push($data, $data2);
            }
            
        }

        return $data;
    }

    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default( $item, $column_name )
    {
        switch( $column_name ) {
            case 'id':
            case 'title':
            case 'subtitle':
            case 'link':
            case 'message':
            case 'postdate':
                return $item[ $column_name ];

            default:
                return print_r( $item, true ) ;
        }
    }

    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data( $a, $b )
    {
        // Set defaults
        $orderby = 'id';
        $order = 'desc';

        // If orderby is set, use this as the sort column
        if(!empty($_GET['orderby']))
        {
            $orderby = $_GET['orderby'];
        }

        // If order is set use this as the order
        if(!empty($_GET['order']))
        {
            $order = $_GET['order'];
        }


        $result = strcmp( $a[$orderby], $b[$orderby] );

        if($order === 'asc')
        {
            return $result;
        }

        return -$result;
    }
}


// What is showing on Annoucement menu on wordpress admin menu.
function my_menu_query_output_journal_add() {

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'bm-journal-add.php';
    // wp_enqueue_style( 'css', $plugin_url . 'css/admin.css' );
	wp_enqueue_script( 'jsjournaladd', $plugin_url . 'js/js.js' );
    $pageurl = admin_url(sprintf('admin.php?%s', http_build_query($_GET)));
    $pieces = explode("admin.php", $pageurl);
    $pageurl = $pieces[0];

    
        echo '

        <div class="wrap">
            <h2>New Journal</h2>
        </div>
        
        <br>

        <div class="wrap">
            <h3>Title*</h3>
        </div>

        <input type="text" name="journaltitle" id="journaltitle" class="regular-text"><br><br>

        <div class="wrap">
            <h3>Sub-Title</h3>
        </div>

        <input type="text" name="journalsubtitle" id="journalsubtitle" class="regular-text"><br><br>

        <div class="wrap">
            <h3>Message*</h3>
        </div>

        <textarea id="journalmessage" name="journalmessage" rows="4" cols="50"></textarea><br><br>

        <div class="wrap">
            <h3>Image*</h3>
        </div>

        <input type="text" name="image_urll2" id="image_urll2" class="regular-text">

        <input type="button" style="width:150px;" name="uploadd-btn" id="uploadd-btn" class="button-secondary" value="Upload Image"><br><br>

        <div class="wrap">
            <h3>Link</h3>
        </div>

        <input type="text" value="'.$link.'" name="journallink" id="journallink" class="regular-text"><br><br>

        <div class="wrap">

            <div id="bm-journal-button" onclick="journalbuttonsave(\''.$url.'\', \''.$pageurl.'\')" style="cursor: pointer;width:80px;height:25px;size:16px;background-color: #428bca;color:white;text-align:center;padding-top:5px">Save</div>

            <div id="journalmessage2" style="color:black;size:16px;padding-top:5px;display:none"></div>
            <div id="journalerror" style="color:red;size:16px;padding-top:5px;display:none"></div>

        </div>
        
        <script type="text/javascript">

        jQuery(document).ready(function($){

            $("#uploadd-btn").click(function(e) {

                e.preventDefault();

                var image = wp.media({ 

                    title: "Upload Image",

                    multiple: false

                }).open()

                .on("select", function(e){

                    var uploaded_image = image.state().get("selection").first();

                    console.log(uploaded_image);

                    var image_urll2 = uploaded_image.toJSON().url;

                    $("#image_urll2").val(image_urll2);

                });

            });

        });

        </script>';
    
    
}



function bm_journal_shortcode() {
    ob_start();
    $image_url2 = get_site_url() . "/wp-content/uploads/";
    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'cssjournal', $plugin_url . 'css/css.css' );
    wp_enqueue_script( 'jsjournaladd2', $plugin_url . 'js/js.js' );

    $args = array(
        'post_type' => "bm-journal",
        'posts_per_page'=>-1, 
        'numberposts'=>-1
    );

    $latest_posts = get_posts( $args );
    $data = array();
    if(count($latest_posts) > 0 ){

        $lastindex = 4;
        $totalindex = count($latest_posts) - 1;
        if($totalindex <= $lastindex){
            $lastindex = $totalindex;
        }

        echo'<div id="jnlastindex" style="display:none;">'.$lastindex.'</div>';
        echo'<div id="jntotalindex" style="display:none;">'.$totalindex.'</div>';

        echo'<div id="jnbox">';
        for ($x = 0; $x <= $totalindex; $x++) {
            $image_url = get_post_meta( $latest_posts[$x]->ID, 'image_url', true );
            $title = get_post_meta( $latest_posts[$x]->ID, 'title', true );
            $subtitle = get_post_meta( $latest_posts[$x]->ID, 'subtitle', true );
            $link = get_post_meta( $latest_posts[$x]->ID, 'link', true );
            $message = get_post_meta( $latest_posts[$x]->ID, 'message', true );
            $pieces = explode(" ", $latest_posts[$x]->post_date);
            $postdate = $pieces[0];
            $pieces2 = explode("-", $postdate);
            $postdate = $pieces2[2] . "/" . $pieces2[1] . "/" . $pieces2[0];

            $newid = "box_" . $x;
           
            if($x >= 5){
                echo'<div id="'.$newid.'" style="display:none" class="journalbox">';
            }else{
                echo'<div id="'.$newid.'" class="journalbox">';
            }
            

                echo'<div class="journaltop">';

                    if ($image_url == ""){
                        
                        echo'<div class="journaltitle"><h2>'.$title.'</h2></div>';
                        echo'<div class="journalsubtitle"><h3>'.$subtitle.'</h3></div>';
                        echo'<div class="journalpostdate"><h5>Publish on: '.$postdate.'</h5></div>';
                    }else{
                        echo'<div class="journalimage2" style="background-image:url(\''.$image_url2.$image_url.'\');background-position:center;background-size:cover;"></div>';
                        echo'<div class="journaltitlebox">';
                            echo'<div class="journaltitle"><h2>'.$title.'</h2></div>';
                            echo'<div class="journalsubtitle"><h3>'.$subtitle.'</h3></div>';
                            echo'<div class="journalpostdate"><h5>Publish on: '.$postdate.'</h5></div>';
                        echo'</div>';
                        echo'<div class="journalimage" style="background-image:url(\''.$image_url2.$image_url.'\');background-position:center;background-size:cover"></div>';
                    }    
                echo'</div>';
                    echo'<div class="journalmessage"><p style="font-size:18px;">'.$message.'</p></div>';
                    if ($link == ""){
                        echo'<div class="journallinke"></div>';
                    }else{
                        echo'<div class="journallinke"><a href="https://'.$link.'" target="_blank"><button type="button" class="journalbutton">More info</button></a></div>';
                    }

            echo'</div>';

        }
        if($lastindex < $totalindex){
            echo'<div id="jnbutton" style="margin-top:30px;"><button type="button" onclick="journaldisplaymore()" class="journalbutton">View More Posts</button></div>';
        }
        

        echo'</div>';
        
    }


    return ob_get_clean();
}
// Register shortcode
add_shortcode('bm_journal', 'bm_journal_shortcode');
?>