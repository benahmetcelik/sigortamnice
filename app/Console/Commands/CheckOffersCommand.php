<?php

    namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Offer;
use App\Jobs\CheckOfferJob;
class CheckOffersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-offers-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $offers = Offer::where('is_completed',0)->get();
        foreach ($offers as $offer) {
           // Jobı çağır
           dispatch(new CheckOfferJob($offer))->onQueue('check-offer');
        }
    }
}
