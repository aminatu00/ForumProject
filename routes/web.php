<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SondageController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\MentoratController;
use App\Http\Controllers\ProfileController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('questions.index');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('');

Route::middleware(['auth'])->group(function () {
   

    // administrateurrrrrrr
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');







    
    // studenttttttttttt
    
    Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');










    
    // mentorrrrrrrrrrr
    Route::get('/mentor/dashboard', [MentorController::class, 'index'])->name('mentor.dashboard');

//categorie qui s'affiche 
Route::get('/categorie', [CategoryController::class, 'index'])->name('categorie.index');
Route::get('/categorie/{id}/questions', [QuestionController::class, 'getQuestionsByCategory'])->name('categorie.show');

//creer question 
Route::get('/create', [QuestionController::class, 'create'])->name('questions.create');
Route::post('/questionstore', [QuestionController::class, 'store'])->name('questions.store');

//chercher question
Route::get('/questions/search', [QuestionController::class, 'search'])->name('questions.search');
//afficher la liste des question
Route::get('/questions', [QuestionController::class, 'index'])->name('question.index');
//pour la reponses
Route::get('/questions/{question}/answers', [AnswerController::class, 'show'])->name('answers.show');
//enregister la reponse
Route::post('/questions/{question}/answers', [AnswerController::class, 'store'])->name('answers.store');
//aimer question
Route::post('/questions/{question}/like', [QuestionController::class, 'like'])->name('questions.like');
 //affichage notification
 Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');   
    //affichage question
    Route::get('/questions/{question}', [QuestionController::class, 'show'])->name('questions.show');

    //route d'aime de reponse
    Route::post('/answers/{answer}/like', [AnswerController::class, 'like'])->name('answers.like');
    //mis a jouir de la reponse a pres modification
    Route::put('/answers/{answer}', [AnswerController::class, 'update'])->name('answers.update');
    //edition reponse
    Route::get('/answers/{answer}/edit', [AnswerController::class, 'edit'])->name('answers.edit');
    //liste des etidiants dans le systeme
    Route::get('/listeUser', [UserController::class, 'index'])->name('listeUser.index');
    //edition des utilisateur
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    //pour supprimer un utilisateur
    Route::delete('/users/{user}/destroy', [UserController::class, 'destroy'])->name('users.destroy');
    //affichage page notification
    Route::get('/notif', [NotificationController::class, 'show'])->name('notification.show');
    //route pour l'affichage du formulaire de creation de sondage
    Route::get('/sondage/create', [SondageController::class, 'create'])->name('sondage.create');
    //enregister sondage dan sla base de donnes
    Route::post('/surveys', [SondageController::class, 'store'])->name('sondage.store');
    //afficher page sondage pour les etudiants
    // Route::get('/surveys/{id}', [SondageController::class, 'show'])->name('sondage.show');
    //test pour afficher sondage sans id
    Route::get('/sondage', [SondageController::class, 'showForUser'])->name('sondage.showForUser');
    //route entegister spndage
    // Route::get('/vote/{surveyId}/{option}', [VoteController::class, 'vote'])->name('vote');
    //
    // Route::get('/vote/{id}', [VoteController::class, 'show'])->name('vote.show');
    //
    // Route::get('/sondageuu', [VoteController::class, 'store'])->name('responses.store');
//
//enregister sondage dans la base de donnee
Route::post('/vote/{surveyId}/{option}', [VoterController::class, 'vote'])->name('vote.submit');
// Route::get('/vote/{surveyId}', [VoterController::class, 'show'])->name('vote.show');

//la vue pour mentor voit resulat sondage
Route::get('/survey/{surveyId}', [VoterController::class, 'show'])->name('view.survey');

//pour supprimer sondage
Route::get('/surveys/{surveyId}', [SondageController::class, 'destroy'])->name('sondages.destroy');

//pour creer mentorat 
Route::get('/mentorat/create/{surveyId}', [SondageController::class, 'createMentorat'])->name('mentorat.create');

//route pour formulaire de mentorat
// Route::post('/meetings/create/{surveyId}/{survey}', [MentoratController::class, 'create'])->name('meetings.create');

Route::get('/meetings/create', [MentoratController::class, 'create'])->name('meetings.create');

// Route::delete('/meetings/create/{surveyId}/{survey}', [MentoratController::class, 'destroy'])->name('meetings.destroy');

Route::post('/meetings', [MentoratController::class, 'store'])->name('meetings.store');

Route::get('/meetings/mentorat/', [MentoratController::class, 'index'])->name('meetings.index');


// Route pour afficher le formulaire de modification
Route::get('/meetings/{meeting}/edit', [MentoratController::class, 'edit'])->name('meetings.edit');

// Route pour mettre à jour le meeting après modification
Route::put('/meetings/{meeting}', [MentoratController::class, 'update'])->name('meetings.update');

// Route pour supprimer le meeting
Route::delete('/meetings/{meeting}', [MentoratController::class, 'destroy'])->name('meetings.destroy');

//
Route::delete('/meetings/{meeting}', [MentoratController::class, 'destroy'])->name('meetings.destroy');

//la photo de profil
Route::get('/profile',[ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/update',[ProfileController::class, 'update'])->name('profile.update');

    //associer un sondage a un meet 
    Route::get('/surveys/{survey}/meetings', [MentoratController::class, 'showMeetingsForSurvey'])->name('surveys.meetings');


//mentorat pour que les etudiants puissent voir les mentorats
// Route::get('/meetings/mentorat', [MentoratController::class, 'index'])->name('meetings.index');








});

