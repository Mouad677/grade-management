<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'admin') {
                abort(403, 'Accès non autorisé.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,assistant,student',
            'student_code' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'student_code' => $validated['student_code'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
        ]);

        Log::info('Utilisateur créé', ['user_id' => $user->id, 'role' => $user->role]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,assistant,student',
            'student_code' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        Log::info('Utilisateur mis à jour', ['user_id' => $user->id, 'role' => $user->role]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();
        Log::info('Utilisateur supprimé', ['user_id' => $user->id]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function destroyAllStudents(Request $request)
    {
        if (!$request->has('confirm') || $request->confirm !== 'true') {
            return redirect()->back()->with('error', 'Confirmation requise pour supprimer tous les étudiants.');
        }

        try {
            DB::beginTransaction();

            // Supprimer d'abord les notes
            DB::table('grades')->whereIn('student_id', function($query) {
                $query->select('id')->from('users')->where('role', 'student');
            })->delete();

            // Supprimer ensuite les étudiants
            $deletedCount = User::where('role', 'student')->delete();

            DB::commit();

            Log::info('Tous les étudiants supprimés', ['count' => $deletedCount]);

        return redirect()->route('admin.users.index')
                ->with('success', "{$deletedCount} étudiants ont été supprimés avec succès.");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la suppression des étudiants', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression des étudiants.');
        }
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('student_code', 'like', "%{$search}%")
            ->orWhere('first_name', 'like', "%{$search}%")
            ->orWhere('last_name', 'like', "%{$search}%")
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }
}
