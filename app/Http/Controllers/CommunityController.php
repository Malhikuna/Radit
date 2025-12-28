<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;

class CommunityController extends Controller
{
    public function join(Community $community)
    {
        $user = auth()->user();

        // cek apakah user sudah join
        if ($community->members()->where('user_id', $user->id)->exists()) {
            return back()->with('message', 'Anda sudah menjadi member.');
        }

        // tambahkan user ke anggota
        $community->members()->attach($user->id);

        return back()->with('success', 'Berhasil join komunitas!');
    }
}
