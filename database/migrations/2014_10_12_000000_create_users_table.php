<?php

use App\Domain\Users\Data\Role\Enums\ShiftEnum;
use App\Domain\Users\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('login')->unique();
            $table->string('name');
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('post');
            $table->integer('shift');
            $table->boolean('is_blocked')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        //Логин admin, пароль Admin123
        User::create([
            'login'     =>  'admin',
            'name'      =>  'Администратор',
            'password'  =>  '$2y$10$MD0kwUbciU7UP1rExhIj5O4q.660dIe/5ATIPCMxaZw7b5l8h.dHO',
            'email'     =>  'admin@email.com',
            'post'      =>  'employee',
            'shift'     =>  ShiftEnum::DAY->value,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
