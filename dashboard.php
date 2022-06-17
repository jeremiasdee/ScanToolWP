<?php
 echo '<div class="wrap">';
 $site_title = get_bloginfo( 'name' );
 $site_url = network_site_url( '/' );
 $wp_version = get_bloginfo( 'version' );
 echo '<h1>Nombre del sitio:</h1> ' . $site_title;
 echo '<h1>Url de WordPress:</h1> ' . $site_url;

 $count_pages = wp_count_posts('page');
 $total_pages = $count_pages->publish;
 echo '<h1>Paginas publicadas:</h1> ' . $total_pages . ' pagina(s). ';

 $count_posts = wp_count_posts('post');
 $total_posts = $count_posts->publish;
 echo '<h1>Blogs publicados:</h1> ' . $total_posts . ' publicacion(es). ';

 echo '</div>';
?>
