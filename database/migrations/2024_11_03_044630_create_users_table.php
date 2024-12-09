<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('type')->default(2);
            $table->integer('role')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'type' => 1,
            'created_at' => Carbon::now()
        ]);

        // Create permissions with 'admin' guard
        Permission::firstOrCreate([
            'guard_name' => 'admin',
            'name' => 'permissions view',
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'admin',
            'name' => 'permissions create'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'admin',
            'name' => 'admins view'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'admin',
            'name' => 'roles view'
        ]);

        // Create the 'admin' role with the 'admin' guard
        $role = Role::firstOrCreate([
            'guard_name' => 'admin',
            'name' => 'super admin'
        ]);

        // Assign permissions to the role
        $permissions = Permission::where('guard_name', 'admin')->get();
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }

        // Assign the role to the user
        $user->assignRole('super admin');






    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
