<<<<<<< HEAD
<?php
defined( 'ABSPATH' ) || exit;

if (!class_exists('WP_List_Table')) {
    require_once (ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

/**Crear archivo zip */
$zipfile = "";
if(isset($_POST['padre'])){
    
    $theme = $_POST['padre'];
    $hijo = $_POST['hijo'];
    $slug_padre = strtolower($_POST['padre-slug']);
    $slug_padre = str_replace(" ","-",$slug_padre);
    $slug_hijo = strtolower($_POST['slug']);
    $slug_hijo = str_replace(" ","-",$slug_hijo);
    
   
    $hijo = $hijo == $theme ? $hijo."-child": $hijo;
    $author = empty($_POST['author']) ? "generador-temas-hijo.com" : $_POST['author'];
       
        $string_style="/*
        Theme Name:   ".$hijo."
        Description: Tema hijo para ".$theme."
        Author:        ".$author."
        Author URL:   https://www.generador-temas-hijo.com/ 
        Template:     ".$slug_padre."
        Version:      1.0
        License:      GNU General Public License v2 or later
        License URI:  http://www.gnu.org/licenses/gpl-2.0.html
        Text Domain:  ".$slug_hijo."
        */";
        $string_functions = "<?php 
function enqueue_styles_child_theme() {
	
	wp_enqueue_style( 'parent-style',
				get_template_directory_uri() . '/style.css' );

	wp_enqueue_style( 'child-style',
				get_stylesheet_directory_uri() . '/style.css',
				array( 'parent-style' ),
				wp_get_theme()->get('Version')
				);
}
add_action( 'wp_enqueue_scripts', 'enqueue_styles_child_theme' );";
        
        $zip = new ZipArchive;
        
        $zipfileName = $slug_hijo.".zip";
        
        $zipfilePath = RAFAXWPUTILES_DIR_THEMES."/".$zipfileName;
        if ($zip->open($zipfilePath, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE) === TRUE)
        {
                     
            // Add a file demo_folder/new.txt file to zip using the text specified
            $zip->addFromString( $slug_hijo.'/style.css', $string_style);
            $zip->addFromString( $slug_hijo.'/functions.php', $string_functions);
            
            $zip->addfile(RAFAXWPUTILES_DIR.'/assets/screenshot.jpg',$slug_hijo.'/screenshot.jpg');
            // All files are added, so close the zip file.
            $zip->close();
            
            if(file_exists($zipfilePath)){
                $urldescarga = RAFAXWPUTILES_DIR_THEMES."/".urlencode($zipfileName);
                $message =sprintf(__('El tema %s creado correctamente', 'rwu-utiles'), $hijo);
                rwu_admin_messages($message);
            }
            
        }
        
}
/**Crear Listado de archivos zip */
/** * Create a new table class that will extend the WP_List_Table */
class Links_Table_Themes extends WP_List_Table
 
{
    public function __construct(){
        parent::__construct(array(
            'singular' => 'table_theme',
            'plural' => 'table_themes',
            'ajax' => true
        ));
    }
	
	/**
     * [REQUIRED] this is how checkbox column renders
     *
     * @param $item - row (key, value array)
     * @return HTML
     */
    function column_cb($item){
        
        return sprintf(
            '<input type="checkbox" name="name[]" value="%s" />',
            $item['name']
        );
    }

	function column_name($item){
        $delete_nonce = wp_create_nonce( 'rwu_delete_customer' );

		$actions = array(
            'delete' => sprintf('<a href="?page=%s&pag=rwu_ToolsPage&action=delete&name=%s&_wpnonce=%s">%s</a>', $_REQUEST['page'], $item['name'], $delete_nonce, __('Delete', 'rwu-utiles')),
        );

        return sprintf('<strong>%s</strong>%s',
            $item['name'], $this->row_actions($actions)
        ); 
    }

	/** 
	* Override the parent columns method. Defines the columns to use in your listing table 
	* * @return Array 
	*/
	function get_columns(){
		$columns = [
			'cb' => '<input type="checkbox" />', 
            'name'=> __('Tema hijo', 'rwu-utiles'),
			'path' => __('Tema ruta', 'rwu-utiles'),
            'size' => __('Tamaño', 'rwu-utiles'), 
			
			  
		];
		return $columns;
	}

	/** 
	* Columns to make sortable. 
	* * @return array 
	*/
	public function get_sortable_columns(){
		$sortable_columns = array(
            'name' => array('name',true),
			'path' => array('path',false),
            'size' => array('size',true), 
						
		);
		return $sortable_columns;
	}

	function column_default( $item, $column_name ) {
                
        switch ( $column_name ) {
            case 'name':
            case 'path':
            case 'size':
            return $item[ $column_name ];
            default:
            return print_r( $item, true ); //Show the whole array for troubleshooting purposes
            }
          
    }

	public function get_hidden_columns(){
			// Setup Hidden columns and return them
			return array();
	}

	/** 
	* Returns an associative array containing the bulk action 
	* * @return array */
	function get_bulk_actions(){
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

	public function process_bulk_action(){
       
		if ('delete' === $this->current_action()) {

           $names = isset($_REQUEST['name']) ? $_REQUEST['name'] : array();
            //if (is_array($names)) $names = implode(',', $names);
            $message="";
            if (is_array($names)) {
                
                foreach($names as $name){
                    $filepath = RAFAXWPUTILES_DIR_THEMES."/".$name;
                    unlink($filepath);
                    $message .= sprintf(__('Eliminado %s ', 'rwu-utiles'), $name);
                    
                }
            }else{
                if(file_exists(RAFAXWPUTILES_DIR_THEMES."/".$names)){
                    $nonce = esc_attr( $_REQUEST['_wpnonce'] );
                    if ( ! wp_verify_nonce( $nonce, 'rwu_delete_customer' ) ) {
                        die( 'Go get a life script kiddies' );
                    } 
                    unlink(RAFAXWPUTILES_DIR_THEMES."/" . $names);
                    $message = sprintf(__('Tema %s eliminado correctamente', 'rwu-utiles'), $names);
                }  
            }
            if(!empty($message)){ rwu_admin_messages($message); } 
                
        } 
        
    }
	
	/** 
	*Text displayed when no record data is available 
	*/
	public function no_items(){
		_e('No record found in the database.', 'rwu-utiles');
	}
			

	public function prepare_items(){
		        
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        // here we configure table headers, defined in our methods
        $this->_column_headers = array($columns, $hidden, $sortable);

        // [OPTIONAL] process bulk action if any
        $this->process_bulk_action();
                
                
        $files = list_files( RAFAXWPUTILES_DIR_THEMES );
        $items = array();
        foreach ( $files as $file ) {
            if ( is_file( $file ) ) {
                $filesize = size_format( filesize( $file ) );
                $filename = basename( $file ); 
                array_push($items,array('name'=>$filename,'path'=>$file,'size'=>$filesize ));
            }
            
        }
        $this->items = $items;
	}
}
$class = new Links_Table_Themes;
$class->prepare_items();
?>
<div class="wrap wrap-tool" id="rwu_chils_theme">
    <h3>Generador de temas hijo</h3>
        Basado en :<a href="https://www.generador-temas-hijo.com/" target="_blank" rel="noopener noreferrer">Generador de temas hijo online</a> : Crea tus temas hijo para WordPress de forma sencilla y en pocos pasos.
        <div class="row">
                
         <div class="col col-sm-6 col-12">
              <div class="card text-dark bg-light">
                  <h2 class="card-header"><i class="bi bi-pencil-square"></i> Rellene los campos para crear su tema hijo</h2>
                <div class="card-body">
                
            <form name="form-tema-hijo"  class="rwu_form" method="POST" action="#">
            <div class="form-group">
                <label for="padre"><b>Tema principal (Original)</b></label>
                <div class="form-text">Nombre del tema padre </div>
                <input name="padre" id="Autocomplete" class="form-control" type="text" value="<?php echo isset($theme_parent) ? str_replace("%20"," ",$theme_parent) :'';?>" required>
            </div>
            <div class="form-group">
                <label for="padre-slug"><b>Slug tema principal</b></label>
                <div class="form-text">Nombre de la carpeta del tema principal </div>
                <input name="padre-slug" id="PadreSlug" class="form-control" type="text" value="<?php echo isset($theme_slug) ? $theme_slug :'';?>" required>
            </div>
            
            <div class="form-group">
                <label for="hijo"><b>Tema hijo </b></label>
                <div class="form-text">Nombre del tema hijo</div>
                <input name="hijo" id="hijo" class="form-control" type="text" required>
            </div>
            <div class="form-group">
                <label for="slug"><b>Slug del Tema hijo </b></label>
                <div class="form-text">Este sera el nombre de la carpeta del tema hijo</div>
                <input name="slug" id="slug" class="form-control" type="text" required>
            </div>
            
            <div class="form-group">
                <label for="email"><b>Email del autor</b></label>
                <div class="form-text">No guardaremos ni lo usaremos para nada.</div>
                <input name="email" class="form-control" type="email">
                
            </div>
            <div class="form-group">
                <label for="author"><b>Nombre del autor</b></label>
                <div class="form-text">Es tu momento. Pon el nombre del creador.</div>
                <input name="author" class="form-control" type="text">
            </div>
            <div class="">
                <input type="submit" class="btn button" value="Quiero mi tema hijo!">
            </div>
            </form>
            </di>
            </div>
        </div>
    </div>
    <div class="col col-sm-6 col-12">
    <form id="themes-table" method="POST">
    <input type="hidden" name="page" value="page=shorcodes-utiles&pag=rwu_ToolsPage"/>
        <?php $class->display(); ?>
    </form>
    </div>
</div>
=======
<div class="wrap wrap-tool" id="rwu_chils_theme">
    <h3>Generador de temas hijo</h3>
        <a href="https://www.generador-temas-hijo.com/" target="_blank" rel="noopener noreferrer">Generador de temas hijo online</a> : Crea tus temas hijo para WordPress de forma sencilla y en pocos pasos.

    </div>
>>>>>>> 0d4868b8a2b3ce0cc0743b6e76739d2b63e5f342
