<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
  
    public function up(): void
    {
        if(!Schema::hasTable('attachements')){
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->morphs('attachable'); // attachable_id + attachable_type
            $table->string('mime_type');
            $table->string('original_filename');
            $table->string('s3_filename');
            $table->enum('file_type',['invoice','products','other']);
            $table->unsignedBigInteger('added_by')->nullable();
            $table->timestamps();
        });
        return ;
        }
        $this->AddEnumValues('attachement','file_type',['invoice','products','other']);
    }
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }

    private function AddEnumValues(string $table,string $column, array $newValues):void{

        $result = DB::select("
            SELECT COLUMN_TYPE
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME = ?
              AND COLUMN_NAME = ?
        ", [$table, $column]);

        if (empty($result)) {
            return;
        }
        preg_match("/^enum\((.*)\)$/", $result[0]->COLUMN_TYPE, $matches);

        $existingValues = collect(str_getcsv($matches[1], ',', "'"))
                            ->map(fn($v) => trim($v)) //etra space remove
                            ->toArray();

        $merged = array_unique(array_merge($existingValues, $newValues));

        $enumList = "'" . implode("','", $merged) . "'";

        DB::statement("ALTER TABLE `$table` MODIFY `$column` ENUM($enumList)");

    }
};
