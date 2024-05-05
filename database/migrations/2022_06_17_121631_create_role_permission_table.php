<?php

use App\Constants\RoleConstants;
use App\Domain\Users\Data\Role\Enums\RoleEnum;
use App\Domain\Users\Models\Permission;
use App\Domain\Users\Models\RolePermission;
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
        Schema::create('role_permission', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('permission_id');
            $table->foreign('permission_id')->references('id')->on('permissions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

        $this->fillRolePermissions();
    }

    private function fillRolePermissions()
    {
        foreach (Permission::get() as $permission) {
            RolePermission::create([
                'role_id'       =>  RoleEnum::SYSTEM_ADMIN->value,
                'permission_id' =>  $permission->id,
            ]);
        }

        RolePermission::create([
            'role_id'       =>  RoleEnum::AUDIT_OPERATOR->value,
            'permission_id' =>  Permission::whereUri('/audits')->whereMethod('POST')->first()->id,
        ]);

        RolePermission::create([
            'role_id'       =>  RoleEnum::AUDIT_OPERATOR->value,
            'permission_id' =>  Permission::whereUri('/audits')->whereMethod('GET')->first()->id,
        ]);

        RolePermission::create([
            'role_id'       =>  RoleEnum::AUDIT_OPERATOR->value,
            'permission_id' =>  Permission::whereUri('/audits/{id}')->whereMethod('GET')->first()->id,
        ]);

        RolePermission::create([
            'role_id'       =>  RoleEnum::AUDIT_OPERATOR->value,
            'permission_id' =>  Permission::whereUri('/audits/{id}')->whereMethod('PUT')->first()->id,
        ]);

        RolePermission::create([
            'role_id'       =>  RoleEnum::AUDIT_OPERATOR->value,
            'permission_id' =>  Permission::whereUri('/audits/{id}')->whereMethod('DELETE')->first()->id,
        ]);

        RolePermission::create([
            'role_id'       =>  RoleEnum::OBSERVER->value,
            'permission_id' =>  Permission::whereUri('/audits')->whereMethod('GET')->first()->id,
        ]);

        RolePermission::create([
            'role_id'       =>  RoleEnum::OBSERVER->value,
            'permission_id' =>  Permission::whereUri('/audits/{id}')->whereMethod('GET')->first()->id,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_permission');
    }
};
