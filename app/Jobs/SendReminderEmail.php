<?php

namespace App\Jobs;

use App\Mail\NewProcedure;
use App\Procedure;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $procedure;
    protected $user;
    public function __construct(Procedure $procedure,User $user)
    {
        $this->procedure = $procedure;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = DB::table('users')
            ->select(['users.name','users.email'])
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.id', '!=', $this->user->id)
            ->get();
        foreach ($users as $user) {
            $email = new NewProcedure('Atenção ao procedimento', "Prezado(a) colaborador(a)  " . $user->name . ", gostaria de
            solicitar sua atenção para o procedimento \"" . $this->procedure->name . "\", categoria \"".$this->procedure->category->name." \" . <br><br>Obrigado, Sistema Informe ");
            $email->subject("Atenção ao procedimento");
            $email->to($user->email);
            $email->from(env('MAIL_DEFAULT_TI', 'informe@lyonengenharia.com'));
            Mail::send($email);
            $email = null;
        }
        $email = new NewProcedure('Notificação', "Prezado(a) colaborador(a)  " . $this->user->name . ", gostariamos de
            informar que todos os usuários foram notificados para ler o procedimento " . $this->procedure->name . "\", categoria \"".$this->procedure->category->name." \". <br><br>Obrigado, Sistema Informe ");
        $email->subject("Notificação de usuários");
        $email->to($this->user->email);
        $email->from(env('MAIL_DEFAULT_TI', 'informe@lyonengenharia.com'));
        Mail::send($email);
    }
}
