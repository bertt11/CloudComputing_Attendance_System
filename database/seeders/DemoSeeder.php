<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder {
    public function run(){
        // Owner
        $owner = User::create([
            'name'=>'Owner Demo',
            'email'=>'owner@example.com',
            'password'=>Hash::make('password'),
            'role'=>'owner'
        ]);

        // Admin
        $admin = User::create([
            'name'=>'Admin Demo',
            'email'=>'admin@example.com',
            'password'=>Hash::make('password'),
            'role'=>'admin'
        ]);

        // Company
        $company = Company::create([
            'name'=>'PT Contoh',
            'password'=>Hash::make('secret123')
        ]);

        // Employee (and link to a user)
        $emp = Employee::create([
            'company_id'=>$company->id,
            'name'=>'Budi',
            'uid'=>'UID12345',
            'position'=>'Staff'
        ]);

        $userEmp = User::create([
            'name'=>'Budi',
            'email'=>'budi@example.com',
            'password'=>Hash::make('password'),
            'role'=>'employee',
            'company_id'=>$company->id,
            'employee_id'=>$emp->id
        ]);
    }
}
