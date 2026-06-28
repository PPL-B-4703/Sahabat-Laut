// database/migrations/xxxx_xx_xx_create_biotas_table.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('biotas', function (Blueprint $table) {

            $table->id();

            $table->string('nama_biota');
            $table->string('nama_ilmiah')->nullable();

            $table->string('kategori')->nullable();
            $table->string('habitat')->nullable();

            $table->string('status_konservasi')->nullable();

            $table->longText('deskripsi')->nullable();

            // format: fakta1|fakta2|fakta3
            $table->text('fakta_menarik')->nullable();

            // format: Raja Ampat,-0.23,130.50|Bunaken,1.62,124.76
            $table->longText('lokasi')->nullable();

            $table->longText('gambar_url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('biotas');
    }
};