<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\FormulirPatroliLaut;
use App\Models\MBarangInventaris;
use App\Models\Permission;
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

        MPos::insert([
            ['nama_pos' => 'Kaltim 1', 'keterangan' => 'Kantor Pusat',],
            ['nama_pos' => 'Kaltim 2', 'keterangan' => 'Pabrik 1'],
            ['nama_pos' => 'Kaltim 3', 'keterangan' => 'Pabrik 2',],
            ['nama_pos' => 'Kaltim 4', 'keterangan' => 'Pabrik 3',],
            ['nama_pos' => 'Kaltim 5', 'keterangan' => 'Pabrik 4',]
        ]);

        MShift::insert([
            ['nama_shift' => 'Pagi', 'keterangan' => '06:00:00 AM - 10:00:00 AM',],
            ['nama_shift' => 'Siang', 'keterangan' => '10:00:00 AM - 14:00:00 PM',],
            ['nama_shift' => 'Sore', 'keterangan' => '14:00:00 PM - 18:00:00 PM',],
            ['nama_shift' => 'Malam', 'keterangan' => '18:00:00 PM - 22:00:00 PM',]
        ]);

        MSipam::insert([
            ['nama_sipam' => 'A', 'keterangan' => 'Desk A',],
            ['nama_sipam' => 'B', 'keterangan' => 'Desk B',],
            ['nama_sipam' => 'C', 'keterangan' => 'Desk C',],
            ['nama_sipam' => 'D', 'keterangan' => 'Desk D',]
        ]);

        Status::insert([
            ['nama_status' => 'Submitted'],
            ['nama_status' => 'Approved',]
        ]);

        MBarangInventaris::insert([
            ['nama_barang' => 'Buku Instruksi kerja'],
            ['nama_barang' => 'Ragio Rig VHF'],
            ['nama_barang' => 'Power Saply'],
            ['nama_barang' => 'Radio HT + Cager'],
            ['nama_barang' => 'Telepon'],
            ['nama_barang' => 'AC + Remot'],
            ['nama_barang' => 'Galon'],
            ['nama_barang' => 'Jam Dinding'],
            ['nama_barang' => 'Masker'],
            ['nama_barang' => 'Metal ditektor'],
            ['nama_barang' => 'Meror Set'],
            ['nama_barang' => 'Jas Hujan'],
            ['nama_barang' => 'APAR'],
            ['nama_barang' => 'Kotak P3K'],
            ['nama_barang' => 'Senter'],
            ['nama_barang' => 'Senter Lalin'],
            ['nama_barang' => 'Sepatu Boot'],
            ['nama_barang' => 'Meja Kerja'],
            ['nama_barang' => 'Kursi Besi'],
            ['nama_barang' => 'Ceret'],
            ['nama_barang' => 'Sepeda'],
            ['nama_barang' => 'Tongkat T + Sarung T'],
            ['nama_barang' => 'Kipas Angin'],
            ['nama_barang' => 'Badge'],
            ['nama_barang' => 'Sapu, Ember, Alat pel'],
            ['nama_barang' => 'B.A'],
        ]);

        FormulirPatroliLaut::create([
            'users_id' => '1',
            'tanggal_kejadian' => '2023-01-01 09:30:00',
            'm_shift_id' => '2',
            'uraian_hasil' => 'Lorem Ipsum',
            'keterangan' => 'Aman',
            'status_id' => '1',
        ]);

        Permission::insert([
            ['nama_permission' => 'User.create'],
            ['nama_permission' => 'User.delete'],
            ['nama_permission' => 'User.edit'],
            ['nama_permission' => 'User.browse'],
            ['nama_permission' => 'FormulirPatroliLaut.create'],
            ['nama_permission' => 'FormulirPatroliLaut.delete'],
            ['nama_permission' => 'FormulirPatroliLaut.edit'],
            ['nama_permission' => 'FormulirPatroliLaut.browse'],
            ['nama_permission' => 'FormulirPatroliLaut.approve'],
            ['nama_permission' => 'FormulirPelaksanaanTugas.create'],
            ['nama_permission' => 'FormulirPelaksanaanTugas.delete'],
            ['nama_permission' => 'FormulirPelaksanaanTugas.edit'],
            ['nama_permission' => 'FormulirPelaksanaanTugas.browse'],
            ['nama_permission' => 'FormulirPelaksanaanTugas.approve'],
            ['nama_permission' => 'FormulirPelaporanKejadian.create'],
            ['nama_permission' => 'FormulirPelaporanKejadian.delete'],
            ['nama_permission' => 'FormulirPelaporanKejadian.edit'],
            ['nama_permission' => 'FormulirPelaporanKejadian.browse'],
            ['nama_permission' => 'FormulirPelaporanKejadian.approve'],
            ['nama_permission' => 'Korban.create'],
            ['nama_permission' => 'Korban.delete'],
            ['nama_permission' => 'Korban.edit'],
            ['nama_permission' => 'Pelaku.create'],
            ['nama_permission' => 'Pelaku.delete'],
            ['nama_permission' => 'Pelaku.edit'],
            ['nama_permission' => 'MShift.create'],
            ['nama_permission' => 'MShift.delete'],
            ['nama_permission' => 'MShift.edit'],
            ['nama_permission' => 'MPos.create'],
            ['nama_permission' => 'MPos.delete'],
            ['nama_permission' => 'MPos.edit'],
            ['nama_permission' => 'MSipam.create'],
            ['nama_permission' => 'MSipam.delete'],
            ['nama_permission' => 'MSipam.edit'],
            ['nama_permission' => 'InventarisPos.create'],
            ['nama_permission' => 'InventarisPos.edit'],
            ['nama_permission' => 'InventarisPos.delete'],
            ['nama_permission' => 'MBarangInventaris.create'],
            ['nama_permission' => 'MBarangInventaris.delete'],
            ['nama_permission' => 'MBarangInventaris.edit'],
        ]);
    }
}
