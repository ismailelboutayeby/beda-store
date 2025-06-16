<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->hasRole('general_manager')) {
            return redirect('/dashboard');
        } elseif ($user->hasRole('designer')) {
            return redirect('/designer/orders');
        } elseif ($user->hasRole('warehouse_manager')) {
            return redirect('/warehouse/orders');
        } elseif ($user->hasRole('atelier_manager')) {
            return redirect('/atelier/orders');
        } elseif ($user->hasRole('logistic')) {
            return redirect('/logistics/orders');
        } elseif ($user->hasRole('admin')) {
            return redirect('/invoices');
        } elseif ($user->hasRole('client')) {
            return redirect('/client/orders');
        }

        return redirect('/'); // Fallback route
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
