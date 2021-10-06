<?php

namespace App\Console\Commands;

use App\Models\Lead;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderMail as newreminder;



class DocumentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'document:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify user to update document of vehicule';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $leads = Lead::all();
        foreach ($leads as $lead){
            $assuranceF=  $lead -> assuranceF;
            $cartegriseF=  $lead -> cartegriseF;
            $visitetechniqueF= $lead -> visitetechniqueF;
            $immatriculation=$lead -> immatriculation;

            $carbon30daysassuranceF = Carbon::parse($assuranceF)->subDay(1)->toDateString();
            $carbon30dayscartegriseF = Carbon::parse($cartegriseF)->subDay(1)->toDateString();
            $carbon30daysvisitetechniqueF = Carbon::parse($visitetechniqueF)->subDay(1)->toDateString();

            $currentDate = Carbon::today()->toDateString();

            $lead = (object)
            array(
                'immatriculation'    =>$immatriculation,
                'assuranceF'         => $assuranceF,
                'cartegriseF'        => $cartegriseF,
                'visitetechniqueF'      => $visitetechniqueF,
            );

            if($currentDate == $carbon30daysassuranceF || $carbon30dayscartegriseF || $carbon30daysvisitetechniqueF){
                Mail::to('magloirekitio1@gmail.com')->send(new newreminder($lead));
            }
        }
        $this->info('Repayment Notification has been Sent');
        //
    }
}
