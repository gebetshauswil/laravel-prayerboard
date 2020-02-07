<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$domain = parse_url(config('app.url'))['host'];

// Routes for the subdomains as organisations
require 'web/organisation.php';

// Routes for the main domain as application
require 'web/application.php';
