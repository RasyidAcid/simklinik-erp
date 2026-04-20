<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\Cabang;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
   public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
            'user' => function () {
                $user = auth()->user();

                return $user ? [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'cab_code' => $user->cab_code,
                    'cab_name' => $user->cab_code
                        ? Cabang::where('cab_code', $user->cab_code)->value('cab_name')
                        : 'Semua Cabang',
                ] : null;
            },
        ],
        ]);
    }
}
