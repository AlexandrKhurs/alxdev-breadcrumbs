<?php

/**
 * Plugin Name: AlxDev Breadcrumbs
 * Description: максимально простые брэдкрамбсы (хлебные крошки)
 * Version:     0.1
 * Plugin URI:  https://alxdev.ru/projects/wp/plugins/alxdev-breadcrumbs
 * Author:      AlxDev
 * Author URI:  https://alxdev.ru
 */

require_once dirname(__FILE__) . '/classes/AlxDevBreadcrumbsPlugin.php';

/** Запустить раннюю инициализацию бредкрамбсов. Они будут расчитаны по состоянию на момент вызова, и сохранены в синглтоне.
 * Используется для управления моментом, КОГДА именно будут расчитаны бредкрамбсы.
 * Например, если в шаблоне до отрисовки Бредкрамбсов меняется MainLoop - тогда имеет смысл вызвать раннюю инициализацию  
 * до изменений, чтобы расчитались корректно по исходному запросу)
 */
function alxdev_init_breadcrumbs() {
    new AlxDevBreadcrumbsPlugin(); // просто создаем и даем ему инициализироваться и сохраниться в синглтоне
}



/** Вывести с использованием шаблона $variation (см. доступне шаблоны в /plugins/alxdev-breadcrumbs/templates) */
function alxdev_the_breadcrumbs($template = 'simple')
{
    AlxDevBreadcrumbsPlugin::instance()->render($template);
}

/** Получить массив [['display_name' => ..., 'url' => ...], ...]  для самостоятельного вывода */
function alxdev_get_breadcrumbs()
{
    return AlxDevBreadcrumbsPlugin::instance()->get();
}
