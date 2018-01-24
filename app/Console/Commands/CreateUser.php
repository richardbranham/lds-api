<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user account';

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
        $u = new User();
        $u->id = User::max('id') + 1;
        $u->name = "User" . $u->id . " Last" . $u->id;
        $u->email = "User" . $u->id . "Last" . $u->id . "@branham.us";
        $u->password = User::where('id', '=', '1')->first()->password;
        $u->save();
    }
}
