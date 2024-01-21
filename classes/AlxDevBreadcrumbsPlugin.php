<?php

class AlxDevBreadcrumbsPlugin
{
    public $home_display_name = 'Главная';

    public $exclude_categories = ['uncategorized'];

    /** Настройки для разных типов постов 
     * 
     * post_type => [
     *  top_page_slug => код страницы по типу "все новости", "все товары", и т.п.
     *  use_taxonomy => по какой таксономии строить путь в бредкрамбсах
     * ]
     */
    public $post_types_settings = [];

    public $separator = ' / ';


    // --------------------------------------------------------------------

    private static $instance = null;

    public function __construct()
    {
        require(dirname(__FILE__) . '/../config.php');
        self::$instance = $this;

        $this->build();
    }

    public static function instance()
    {
        return self::$instance ?? new self();
    }

    // --------------------------------------------------------------------

    private $breadcrumbs = [];


    private function build()
    {
        $breadcrumbs = [];


        // Главная
        $breadcrumbs[] = [
            'display_name' => $this->home_display_name,
            'url' => get_option('home'),
        ];


        // Верхняя страница для данного типа постов ("все новости", "все товары", ...)
        // TODO сделать понадежнее!
        //      сейчас мы предполагаем, что к таксономии привязан ровно 1 тип постов, 
        //      поэтому когда открыта рубрика (таксономия), мы ВЕРИМ, что get_post_type() отдаст ВЕРНЫЙ связанный тип поста, 
        //      НО таксономия может быть связана с 100500 типами постов, и что тогда отдаст get_post_type() - я хз...
        $top_page_slug = $this->post_types_settings[get_post_type()]['top_page_slug'] ?? null;
        if (!empty($top_page_slug)) {
            $page = get_page_by_path($top_page_slug);
            if (!empty($page)) {
                $breadcrumbs[] = [
                    'display_name' => $page->post_title,
                    'url' => get_page_link($page),
                ];
            }
        }


        // собираем обратный путь категорий (от текущей до родительской)
        $closest_category = null;
        if (is_category() || is_tax()) {
            $closest_category = get_queried_object();
        } else if (is_single()) {
            $post = get_post();
            $taxonomy_codes = array_intersect(
                get_object_taxonomies($post),
                array_filter([$this->post_types_settings[$post->post_type]['use_taxonomy'] ?? null])
            );
            if (!empty($taxonomy_codes)) {
                $taxonomy_code = reset($taxonomy_codes);
                $taxonomy = (array)get_taxonomy($taxonomy_code);
                $categories = array_filter(
                    $categories = wp_get_object_terms($post->ID, $taxonomy_code, $taxonomy['args']),
                    fn ($cat) => !in_array($cat->slug, $this->exclude_categories)
                );
                $closest_category = reset($categories);
            }
        }

        if (!empty($closest_category)) {
            $back_path = [];
            while (!empty($closest_category) && $closest_category instanceof WP_Term) {
                $back_path[] = [
                    'display_name' => $closest_category->name,
                    'url' => get_category_link($closest_category),
                ];
                $closest_category = get_term($closest_category->parent ?? null, $closest_category->taxonomy);
            }
            $breadcrumbs = [...$breadcrumbs, ...array_reverse($back_path)];
        }


        // TODO тэги
        // ...


        // страница или пост
        if ((is_single() || is_page()) && ($this->post_types_settings[get_post_type()]['display-last-name'] ?? true)) {
            $breadcrumbs[] = [
                'display_name' => the_title(display: false),
            ];
        }


        // причесываем и возвращаем
        $breadcrumbs = array_filter($breadcrumbs, fn ($b) => !empty($b['display_name']));
        if (($this->post_types_settings[get_post_type()]['display-last-name'] ?? true)) {
            unset($breadcrumbs[array_key_last($breadcrumbs)]['url']);
        }


        $this->breadcrumbs = $breadcrumbs;;
    }


    public function get()
    {
        if (empty($this->breadcrumbs)) {
            $this->build();
        }
        return $this->breadcrumbs;
    }


    public function render($template = 'simple')
    {
        $breadcrumbs = $this->get(); // to use in template
        include(dirname(__FILE__) . "/../templates/breadcrumbs-{$template}.php");
    }
}
