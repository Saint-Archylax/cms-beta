<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function create()
    {
        return view('account.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'location' => ['required', 'in:Onsite,Remote'],
            'salary' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email', 'unique:team_members,email'],
            'phone' => ['required', 'string', 'max:50'],
            'gender' => ['required', 'string', 'max:50'],
            'date_of_birth' => ['required', 'date'],
            'nationality' => ['required', 'string', 'max:100'],
            'address_line' => ['required', 'string', 'max:255'],
            'address_city' => ['required', 'string', 'max:255'],
            'address_state' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        DB::transaction(function () use ($data) {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => 'employee',
                'password' => $data['password'],
            ]);

            TeamMember::create([
                'name' => $data['name'],
                'role' => $data['role'],
                'location' => $data['location'],
                'salary' => $data['salary'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'gender' => $data['gender'],
                'date_of_birth' => $data['date_of_birth'],
                'nationality' => $data['nationality'],
                'address_line' => $data['address_line'],
                'address_city' => $data['address_city'],
                'address_state' => $data['address_state'],
                'workload' => 0,
            ]);
        });

        return redirect()->route('team.documents')->with('success', 'Employee account created');
    }
}
