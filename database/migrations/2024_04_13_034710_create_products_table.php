    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->integer('price');
                $table->string('description');
                $table->text('image');
                $table->text('imagep1')->nullable();
                $table->text('imagep2')->nullable();
                $table->text('imagep3')->nullable();
                $table->text('imagep4')->nullable();
                $table->string('sizepd')->nullable();
                $table->string('colorpd')->nullable();
                $table->string('materialpd')->nullable();
                $table->string('warrantypd')->nullable();
                $table->string('advantage')->nullable();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('products');
        }
    };
