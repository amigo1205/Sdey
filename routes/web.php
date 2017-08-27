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

Route::get('/', 'HomeController@index');

$this->get('register-account', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register-account', 'Auth\RegisterController@register');
$this->get('login-page', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login-page', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');
$this->get('password-reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password-email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password-reset-{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password-reset', 'Auth\ResetPasswordController@reset');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user-profile', 'HomeController@user_profile')->name('UserProfile');
Route::post('/changeAvatar', 'UserController@changeAvatar')->name('changeavatar');
Route::post('/changePassword', 'UserController@changePassword')->name('changepassword');
Route::post('/changeUserinfo', 'UserController@changeUserinfo')->name('changeuserinfo');
Route::post('/changePhoneNumber', 'UserController@changePhoneNumber')->name('changephonenumber');
Route::post('/changeEmailAddress', 'UserController@changeEmailAddress')->name('changeemailaddress');

Route::post('/termsServiceEdit', 'SiteHelpController@update_terms');
Route::post('/privacyPolicyEdit', 'SiteHelpController@update_privacy');
Route::post('/aboutUsEdit', 'SiteHelpController@update_aboutus');
Route::get('/getSiteHelp', 'SiteHelpController@getsitehelpdata');
Route::get('/user-management', 'HomeController@user_management');
Route::post('/delete-user', 'UserController@delete_user');
Route::get('/terms-and-condition', 'SiteHelpController@termsCondition');
Route::get('/about-us', 'SiteHelpController@about_us');
Route::get('/privacy-policy', 'SiteHelpController@privacy_policy');

Route::get('/create-new-application', 'HomeController@create_new_application')->name('createnewapplication');
Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');
