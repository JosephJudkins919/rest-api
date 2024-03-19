<?php

header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

require_once 'Router.php';
require_once 'QuotesController.php';
require_once 'AuthorsController.php';
require_once 'CategoriesController.php';
require_once 'Database.php';

$router = new Router();

$quotesController = new QuotesController();
$authorsController = new AuthorsController();
$categoriesController = new CategoriesController();

// GET requests
$router->get('/api/quotes', function () use ($quotesController) {
    echo $quotesController->getAllQuotes();
});

$router->get('/api/quotes/{id}', function ($id) use ($quotesController) {
    echo $quotesController->getQuoteById($id);
});

$router->get('/api/quotes/author/{author_id}', function ($author_id) use ($quotesController) {
    echo $quotesController->getQuotesByAuthor($author_id);
});

$router->get('/api/quotes/category/{category_id}', function ($category_id) use ($quotesController) {
    echo $quotesController->getQuotesByCategory($category_id);
});

$router->get('/api/quotes/author/{author_id}/category/{category_id}', function ($author_id, $category_id) use ($quotesController) {
    echo $quotesController->getQuotesByAuthorAndCategory($author_id, $category_id);
});

$router->get('/api/authors', function () use ($authorsController) {
    echo $authorsController->getAllAuthors();
});

$router->get('/api/authors/{id}', function ($id) use ($authorsController) {
    echo $authorsController->getAuthorById($id);
});

$router->get('/api/categories', function () use ($categoriesController) {
    echo $categoriesController->getAllCategories();
});

$router->get('/api/categories/{id}', function ($id) use ($categoriesController) {
    echo $categoriesController->getCategoryById($id);
});

// POST requests
$router->post('/api/quotes', function () use ($quotesController) {
    echo $quotesController->createQuote();
});

$router->post('/api/authors', function () use ($authorsController) {
    echo $authorsController->createAuthor();
});

$router->post('/api/categories', function () use ($categoriesController) {
    echo $categoriesController->createCategory();
});

// PUT requests
$router->put('/api/quotes/{id}', function ($id) use ($quotesController) {
    echo $quotesController->updateQuote($id);
});

$router->put('/api/authors/{id}', function ($id) use ($authorsController) {
    echo $authorsController->updateAuthor($id);
});

$router->put('/api/categories/{id}', function ($id) use ($categoriesController) {
    echo $categoriesController->updateCategory($id);
});

// DELETE requests
$router->delete('/api/quotes/{id}', function ($id) use ($quotesController) {
    echo $quotesController->deleteQuote($id);
});

$router->delete('/api/authors/{id}', function ($id) use ($authorsController) {
    echo $authorsController->deleteAuthor($id);
});

$router->delete('/api/categories/{id}', function ($id) use ($categoriesController) {
    echo $categoriesController->deleteCategory($id);
});

$router->run();
?>
