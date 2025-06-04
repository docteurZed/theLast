<?php

use App\Http\Controllers\Admin\{
    AdminController,
    DashboardController,
    EventController,
    EventProgramController,
    ExpenseController,
    GuestController,
    GuestMessageController,
    IncomeController,
    InteractionController,
    InvitationController,
    OrganizerController,
    PaymentController,
    SettingController,
    SlideController,
    SpecialGuestController,
    SponsorController,
    TaskController,
    TaskDetailController,
    TestimonyController,
};
use App\Http\Controllers\Admin\Pages\{
    AboutController as PagesAboutController,
    ContactController as PagesContactController,
    HomeController as PagesHomeController
};
use App\Http\Controllers\Guest\{
    AboutController,
    ConfirmationController,
    ContactController,
    HomeController
};
use App\Http\Controllers\Participant\{
    DashboardController as ParticipantDashboardController,
    GaleryController,
    LikeController,
    NotificationController,
    ParticipantMessageController,
    PostController,
    ProfileController,
    PublicationController,
    VoteController
};
use App\Http\Controllers\SystemNotificationController;
use App\Http\Controllers\VoteCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/contact/message', [ContactController::class, 'show'])->name('contact.message');
Route::get('/confirmation', [ConfirmationController::class, 'index'])->name('confirmation');
Route::get('/confirmation/message', [ConfirmationController::class, 'show'])->name('confirmation.message');
Route::get('/invitation/{code}-{token}', [InvitationController::class, 'show'])->name('invitation');

Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::post('/confirmation/store', [ConfirmationController::class, 'store'])->name('confirmation.store');

Route::middleware('auth')->group(function () {

    Route::prefix('participant')->name('participant.')->group(function () {

        Route::get('/dashboard', [ParticipantDashboardController::class, 'index'])->name('dashboard');

        Route::prefix('profile')->name('profile.')->group(function () {

            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::put('/{id}/update', [ProfileController::class, 'update'])->name('update');

        });

        Route::prefix('post')->name('post.')->group(function () {

            Route::get('/', [PostController::class, 'index'])->name('index');

        });

        Route::prefix('galery')->name('galery.')->group(function () {

            Route::get('/', [GaleryController::class, 'index'])->name('index');

        });

        Route::prefix('vote')->name('vote.')->group(function () {

            Route::get('/', [VoteController::class, 'index'])->name('index');
            Route::post('/store', [VoteController::class, 'store'])->name('store');
            Route::post('/multiplestore', [VoteController::class, 'multipleStore'])->name('multipleStore');

        });

        Route::prefix('notification')->name('notification.')->group(function () {

            Route::get('/', [NotificationController::class, 'index'])->name('index');
            Route::get('/{threadKey}/show', [NotificationController::class, 'show'])->name('show');
            Route::post('/store-fcm-token', [NotificationController::class, 'storeToken']);

        });

        Route::prefix('message')->name('message.')->group(function () {

            Route::post('/store', [ParticipantMessageController::class, 'store'])->name('store');
            Route::post('/{id}/updateStatut', [ParticipantMessageController::class, 'updateStatut'])->name('updateStatut');

        });

        Route::prefix('like')->name('like.')->group(function () {

            Route::post('{id}/send', [LikeController::class, 'like'])->name('send');

        });

        Route::prefix('publication')->name('publication.')->group(function () {

            Route::get('/', [PublicationController::class, 'index'])->name('index');
            Route::post('/store', [PublicationController::class, 'store'])->name('store');
            Route::delete('/{id}/destroy', [PublicationController::class, 'destroy'])->name('destroy');

            // AJAX
            Route::post('/{id}/like', [PublicationController::class, 'toggleLike'])->name('like');
            Route::post('/comment', [PublicationController::class, 'addComment'])->name('comment');
            Route::delete('/comment/{id}/destroy', [PublicationController::class, 'destroyComment'])->name('destroyComment');

        });

    });

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('admin')->name('admin.')->group(function () {

            Route::get('/', [AdminController::class, 'index'])->name('index');
            Route::post('/store', [AdminController::class, 'store'])->name('store');
            Route::post('/{id}/toggle-is-ctive', [AdminController::class, 'toggleIsActive'])->name('toggleIsActive');
            Route::put('/{id}/update-payment-status', [AdminController::class, 'updatePaymentStatus'])->name('updatePaymentStatus');
            Route::put('/{id}/update', [AdminController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [AdminController::class, 'destroy'])->name('destroy')->middleware('password.confirm');

        });

        Route::prefix('organizer')->name('organizer.')->group(function () {

            Route::get('/', [OrganizerController::class, 'index'])->name('index');
            Route::post('/store', [OrganizerController::class, 'store'])->name('store');
            Route::post('/{id}/toggle-is-ctive', [OrganizerController::class, 'toggleIsActive'])->name('toggleIsActive');
            Route::put('/{id}/update-payment-status', [OrganizerController::class, 'updatePaymentStatus'])->name('updatePaymentStatus');
            Route::put('/{id}/update', [OrganizerController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [OrganizerController::class, 'destroy'])->name('destroy')->middleware('password.confirm');

        });

        Route::prefix('guest')->name('guest.')->group(function () {

            Route::get('/', [GuestController::class, 'index'])->name('index');
            Route::get('/printed-list', [GuestController::class, 'printedList'])->name('printedList');
            Route::post('/store', [GuestController::class, 'store'])->name('store');
            Route::post('/{id}/toggle-is-ctive', [GuestController::class, 'toggleIsActive'])->name('toggleIsActive');
            Route::put('/{id}/update-payment-status', [GuestController::class, 'updatePaymentStatus'])->name('updatePaymentStatus');
            Route::put('/{id}/update', [GuestController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [GuestController::class, 'destroy'])->name('destroy')->middleware('password.confirm');

        });

        Route::prefix('payment')->name('payment.')->group(function () {

            Route::get('/', [PaymentController::class, 'index'])->name('index');
            Route::post('/store', [PaymentController::class, 'store'])->name('store');
            Route::put('/{id}/update', [PaymentController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [PaymentController::class, 'destroy'])->name('destroy');

        });

        Route::prefix('task')->name('task.')->group(function () {

            Route::get('/', [TaskController::class, 'index'])->name('index');
            Route::get('/{id}/detail', [TaskController::class, 'detail'])->name('detail');

            Route::post('/store', [TaskController::class, 'store'])->name('store');
            Route::put('/{id}/update', [TaskController::class, 'update'])->name('update');
            Route::delete('/d{id}/estroy', [TaskController::class, 'destroy'])->name('destroy');

        });

        Route::prefix('task/detail')->name('task.detail.')->group(function () {

            Route::post('/store', [TaskDetailController::class, 'store'])->name('store');
            Route::post('/update{id}/Statut', [TaskDetailController::class, 'destroy'])->name('updateStatut');
            Route::put('/{id}/update', [TaskDetailController::class, 'update'])->name('update');
            Route::delete('/d{id}/estroy', [TaskDetailController::class, 'destroy'])->name('destroy');

        });

        Route::prefix('message')->name('message.')->group(function () {

            Route::get('/', [GuestMessageController::class, 'index'])->name('index');
            Route::post('/{id}/updateStatut', [GuestMessageController::class, 'updateStatut'])->name('updateStatut');
            Route::delete('/{id}/destroy', [GuestMessageController::class, 'destroy'])->name('destroy');

        });

        Route::prefix('setting')->name('setting.')->group(function () {

            Route::get('/', [SettingController::class, 'index'])->name('index');
            Route::put('/update', [SettingController::class, 'update'])->name('update');

        });

        Route::prefix('page/home')->name('page.home.')->group(function () {

            Route::get('/', [PagesHomeController::class, 'index'])->name('index');
            Route::put('/update', [PagesHomeController::class, 'update'])->name('update');

        });

        Route::prefix('page/about')->name('page.about.')->group(function () {

            Route::get('/', [PagesAboutController::class, 'index'])->name('index');
            Route::put('/update', [PagesAboutController::class, 'update'])->name('update');

        });

        Route::prefix('page/contact')->name('page.contact.')->group(function () {

            Route::get('/', [PagesContactController::class, 'index'])->name('index');
            Route::put('/update', [PagesContactController::class, 'update'])->name('update');

        });

        Route::prefix('special/guest')->name('special.guest.')->group(function () {

            Route::get('/', [SpecialGuestController::class, 'index'])->name('index');
            Route::post('/store', [SpecialGuestController::class, 'store'])->name('store');
            Route::put('/{id}/update', [SpecialGuestController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [SpecialGuestController::class, 'destroy'])->name('destroy');

        });

        Route::prefix('testimony')->name('testimony.')->group(function () {

            Route::get('/', [TestimonyController::class, 'index'])->name('index');
            Route::post('/store', [TestimonyController::class, 'store'])->name('store');
            Route::put('/{id}/update', [TestimonyController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [TestimonyController::class, 'destroy'])->name('destroy');

        });

        Route::prefix('sponsor')->name('sponsor.')->group(function () {

            Route::get('/', [SponsorController::class, 'index'])->name('index');
            Route::post('/store', [SponsorController::class, 'store'])->name('store');
            Route::put('/{id}/update', [SponsorController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [SponsorController::class, 'destroy'])->name('destroy');

        });

        Route::prefix('event')->name('event.')->group(function () {

            Route::get('/', [EventController::class, 'index'])->name('index');
            Route::post('/store', [EventController::class, 'store'])->name('store');
            Route::put('/{id}/update', [EventController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [EventController::class, 'destroy'])->name('destroy');

        });

        Route::prefix('event/program')->name('event.program.')->group(function () {

            Route::get('/{eventId}/list', [EventProgramController::class, 'index'])->name('index');
            Route::post('/store', [EventProgramController::class, 'store'])->name('store');
            Route::put('/{id}/update', [EventProgramController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [EventProgramController::class, 'destroy'])->name('destroy');

        });

        Route::prefix('income')->name('income.')->group(function () {

            Route::get('/', [IncomeController::class, 'index'])->name('index');
            Route::post('/store', [IncomeController::class, 'store'])->name('store');
            Route::put('/{id}/update', [IncomeController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [IncomeController::class, 'destroy'])->name('destroy');

        });

        Route::prefix('expense')->name('expense.')->group(function () {

            Route::get('/', [ExpenseController::class, 'index'])->name('index');
            Route::post('/store', [ExpenseController::class, 'store'])->name('store');
            Route::put('/{id}/update', [ExpenseController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [ExpenseController::class, 'destroy'])->name('destroy');

        });

        Route::prefix('invitation')->name('invitation.')->group(function () {

            Route::get('/', [InvitationController::class, 'index'])->name('index');
            Route::get('/template', [InvitationController::class, 'template'])->name('template');
            Route::get('/{id}/show', [InvitationController::class, 'show'])->name('show');
            Route::post('/store', [InvitationController::class, 'store'])->name('store');
            Route::post('/send', [InvitationController::class, 'send'])->name('send');
            Route::post('/{id}/send-detail', [InvitationController::class, 'sendDetail'])->name('sendDetail');
            Route::delete('/destroy', [InvitationController::class, 'destroy'])->name('destroy');

        });

        Route::prefix('vote')->name('vote.category.')->group(function () {

            Route::get('/', [VoteCategoryController::class, 'index'])->name('index');
            Route::post('/store', [VoteCategoryController::class, 'store'])->name('store');
            Route::put('/{id}/update', [VoteCategoryController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [VoteCategoryController::class, 'destroy'])->name('destroy');

        });

        Route::prefix('slide')->name('slide.')->group(function () {

            Route::get('/', [SlideController::class, 'index'])->name('index');
            Route::post('/store', [SlideController::class, 'store'])->name('store');
            Route::put('/{id}/update', [SlideController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [SlideController::class, 'destroy'])->name('destroy');

        });

        Route::prefix('interaction')->name('interaction.')->group(function () {

            Route::get('/', [InteractionController::class, 'index'])->name('index');

        });

        Route::prefix('system-notification')->name('system.notification.')->group(function () {

            Route::get('/', [SystemNotificationController::class, 'index'])->name('index');
            Route::post('/store', [SystemNotificationController::class, 'store'])->name('store');

        });

    });

});

require __DIR__.'/auth.php';
