public function up(): void
{
    if (!Schema::hasTable('cashiers')) {
        Schema::create('cashiers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('status', ['AKTIF','NONAKTIF'])->default('AKTIF');
            $table->timestamps();
        });
    }
}

public function down(): void
{
    Schema::dropIfExists('cashiers');
}