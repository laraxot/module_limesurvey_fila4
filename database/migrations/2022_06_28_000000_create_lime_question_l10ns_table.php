<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class extends XotBaseMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table): void {
                $table->increments('id');
                $table->integer('qid');
                $table->string('question');
                $table->string('help')->nullable();
                $table->string('script')->nullable();
                $table->string('language');
            }
        );

        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                /* if (! $this->hasColumn('f1irst_name')) {
                       $table->string('f1irst_name')->nullable();
                   }*/
            }
        );
    }
};
