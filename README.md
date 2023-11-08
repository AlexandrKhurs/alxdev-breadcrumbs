# alxdev-breadcrumbs - the wordpress plugin
EN: the simpliest breadcrumbs for your website

RU: простейшие "хлебные крошки" для вашего сайта

## EN
### Why this plugin
- No unwanted extra functionality, no strings attached*
- Code is as simple as possible. feel free to customize it according to your needs
- Supports custom post types and taxonomies

*_the funny thing: the best and the most flexible breadcrumbs I've found - are the parts of seo plugins (top 2 in WP market, you know 'em), but if you don’t really want the whole all-inclusive bunch of features (and all those annoying "buy pro " offers attached) - I'd say that you are on the right way right now :)_
### Downsides
- the plugin is half-baked (made by myself, for bymself, and without thinking about anyone else... sorry dudes :). 
- all settings should be made via code so far (see wp-content/plugins/alxdev-breadcrumbs/config.php). 
### Things you should know 
- "Home" is always displayed in the breadcrumbs(you cand turn 'em off). 
- it means that you use **pages** for each section like "all news", "all goods" etc. .. 
For example, if you want the breadcrumbs on your "All News" page to look like "Home > News > This News" - then you must create a Page for "All News", and specify it's slug for this type of posts in the config.php (or you can just skip it and let the breadcrumbs look like "Home > This news")
- you can also specify in config which taxonomies build breadcrumbs for each type of posts (see the example in config.php ). 
### Usage
- copy it into your wp-content/plugins folder
- activate the plugin in your admin-panel
- setup the stuff in the config.php (see above)
- use **alxdev_the_breadcrumbs() / alxdev_get_breadcrumbs()** functions to display / get the breadcrumbs in your template
- optionally, use **alxdev_init_breadcrumbs()** funtion if you change your MainLoop in your template files and it leads to incorrect breadcrumbs - just use it before you changed the main loop (check out [query_posts](https://developer.wordpress.org/reference/functions/query_posts/)) documentation)


## RU

### Зачем?
- никакого лишнего функционала*
- код максимально простой, докручивайте под ваши потребности,
- поддерживает кастомные типы постоы и таксономии

*_забавный факт: самые лучшие и гибко настраивыемые бредкрамбсы - у сеошных плагинов (топ 2 в маркете ВП), но если вам не нужен весь этот олл-инклюзив (и постоянные навязчивые предложения купить "про" в придачу) - то сейчас вы на верном пути :)_
### Недостатки
- плагин сырой (делал для себя, под себя, и ни о ком другом не думал... уж простите :)
- все настройки (пока) хранятся только в коде (см. wp-content/plugins/alxdev-breadcrumbs/config.php)
### Особенности, которые стоит знать
- "главная" всегда отображается в бредкрамбсах (на данный момент не отключабельно)
- подразумевается, что для раздела типа "все новости", "все товары" и т.п. у вас создана **страница**. 
т.е. если хотите, чтобы бредкрамбсы на странице отдельной Новости выглядели как "Главная > Новости > Вот эта новость" - то под "Новости" у вас должна быть создана Страница, и в конфиге надо прописать её slug для данного типа постов. Ну или просто проигнорьте этот момент - тогда бредкрамбсы будут выглядеть как "Главная > Вот эта новость"
- также в конфиге можно указать, по какой таксономии строить бредкрамбсы для данного типа постов (см пример в config.php )
### Как пользоваться
- скопируйте этот плагин в папку wp-content/plugins
- активируйте его в админке вордпресса
- внесите необходимые изменения в config.php, если что-то надо настроить (см. выше про настройки)
- используйте функции **alxdev_the_breadcrumbs() / alxdev_get_breadcrumbs()** в шаблоне, чтобы отобразить/получить бредкрамбсы
- (опционально) используйте функцию **alxdev_init_breadcrumbs()** для ранней инициализации бредкрамбсов, если вы изменяете Главный Цикл в вашем шаблоне, и изза этого бредкрамбсы отображаются некорректно (просто добавьте alxdev_init_breadcrumbs() до изменения Главного Цикла (см. документацию по [query_posts](https://developer.wordpress.org/reference/functions/query_posts/)).
