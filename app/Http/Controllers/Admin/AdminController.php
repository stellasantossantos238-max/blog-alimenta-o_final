<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{


    public function dashboard()
    {
        $stats = [
            'total_users'       => User::count(),
            'total_posts'       => Post::count(),
            'posts_publicados'  => Post::where('publicado', true)->count(),
            'admins'            => User::where('role', 'admin')->count(),
            'profissionais'     => User::where('role', 'profissional')->count(),
            'utilizadores'      => User::where('role', 'utilizador')->count(),
            'posts_noticia'     => Post::where('tipo', 'noticia')->count(),
            'posts_sugestao'    => Post::where('tipo', 'sugestao')->count(),
            'posts_alimentacao' => Post::where('tipo', 'alimentacao_saudavel')->count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentPosts = Post::with('author')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentPosts'));
    }

    public function users(Request $request)
    {
        $role  = $request->query('role');
        $users = User::when($role, fn($q) => $q->where('role', $role))
            ->latest()->paginate(20)->withQueryString();

        return view('admin.users', compact('users', 'role'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        $request->validate(['role' => 'required|in:utilizador,profissional,admin']);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Não podes alterar o teu próprio role.');
        }

        $user->update(['role' => $request->role]);
        return back()->with('success', "Role de {$user->name} atualizado para {$request->role}.");
    }

    public function posts(Request $request)
    {
        $tipo      = $request->query('tipo');
        $publicado = $request->query('publicado');

        $posts = Post::with('author')
            ->when($tipo, fn($q) => $q->where('tipo', $tipo))
            ->when($publicado !== null, fn($q) => $q->where('publicado', (bool)$publicado))
            ->latest()->paginate(20)->withQueryString();

        return view('admin.posts', compact('posts', 'tipo', 'publicado'));
    }

    public function togglePost(Post $post)
    {
        $post->update(['publicado' => !$post->publicado]);
        $estado = $post->publicado ? 'publicado' : 'despublicado';
        return back()->with('success', "Post \"{$post->titulo}\" {$estado}.");
    }

    public function deletePost(Post $post)
    {
        $titulo = $post->titulo;
        $post->delete();
        return back()->with('success', "Post \"{$titulo}\" eliminado.");
    }
}
