<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        /**
         * Run the migrations.
         */

        public function up(): void
        {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('username')->unique();
                $table->string('password');
                $table->string('email')->unique();
                $table->string('name');
                // samo izvršioci mogu sami da se registruju, tako je tip korisnika automatski 3
                $table->unsignedBigInteger('user_type_id')->default(3);
                // pri registraciji korisnik automatski nije verifikovan
                $table->timestamp('email_verified_at')->nullable();
                $table->string('phone')->nullable();
                $table->date('birthday')->nullable();
                $table->string('verify_token')->nullable()->default(null);
                $table->timestamps();

                // povezivanje tabela
                $table->foreign('user_type_id')
                    ->references('id')
                    ->on('user_types')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('users');
        }
    };
