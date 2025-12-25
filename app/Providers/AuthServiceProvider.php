<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\CourseEnroll;
use App\Policies\CoursePolicy;
use App\Policies\CourseEnrollPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     */
    protected $policies = [
        Course::class => Course::class,
        CourseEnroll::class => CourseEnrollPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
