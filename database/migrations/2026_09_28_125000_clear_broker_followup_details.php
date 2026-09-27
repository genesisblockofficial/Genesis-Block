<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('broker_recommendations')->update([
            'action_note' => null,
            'contact_email' => null,
        ]);
    }

    public function down(): void
    {
        // Follow-up instructions and email addresses are intentionally not restored.
    }
};
