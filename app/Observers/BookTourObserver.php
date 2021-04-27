<?php

namespace App\Observers;

use App\Enums\BookingStatus;
use App\Models\BookTour;
use App\Models\Bill;

class BookTourObserver
{
    /**
     * Handle the BookTour "created" event.
     *
     * @param  \App\Models\BookTour  $bookTour
     * @return void
     */
    public function created(BookTour $bookTour)
    {

    }

    /**
     * Handle the BookTour "updated" event.
     *
     * @param  \App\Models\BookTour  $bookTour
     * @return void
     */
    public function updated(BookTour $bookTour)
    {

    }

    /**
     * Handle the BookTour "deleted" event.
     *
     * @param  \App\Models\BookTour  $bookTour
     * @return void
     */
    public function deleted(BookTour $bookTour)
    {
        //
    }

    /**
     * Handle the BookTour "restored" event.
     *
     * @param  \App\Models\BookTour  $bookTour
     * @return void
     */
    public function restored(BookTour $bookTour)
    {
        //
    }

    /**
     * Handle the BookTour "force deleted" event.
     *
     * @param  \App\Models\BookTour  $bookTour
     * @return void
     */
    public function forceDeleted(BookTour $bookTour)
    {
        //
    }
}
