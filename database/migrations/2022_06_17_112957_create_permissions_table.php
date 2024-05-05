<?php

use App\Domain\Users\Models\Permission;
use Illuminate\Console\Command;
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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('uri');
            $table->string('method');
            $table->string('group');
            $table->timestamps();
        });

        $this->fillPermissions();
    }

    private function fillPermissions()
    {
        $currentRoutes = Route::getRoutes()->get();

        try {
            DB::transaction(function () use ($currentRoutes) {
                foreach ($currentRoutes as $route) {
                    if (!str_contains($route->uri, '_ignition')
                        && !str_contains($route->uri, 'sanctum')
                        && !str_contains($route->uri, 'broadcasting')
                        && !str_contains($route->uri, 'test')
                    ) {
                        $method = $this->getRouteMethod($route);
                        if (Permission::where('uri', $route->uri)
                            ->where('method', $method)
                            ->doesntExist()) {
                            $groupWithName = $route->getAction('as');
                            if (empty($groupWithName)) {
                                throw new Exception();
                            }

                            $groupWithNameArray = explode('|', $groupWithName);
                            if (Permission::where('name', $groupWithNameArray[1])->exists()) {
                                continue;
                            }

                            Permission::create([
                                'name'      =>  $groupWithNameArray[1],
                                'group'     =>  $groupWithNameArray[0],
                                'uri'       =>  '/' . $route->uri,
                                'method'    =>  $method,
                            ]);
                        }
                    }
                }
            });
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return Command::SUCCESS;
    }

        protected function getRouteMethod(\Illuminate\Routing\Route $route)
    {
        $allMethods = $route->methods;
        $headKey = array_search('HEAD', $allMethods);
        if ($headKey !== false) {
            unset($allMethods[$headKey]);
        }

        return $allMethods[0];
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
};
