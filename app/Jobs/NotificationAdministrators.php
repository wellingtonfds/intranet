<?php

namespace App\Jobs;

use App\Mail\NewProcedure;
use App\Procedure;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class NotificationAdministrators implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $procedure;
    protected $message;
    protected $user;

    public function __construct(Procedure $procedure, NewProcedure $message)
    {
        $this->procedure = $procedure;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = DB::table('users')
            ->select(['users.name', 'users.email'])
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.id', '=', 4)
            ->get();
        foreach ($users as $user) {
            //$this->message->setBody(str_replace('[user_name]', $user->name, $this->message->getBody()));
            $this->message->to($user->email);
        }
        $this->message->setBody(str_replace('[procedure_name]', $this->procedure->name, $this->message->getBody()));
        $this->message->from(env('MAIL_DEFAULT_TI', 'informe@lyonengenharia.com'));
        Mail::send($this->message);
    }
}
