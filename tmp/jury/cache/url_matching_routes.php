<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_wdt/styles' => [[['_route' => '_wdt_stylesheet', '_controller' => 'web_profiler.controller.profiler::toolbarStylesheetAction'], null, null, null, false, false, null]],
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/admin/category' => [[['_route' => 'admin_category_index', '_controller' => 'App\\Controller\\Admin\\AdminCategoryController::index'], null, ['GET' => 0], null, false, false, null]],
        '/admin/category/new' => [[['_route' => 'admin_category_new', '_controller' => 'App\\Controller\\Admin\\AdminCategoryController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/product' => [[['_route' => 'admin_product_index', '_controller' => 'App\\Controller\\Admin\\AdminProductController::index'], null, ['GET' => 0], null, false, false, null]],
        '/admin/product/new' => [[['_route' => 'admin_product_new', '_controller' => 'App\\Controller\\Admin\\AdminProductController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/quote' => [[['_route' => 'admin_quote_request_index', '_controller' => 'App\\Controller\\Admin\\AdminQuoteRequestController::index'], null, ['GET' => 0], null, false, false, null]],
        '/admin/quote/new' => [[['_route' => 'admin_quote_request_new', '_controller' => 'App\\Controller\\Admin\\AdminQuoteRequestController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/review' => [[['_route' => 'admin_review_index', '_controller' => 'App\\Controller\\Admin\\AdminReviewController::index'], null, ['GET' => 0], null, false, false, null]],
        '/admin/review/new' => [[['_route' => 'admin_review_new', '_controller' => 'App\\Controller\\Admin\\AdminReviewController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/user' => [[['_route' => 'admin_user_index', '_controller' => 'App\\Controller\\Admin\\AdminUserController::index'], null, ['GET' => 0], null, false, false, null]],
        '/admin/user/new' => [[['_route' => 'admin_user_new', '_controller' => 'App\\Controller\\Admin\\AdminUserController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin' => [[['_route' => 'admin_dashboard', '_controller' => 'App\\Controller\\Admin\\DashboardController::index'], null, null, null, false, false, null]],
        '/category' => [[['_route' => 'app_category_index', '_controller' => 'App\\Controller\\Front\\CategoryController::index'], null, null, null, false, false, null]],
        '/contact' => [[['_route' => 'app_contact', '_controller' => 'App\\Controller\\Front\\ContactController::index'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/' => [[['_route' => 'app_home', '_controller' => 'App\\Controller\\Front\\HomeController::index'], null, null, null, false, false, null]],
        '/about' => [[['_route' => 'app_about', '_controller' => 'App\\Controller\\Front\\HomeController::about'], null, null, null, false, false, null]],
        '/confidentialite' => [[['_route' => 'app_privacy', '_controller' => 'App\\Controller\\Front\\PrivacyController::index'], null, ['GET' => 0], null, false, false, null]],
        '/product' => [[['_route' => 'app_product_index', '_controller' => 'App\\Controller\\Front\\ProductController::index'], null, null, null, false, false, null]],
        '/quote/new' => [[['_route' => 'app_quote_new', '_controller' => 'App\\Controller\\Front\\QuoteRequestController::new'], null, null, null, false, false, null]],
        '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\Front\\RegistrationController::register'], null, null, null, false, false, null]],
        '/verify/email' => [[['_route' => 'app_verify_email', '_controller' => 'App\\Controller\\Front\\RegistrationController::verifyUserEmail'], null, ['GET' => 0], null, false, false, null]],
        '/verify/email/resend' => [[['_route' => 'app_verify_email_resend', '_controller' => 'App\\Controller\\Front\\RegistrationController::resend'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/review' => [[['_route' => 'front_review_index', '_controller' => 'App\\Controller\\Front\\ReviewController::index'], null, ['GET' => 0], null, false, false, null]],
        '/review/new' => [[['_route' => 'front_review_new', '_controller' => 'App\\Controller\\Front\\ReviewController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/(?'
                        .'|font/([^/\\.]++)\\.woff2(*:98)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:134)'
                                .'|router(*:148)'
                                .'|exception(?'
                                    .'|(*:168)'
                                    .'|\\.css(*:181)'
                                .')'
                            .')'
                            .'|(*:191)'
                        .')'
                    .')'
                .')'
                .'|/admin/(?'
                    .'|category/([^/]++)(?'
                        .'|(*:232)'
                        .'|/edit(*:245)'
                        .'|(*:253)'
                    .')'
                    .'|product/([^/]++)(?'
                        .'|(*:281)'
                        .'|/edit(*:294)'
                        .'|(*:302)'
                    .')'
                    .'|quote/([^/]++)(?'
                        .'|/(?'
                            .'|logo(*:336)'
                            .'|edit(*:348)'
                        .')'
                        .'|(*:357)'
                    .')'
                    .'|review/([^/]++)(?'
                        .'|(*:384)'
                        .'|/edit(*:397)'
                        .'|(*:405)'
                    .')'
                    .'|user/([^/]++)(?'
                        .'|(*:430)'
                        .'|/edit(*:443)'
                        .'|(*:451)'
                    .')'
                .')'
                .'|/category/([^/]++)(*:479)'
                .'|/product/(?'
                    .'|category/([^/]++)(*:516)'
                    .'|([^/]++)(*:532)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        98 => [[['_route' => '_profiler_font', '_controller' => 'web_profiler.controller.profiler::fontAction'], ['fontName'], null, null, false, false, null]],
        134 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        148 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        168 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        181 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        191 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        232 => [[['_route' => 'admin_category_show', '_controller' => 'App\\Controller\\Admin\\AdminCategoryController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        245 => [[['_route' => 'admin_category_edit', '_controller' => 'App\\Controller\\Admin\\AdminCategoryController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        253 => [[['_route' => 'admin_category_delete', '_controller' => 'App\\Controller\\Admin\\AdminCategoryController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        281 => [[['_route' => 'admin_product_show', '_controller' => 'App\\Controller\\Admin\\AdminProductController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        294 => [[['_route' => 'admin_product_edit', '_controller' => 'App\\Controller\\Admin\\AdminProductController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        302 => [[['_route' => 'admin_product_delete', '_controller' => 'App\\Controller\\Admin\\AdminProductController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        336 => [[['_route' => 'admin_quote_request_logo', '_controller' => 'App\\Controller\\Admin\\AdminQuoteRequestController::logo'], ['id'], ['GET' => 0], null, false, false, null]],
        348 => [[['_route' => 'admin_quote_request_edit', '_controller' => 'App\\Controller\\Admin\\AdminQuoteRequestController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        357 => [
            [['_route' => 'admin_quote_request_show', '_controller' => 'App\\Controller\\Admin\\AdminQuoteRequestController::show'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'admin_quote_request_delete', '_controller' => 'App\\Controller\\Admin\\AdminQuoteRequestController::delete'], ['id'], ['POST' => 0], null, false, true, null],
        ],
        384 => [[['_route' => 'admin_review_show', '_controller' => 'App\\Controller\\Admin\\AdminReviewController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        397 => [[['_route' => 'admin_review_edit', '_controller' => 'App\\Controller\\Admin\\AdminReviewController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        405 => [[['_route' => 'admin_review_delete', '_controller' => 'App\\Controller\\Admin\\AdminReviewController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        430 => [[['_route' => 'admin_user_show', '_controller' => 'App\\Controller\\Admin\\AdminUserController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        443 => [[['_route' => 'admin_user_edit', '_controller' => 'App\\Controller\\Admin\\AdminUserController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        451 => [[['_route' => 'admin_user_delete', '_controller' => 'App\\Controller\\Admin\\AdminUserController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        479 => [[['_route' => 'app_category_show', '_controller' => 'App\\Controller\\Front\\CategoryController::show'], ['slug'], null, null, false, true, null]],
        516 => [[['_route' => 'app_product_category', '_controller' => 'App\\Controller\\Front\\ProductController::category'], ['slug'], null, null, false, true, null]],
        532 => [
            [['_route' => 'app_product_show', '_controller' => 'App\\Controller\\Front\\ProductController::show'], ['slug'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
