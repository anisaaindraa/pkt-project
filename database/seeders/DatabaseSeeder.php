<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\FormulirPatroliLaut;
use App\Models\Role;
use App\Models\Status;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MPos;
use App\Models\MShift;
use App\Models\MSipam;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        Role::create([
            "nama_role" => "Admin",
        ]);

        User::create([
            'role_id' => '1',
            'nama_user' => 'Test User',
            'email' => 'test@example.com',
            'username' => 'test@example.com',
            'password' => bcrypt('123'),
            'alamat_user' => 'pkt',
            'pekerjaan_user' => 'karyawan',
            'npk_user' => '12345',
        ]);

        MPos::create([
            'nama_pos' => 'Kaltim 1',
            'keterangan' => 'Kantor Pusat',
        ]);

        MPos::create([
            'nama_pos' => 'Kaltim 2',
            'keterangan' => 'Pabrik 1',
        ]);

        MPos::create([
            'nama_pos' => 'Kaltim 3',
            'keterangan' => 'Pabrik 2',
        ]);

        MPos::create([
            'nama_pos' => 'Kaltim 4',
            'keterangan' => 'Pabrik 3',
        ]);

        MPos::create([
            'nama_pos' => 'Kaltim 5',
            'keterangan' => 'Pabrik 4',
        ]);

        MShift::create([
            'nama_shift' => 'Pagi',
            'keterangan' => '06:00:00 AM - 10:00:00 AM',
        ]);

        MShift::create([
            'nama_shift' => 'Siang',
            'keterangan' => '10:00:00 AM - 14:00:00 PM',
        ]);

        MShift::create([
            'nama_shift' => 'Sore',
            'keterangan' => '14:00:00 PM - 18:00:00 PM',
        ]);

        MShift::create([
            'nama_shift' => 'Malam',
            'keterangan' => '18:00:00 PM - 22:00:00 PM',
        ]);

        MSipam::create([
            'nama_sipam' => 'A',
            'keterangan' => 'Desk A',
        ]);

        MSipam::create([
            'nama_sipam' => 'B',
            'keterangan' => 'Desk B',
        ]);

        MSipam::create([
            'nama_sipam' => 'C',
            'keterangan' => 'Desk C',
        ]);

        MSipam::create([
            'nama_sipam' => 'D',
            'keterangan' => 'Desk D',
        ]);

        Status::create([
            'nama_status' => 'Submitted',
        ]);

        Status::create([
            'nama_status' => 'Approved',
        ]);

        FormulirPatroliLaut::create([
            'users_id' => '1',
            'tanggal_kejadian' => '2023-01-01 09:30:00',
            'm_shift_id' => '2',
            'uraian_hasil' => 'Lorem Ipsum',
            'keterangan' => 'Aman',
            'status_id' => '1',
        ]);

    }
}
