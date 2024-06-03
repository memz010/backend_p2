<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */
        $this->call(SchoolSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(LibrarieSeeder::class);
        $this->call(Library_BookSeeder::class);
        $this->call(ExamSeeder::class);
        $this->call(StageSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(CertificateSeeder::class);
        $this->call(SchoolStudentSeeder::class);
        $this->call(StageSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(GuardianSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(AdditionSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(ReportSeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(SubmissionSeeder::class);
        $this->call(MarkSeeder::class);







    }
}
