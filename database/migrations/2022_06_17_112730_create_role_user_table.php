<?php

use App\Constants\RoleConstants;
use App\Domain\Users\Data\Role\Enums\RoleEnum;
use App\Domain\Users\Models\RoleUser;
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
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

        RoleUser::create([
            'user_id'   =>  User::first()->id,
            'role_id'   =>  RoleEnum::SYSTEM_ADMIN->value
        ]);

        RoleUser::create([
            'user_id'   =>  User::first()->id,
            'role_id'   =>  RoleEnum::AUDIT_OPERATOR->value
        ]);

        RoleUser::create([
            'user_id'   =>  User::first()->id,
            'role_id'   =>  RoleEnum::OBSERVER->value
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
    }
};
