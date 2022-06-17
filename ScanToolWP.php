<?php
  /*
  Plugin Name: ScanToolWP
  Plugin URI:
  Description: Plugin simple para generar, editar y modificar un catalogo de libros
  Author: Jeremías Noel Delupi
  Version: 1.7.2
  Author URI: https://www.linkedin.com/in/jeremiasdelupi/
  */

  function ScanToolWP_Pages () {
      add_menu_page(
        'Dashboard',
        'ScanToolWP Dashboard',
        'manage_options',
        'scantoolwpdashboard',
        'scantoolwpdashboard_content',
        'dashicons-admin-tools',
        10
      );
          function scantoolwpdashboard_content () {
            include (dirname( __FILE__ ) . '/dashboard.php');
        }

      add_submenu_page(
        'scantoolwpdashboard',
        'About',
        'About',
        'manage_options',
        'scantoolwpabout',
        'scantoolwpabout_content'
      );
    }
        function scantoolwpabout_content () {
          echo '<h1>Nombre del Autor del plugin</h1><p>Jeremías Noel Delupi</p>';
          echo '<a href="https://www.facebook.com/nativapps"><h3 class="dashicons dashicons-facebook"></h3></a>';
          echo '<a href="https://www.instagram.com/nativapps/"><h3 class="dashicons dashicons-instagram"></h3></a>';
          echo '<a href="https://www.linkedin.com/company/nativapps-inc/)"><h3 class="dashicons dashicons-linkedin"></h3></a>';


      }

  add_action('admin_menu','ScanToolWP_Pages');

  function ScanToolWP_books_init() {
    $labels = array(
      'name'                  => __( 'Libros', 'libro' ),
      'singular_name'         => __( 'Libro', 'libro' ),
      'menu_name'             => __( 'Libros', 'libro' ),
      'name_admin_bar'        => __( 'Libros', 'libro' ),
      'add_new'               => __( 'Agregar nuevo', 'libro' ),
      'add_new_item'          => __( 'Agregar nuevo libro', 'libro' ),
      'new_item'              => __( 'Nuevo libro', 'libro' ),
      'edit_item'             => __( 'Editar libro', 'recipe' ),
      'view_item'             => __( 'Ver libro', 'libro' ),
      'all_items'             => __( 'Todos los libros', 'libro' ),
      'search_items'          => __( 'Buscar libros', 'libro' ),
      'not_found'             => __( 'No se encontraron libros.', 'libro' ),
      'not_found_in_trash'    => __( 'No se encontraron libros en la basura.', 'libro' ),
      'featured_image'        => __( 'Imagen de portada del libro', 'libro' ),
      'set_featured_image'    => __( 'Agregar imagen de portada de libro', 'libro' ),
      'remove_featured_image' => __( 'Remover imagen destacada', 'libro' ),
      'use_featured_image'    => __( 'Usar como imagen destacada', 'libro' ),
      'archives'              => __( 'Archivo de libros', 'libro' ),
    );

    $args = array(
        'public' => true,
        'has_archive' => true,
        'label'  => __( 'Libros', 'textdomain' ),
        'labels' =>$labels,
        'menu_icon' => 'dashicons-book',
        'supports' => array( 'title', 'thumbnail', 'revisions', 'custom-fields' ),
        'rewrite'     => array( 'slug' => 'libros' ),
    );

    register_post_type( 'libro', $args );
  }

  add_action( 'init', 'ScanToolWP_books_init' );


  function ScanToolWP_books_genre() {
    $screens = [ 'libro' ];
    foreach ( $screens as $screen ) {
        add_meta_box(
            'books_genre',
            'Género',
            'ScanToolWP_books_genre_content',
            $screen
        );
      }
  }
  add_action( 'add_meta_boxes', 'ScanToolWP_books_genre' );

  function ScanToolWP_books_genre_content( $post ) {
      $value = get_post_meta( $post->ID, '_book_genre_key', true );
      ?>
      <input class="widefat" type="text" name="book_genre_field" id="book_genre_field" value="<?php echo $value ; ?>" size="30" />
      <?php
  }

  function bookgenre_save_postdata( $post_id ) {
    if ( array_key_exists( 'book_genre_field', $_POST ) ) {
        update_post_meta(
            $post_id,
            '_book_genre_key',
            $_POST['book_genre_field']
        );
      }
  }
  add_action( 'save_post', 'bookgenre_save_postdata' );



  function ScanToolWP_books_author() {
    $screens = [ 'libro' ];
    foreach ( $screens as $screen ) {
        add_meta_box(
            'books_author',
            'Autor',
            'ScanToolWP_books_author_content',
            $screen
        );
      }
  }
  add_action( 'add_meta_boxes', 'ScanToolWP_books_author' );

  function ScanToolWP_books_author_content( $post ) {
      $value = get_post_meta( $post->ID, '_book_author_key', true );
      ?>
      <input class="widefat" type="text" name="book_author_field" id="book_author_field" value="<?php echo $value ; ?>" size="30" />
      <?php
  }

  function bookauthor_save_postdata( $post_id ) {
    if ( array_key_exists( 'book_author_field', $_POST ) ) {
        update_post_meta(
            $post_id,
            '_book_author_key',
            $_POST['book_author_field']
        );
      }
  }
  add_action( 'save_post', 'bookauthor_save_postdata' );

    function ScanToolWP_books_publishing() {
      $screens = [ 'libro' ];
      foreach ( $screens as $screen ) {
          add_meta_box(
              'books_publishing',
              'Año de publicación',
              'ScanToolWP_books_publishing_content',
              $screen
          );
        }
    }
    add_action( 'add_meta_boxes', 'ScanToolWP_books_publishing' );

    function ScanToolWP_books_publishing_content( $post ) {
        $value = get_post_meta( $post->ID, '_book_publishing_key', true );
        ?>
        <input class="widefat" type="number" name="book_publishing_field" id="book_publishing_field" value="<?php echo $value ; ?>" size="30" />
        <?php
    }

    function bookpublishing_save_postdata( $post_id ) {
      if ( array_key_exists( 'book_publishing_field', $_POST ) ) {
          update_post_meta(
              $post_id,
              '_book_publishing_key',
              $_POST['book_publishing_field']
          );
        }
    }
    add_action( 'save_post', 'bookpublishing_save_postdata' );

    function books_archive( $archive_template ) {
     global $post;
     $plugin_root_dir = WP_PLUGIN_DIR.'/ScanToolWP/';

     if (is_archive() && get_post_type($post) == 'libro') {
          $archive_template = $plugin_root_dir.'archive-libro.php';
     }
     return $archive_template;
    }

    add_filter( 'archive_template', 'books_archive' ) ;


    function books_single( $archive_template2 ) {
     global $post;
     $plugin_root_dir = WP_PLUGIN_DIR.'/ScanToolWP/';

     if (is_single() && get_post_type($post) == 'libro') {
          $archive_template2 = $plugin_root_dir.'single-libro.php';
     }
     return $archive_template2;
    }

    add_filter( 'archive_template2', 'books_single' ) ;


  defined( 'ABSPATH' ) or die();
?>
