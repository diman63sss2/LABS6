<?php 

//Добовлнение расширенных возможностей
if(! function_exists( 'universal_theme_setup')) :
  function universal_theme_setup(){
    //Добавление тега title по правилам wp
    add_theme_support( 'title-tag');

    //Добавление миниатюр
    add_theme_support( 'post-thumbnails', array( 'post' ) );   


    //Добавление логатипа
    add_theme_support( 'custom-logo', [
      'width'       => 163,
      'flex-height' => true,
      'header-text' => 'Universal',
      'unlink-homepage-logo' => false, // WP 5.5
    ] );

    //Регистрация меню
    register_nav_menus( [
      'header_menu' => 'Меню в шапке',
      'footer_menu' => 'Меню в подвале'
    ] );
  }
endif;
add_action( 'after_setup_theme', 'universal_theme_setup' );

function universal_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'universal' ),
			'id'            => 'main-sidebar',
			'description'   => esc_html__( 'Добавите виджеты.', 'universal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar-2', 'universal' ),
			'id'            => 'main-sidebar-2',
			'description'   => esc_html__( 'Добавите виджеты.', 'universal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'universal_theme_widgets_init' );


/**
 * Добавление нового виджета Downlouder_Widget.
 */
class Downlouder_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'downlouder_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: downlouder_widget
			'Ссылка на файл',
			array( 'description' => 'Ссылка на файл', /*'classname' => 'my_widget',*/ )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_my_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_my_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = $instance['title'];
    $description = $instance['description'];
    $link = $instance['link'];

		echo $args['before_widget'];
		echo '<img src="' . get_template_directory_uri() .'/assets/images/file.png" alt="widjet-file" class="widjet-file">';
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
    if ( ! empty( $description ) ) {
			echo '<p class="widget-desc">' . $description . '</p>';
		}

    if ( ! empty( $link ) ) {
			echo '<a class="widget-link" href="' . $link .'">	<img src="' . get_template_directory_uri() . '/assets/images/download.png" alt="download-icon" class="download-icon">' .'Скачать' . '</a>';
		}
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Полезные файлы';
    $description = @ $instance['description'] ?: 'Описание';
    $link = @ $instance['link'] ?: 'http://yandex.ru/';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
    <p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Описание:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php echo esc_attr( $description ); ?>">
		</p>
    <p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Ссылка:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>">
		</p>
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
    $instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';

		return $instance;
	}

	// скрипт виджета
	function add_my_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_my_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();
	}

	// стили виджета
	function add_my_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_my_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.my_widget a{ display:inline; }
		</style>
		<?php
	}

} 
// конец класса Downlouder_Widget

// регистрация Downlouder_Widget в WordPress
function register_downlouder_widget() {
	register_widget( 'Downlouder_Widget' );
}
add_action( 'widgets_init', 'register_downlouder_widget' );

/**
 * Добавление нового виджета Links_Widget.
 */
class Links_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'links_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: downlouder_widget
			'Ссылки на сот сети',
			array( 'description' => 'Ссылки на сот сети', /*'classname' => 'my_widget',*/ )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_my_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_my_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = $instance['title'];
    $facebook = $instance['facebook'];
    $twiter = $instance['twiter'];
		$youtube = $instance['youtube'];
		$vk = $instance['vk'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		echo '<div class="link-list">';
    if ( ! empty( $facebook ) ) {
			echo '<a class="widget-link" href="' . $facebook .'">	<img src="' . get_template_directory_uri() . '/assets/images/Facebook.png" alt="download-icon" class="download-icon"></a>';
		}
		if ( ! empty( $twiter ) ) {
			echo '<a class="widget-link" href="' . $twiter .'">	<img src="' . get_template_directory_uri() . '/assets/images/Twitter.png" alt="download-icon" class="download-icon"></a>';
		}
		if ( ! empty( $youtube ) ) {
			echo '<a class="widget-link" href="' . $youtube .'">	<img src="' . get_template_directory_uri() . '/assets/images/YouTube.png" alt="download-icon" class="download-icon"></a>';
		}
		if ( ! empty( $vk ) ) {
			echo '<a class="widget-link" href="' . $vk .'">	<img src="' . get_template_directory_uri() . '/assets/images/vk.png" alt="download-icon" class="download-icon"></a>';
		}
		echo '</div>';
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Заголовок';
    $facebook = @ $instance['facebook'] ?: '#';
    $twiter = @ $instance['twiter'] ?: '#';
		$youtube = @ $instance['youtube'] ?: '#';
		$vk = @ $instance['vk'] ?: '#';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Ссылка на facebook:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twiter' ); ?>"><?php _e( 'Ссылка на twiter:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'twiter' ); ?>" name="<?php echo $this->get_field_name( 'twiter' ); ?>" type="text" value="<?php echo esc_attr( $twiter ); ?>">
		</p>
    <p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'Ссылка на youtube:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" type="text" value="<?php echo esc_attr( $youtube ); ?>">
		</p>
    <p>
			<label for="<?php echo $this->get_field_id( 'vk' ); ?>"><?php _e( 'Ссылка на vk:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'vk' ); ?>" name="<?php echo $this->get_field_name( 'vk' ); ?>" type="text" value="<?php echo esc_attr( $vk ); ?>">
		</p>
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
		$instance['twiter'] = ( ! empty( $new_instance['twiter'] ) ) ? strip_tags( $new_instance['twiter'] ) : '';
    $instance['youtube'] = ( ! empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';
    $instance['vk'] = ( ! empty( $new_instance['vk'] ) ) ? strip_tags( $new_instance['vk'] ) : '';

		return $instance;
	}

	// скрипт виджета
	function add_my_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_my_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

	}

	// стили виджета
	function add_my_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_my_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.my_widget a{ display:inline; }
		</style>
		<?php
	}

} 
// конец класса Downlouder_Widget

function register_links_widget() {
	register_widget( 'Links_Widget' );
}
add_action( 'widgets_init', 'register_links_widget' );


## отключаем создание миниатюр файлов для указанных размеров
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );
function delete_intermediate_image_sizes( $sizes ){
	// размеры которые нужно удалить
	return array_diff( $sizes, [
		'medium_large',
		'large',
		'1536x1536',
		'2048x2048',
	] );
}

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'homepage-thumb', 65, 65, true ); // 65 в ширину и в высоту
  add_image_size( 'article-thumb', 336, 195, true ); // 65 в ширину и в высоту
}

add_filter( 'widget_tag_cloud_args', 'edit_widget_tag_cloud_args');

function edit_widget_tag_cloud_args($args) {
	$args['unit'] = 'px';
	$args['smallest'] = '14';
	$args['largest'] = '14';
	$args['number'] = '6';
	return $args;
}
 
//Подключение стилей и скриптов
function enqueue_universal_style() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css', 'style');
	wp_enqueue_style( 'animate', get_stylesheet_directory_uri() . '/assets/css/animate.css' );
  wp_enqueue_style( 'universal-theme', get_template_directory_uri() . '/assets/css/universal-theme.css', 'style');
  wp_enqueue_style( 'roboto-sleb', 'https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap');
	wp_enqueue_script( 'jq', get_template_directory_uri() . '/assets/js/jq.js');
	wp_enqueue_script( 'slick-min', get_template_directory_uri() . '/assets/js/slick.min.js');
	wp_enqueue_script( 'wow', get_stylesheet_directory_uri() . '/assets/js/wow.min.js', array(), '', false );
	wp_enqueue_script( 'mainjs', get_template_directory_uri() . '/assets/js/main.js');
	wp_enqueue_script( 'mainjs', get_template_directory_uri() . '/assets/js/test.js');
}
add_action( 'wp_enqueue_scripts', 'enqueue_universal_style' );


/** УБИРАЕМ ПУНКТЫ МЕНЮ ИЗ АДМИНКЕ **/
add_action('admin_menu', 'remove_menus_ssh');
function remove_menus_ssh(){
global $menu;
$restricted = array(
__('Dashboard'),  
__('Media'),      
__('Links'),      
__('Appearance'),
__('Tools'),     
__('Users'),      
__('Settings'),   
__('Comments'),   
__('Plugins'),     
__('Edit')     

);
end ($menu);
while (prev($menu)){
$value = explode(' ', $menu[key($menu)][0]);
if( in_array( ($value[0] != NULL ? $value[0] : "") , $restricted ) ){
	
		unset($menu[key($menu)]);

}
}
}
/** УБИРАЕМ ПУНКТЫ МЕНЮ ИЗ АДМИНКЕ **/

add_action('init', 'my_custom_init');
function my_custom_init(){
	register_post_type('book', array(
		'labels'             => array(
			'name'               => 'Книги', // Основное название типа записи
			'singular_name'      => 'Книга', // отдельное название записи типа Book
			'add_new'            => 'Добавить новую',
			'add_new_item'       => 'Добавить новую книгу',
			'edit_item'          => 'Редактировать книгу',
			'new_item'           => 'Новая книга',
			'view_item'          => 'Посмотреть книгу',
			'search_items'       => 'Найти книгу',
			'not_found'          => 'Книг не найдено',
			'not_found_in_trash' => 'В корзине книг не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Книги'

		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title','editor','author','thumbnail','excerpt','comments')
	) );
}










