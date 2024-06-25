<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role; // Role modelini dahil ediyoruz
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Hash sınıfını ekliyoruz

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Rolü updateOrCreate ile oluşturuyoruz veya güncelliyoruz
        $role = Role::updateOrCreate(
            ['name' => 'yonetici'],
            [
                'name' => 'yonetici',
                'title' => 'Yönetici',
                'description' => 'Sitenin Genel Yönetimini Sağlar',
            ]
        );

        // Blog yöneticisi rolünü oluşturuyoruz
        $roleBlog = Role::updateOrCreate(
            ['name' => 'blog-yoneticisi'],
            [
                'name' => 'blog-yoneticisi',
                'title' => 'Blog Yöneticisi',
                'description' => 'Blog Yönetimini Sağlar',
            ]
        );

        // E-ticaret yöneticisi rolünü oluşturuyoruz
        $roleECommerce = Role::updateOrCreate(
            ['name' => 'e-ticaret-yoneticisi'],
            [
                'name' => 'e-ticaret-yoneticisi',
                'title' => 'E-Ticaret Yöneticisi',
                'description' => 'E-Ticaret Yönetimini Sağlar',
            ]
        );

        // Kullanıcıyı updateOrCreate ile oluşturuyoruz veya güncelliyoruz
        $user = User::updateOrCreate(
            [
                'email' => 'eren@coban.com',
            ],
            [
                'name' => 'Eren',
                'email' => 'eren@coban.com',
                'password' => Hash::make('12345678'), // bcrypt() yerine Hash::make() kullanıyoruz
            ]
        );

        // Kullanıcıya rol ataması yapıyoruz
        $user->assignRole($role);

        // Eğer veritabanında sadece bir kullanıcı varsa, 100 adet rastgele kullanıcı oluşturuyoruz
        if (User::count() === 1) {
            $users = User::factory()->count(100)->create();
            foreach ($users as $user) {
                $user->assignRole(rand(0, 1) == 1 ? $roleBlog : $roleECommerce); // assignRole kullanımı düzeltildi
            }
        }
    }
}
