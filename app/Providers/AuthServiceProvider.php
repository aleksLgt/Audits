<?php

namespace App\Providers;

use App\Domain\Audits\Models\Audit;
use App\Domain\Users\Data\Role\Enums\RoleEnum;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('can-create-audit', function (User $user) {
            return auth()->user()
                ->whereRelation('roles', 'role_user.role_id', '=', RoleEnum::AUDIT_OPERATOR->value)
                ->exists();
        });

        Gate::define('can-update-audit', function (User $user, int $id) {
            return $this->canUserChangeAudit($user, $id);
        });

        Gate::define('can-delete-audit', function (User $user, int $id) {
            return $this->canUserChangeAudit($user, $id);
        });
    }

    private function canUserChangeAudit(User $user, int $id): bool
    {
        $audit = Audit::findOrFail($id);

        return $user->whereRelation('roles', 'role_user.role_id', '=', RoleEnum::AUDIT_OPERATOR->value)
                ->exists() && $audit->user_id == $user->id;
    }
}
