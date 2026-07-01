<?php
// ============================================================
// Rotas públicas
// ============================================================
$router->get('/',               'HomeController@index');
$router->get('/portfolio',      'PortfolioController@index');
$router->get('/portfolio/{slug}','PortfolioController@show');
$router->get('/blog',           'BlogController@index');
$router->get('/blog/{slug}',    'BlogController@show');
$router->get('/services',           'ServiceController@index');
$router->get('/services/{id}',      'ServiceController@show');
$router->get('/contact',        'ContactController@index');
$router->post('/contact',       'ContactController@send');
$router->get('/faqs',           'FaqController@index');
$router->get('/team',           'TeamController@index');
$router->get('/about',          'AboutController@index');

// Reviews / Depoimentos (submissão pública, sem login)
$router->post('/reviews',       'TestimonialController@store');

// Idioma da interface (i18n)
$router->get('/lang/{code}',    'LangController@set');

// ============================================================
// Autenticação pública
// ============================================================
$router->get('/login',           'AuthController@loginForm');
$router->post('/login',          'AuthController@login');
$router->get('/register',        'AuthController@registerForm');
$router->post('/register',       'AuthController@register');
$router->get('/logout',          'AuthController@logout');

// ============================================================
// Perfil do utilizador (requer login)
// ============================================================
$router->get('/profile',  'UserController@profile');
$router->post('/profile', 'UserController@update');

// ============================================================
// Comentários (requer login)
// ============================================================
$router->post('/comments',              'CommentController@store');
$router->post('/comments/{id}/edit',    'CommentController@update');
$router->post('/comments/{id}/delete',  'CommentController@delete');

// ============================================================
// Admin — autenticação
// ============================================================
$router->get('/admin/login',  'AdminAuthController@loginForm');
$router->post('/admin/login', 'AdminAuthController@login');
$router->get('/admin/logout', 'AdminAuthController@logout');

// ============================================================
// Admin — dashboard
// ============================================================
$router->get('/admin',            'AdminDashboardController@index');
$router->get('/admin/dashboard',  'AdminDashboardController@index');

// ============================================================
// Admin — Portfólio CRUD
// ============================================================
$router->get('/admin/portfolio',                  'AdminPortfolioController@index');
$router->get('/admin/portfolio/create',           'AdminPortfolioController@create');
$router->post('/admin/portfolio/create',          'AdminPortfolioController@store');
$router->get('/admin/portfolio/{id}/edit',        'AdminPortfolioController@edit');
$router->post('/admin/portfolio/{id}/edit',       'AdminPortfolioController@update');
$router->post('/admin/portfolio/{id}/delete',     'AdminPortfolioController@delete');

// ============================================================
// Admin — Blog CRUD
// ============================================================
$router->get('/admin/blog',                'AdminBlogController@index');
$router->get('/admin/blog/create',         'AdminBlogController@create');
$router->post('/admin/blog/create',        'AdminBlogController@store');
$router->get('/admin/blog/{id}/edit',      'AdminBlogController@edit');
$router->post('/admin/blog/{id}/edit',     'AdminBlogController@update');
$router->post('/admin/blog/{id}/delete',   'AdminBlogController@delete');

// ============================================================
// Admin — Comentários
// ============================================================
$router->get('/admin/comments/pending',          'AdminCommentController@pending');
$router->get('/admin/comments/all',              'AdminCommentController@all');
$router->post('/admin/comments/{id}/approve',    'AdminCommentController@approve');
$router->post('/admin/comments/{id}/reject',     'AdminCommentController@reject');
$router->post('/admin/comments/{id}/delete',     'AdminCommentController@delete');

// ============================================================
// Admin — Utilizadores
// ============================================================
$router->get('/admin/users',              'AdminUserController@index');
$router->get('/admin/users/{id}',         'AdminUserController@show');
$router->post('/admin/users/{id}/toggle', 'AdminUserController@toggle');

// ============================================================
// Admin — Serviços CRUD
// ============================================================
$router->get('/admin/services',               'AdminServiceController@index');
$router->get('/admin/services/create',        'AdminServiceController@create');
$router->post('/admin/services/create',       'AdminServiceController@store');
$router->get('/admin/services/{id}/edit',     'AdminServiceController@edit');
$router->post('/admin/services/{id}/edit',    'AdminServiceController@update');
$router->post('/admin/services/{id}/delete',  'AdminServiceController@delete');

// ============================================================
// Admin — Mensagens de contacto
// ============================================================
$router->get('/admin/messages',               'AdminMessageController@index');
$router->get('/admin/messages/{id}',          'AdminMessageController@show');
$router->post('/admin/messages/{id}/delete',  'AdminMessageController@delete');

// ============================================================
// Admin — FAQs CRUD
// ============================================================
$router->get('/admin/faqs',                'AdminFaqController@index');
$router->get('/admin/faqs/create',         'AdminFaqController@create');
$router->post('/admin/faqs/create',        'AdminFaqController@store');
$router->get('/admin/faqs/{id}/edit',      'AdminFaqController@edit');
$router->post('/admin/faqs/{id}/edit',     'AdminFaqController@update');
$router->post('/admin/faqs/{id}/delete',   'AdminFaqController@delete');

// ============================================================
// Admin — Team CRUD
// ============================================================
$router->get('/admin/team',                'AdminTeamController@index');
$router->get('/admin/team/create',         'AdminTeamController@create');
$router->post('/admin/team/create',        'AdminTeamController@store');
$router->get('/admin/team/{id}/edit',      'AdminTeamController@edit');
$router->post('/admin/team/{id}/edit',     'AdminTeamController@update');
$router->post('/admin/team/{id}/delete',   'AdminTeamController@delete');

// ============================================================
// Admin — Currículo (Educação & Experiência)
// ============================================================
$router->get('/admin/resume',                  'AdminResumeController@index');
$router->get('/admin/resume/create',           'AdminResumeController@create');
$router->post('/admin/resume/create',          'AdminResumeController@store');
$router->post('/admin/resume/summary',         'AdminResumeController@summary');
$router->get('/admin/resume/{id}/edit',        'AdminResumeController@edit');
$router->post('/admin/resume/{id}/edit',       'AdminResumeController@update');
$router->post('/admin/resume/{id}/delete',     'AdminResumeController@delete');

// ============================================================
// Admin — About Me
// ============================================================
$router->get('/admin/about',  'AdminAboutMeController@index');
$router->post('/admin/about', 'AdminAboutMeController@update');

// ============================================================
// Admin — Skills CRUD
// ============================================================
$router->get('/admin/skills',                'AdminSkillController@index');
$router->post('/admin/skills/save',          'AdminSkillController@saveBatch');
$router->get('/admin/skills/create',         'AdminSkillController@create');
$router->post('/admin/skills/create',        'AdminSkillController@store');
$router->get('/admin/skills/{id}/edit',      'AdminSkillController@edit');
$router->post('/admin/skills/{id}/edit',     'AdminSkillController@update');
$router->post('/admin/skills/{id}/delete',   'AdminSkillController@delete');

// ============================================================
// Admin — Depoimentos / Reviews
// ============================================================
$router->get('/admin/testimonials',                 'AdminTestimonialController@index');
$router->post('/admin/testimonials/{id}/approve',   'AdminTestimonialController@approve');
$router->post('/admin/testimonials/{id}/reject',    'AdminTestimonialController@reject');
$router->post('/admin/testimonials/{id}/feature',   'AdminTestimonialController@feature');
$router->post('/admin/testimonials/{id}/delete',    'AdminTestimonialController@delete');

// ============================================================
// Admin — Traduções (i18n)
// ============================================================
$router->get('/admin/translations',  'AdminTranslationController@index');
$router->post('/admin/translations', 'AdminTranslationController@update');

// ============================================================
// Admin — Definições gerais
// ============================================================
$router->get('/admin/settings',  'AdminSettingController@index');
$router->post('/admin/settings', 'AdminSettingController@update');
