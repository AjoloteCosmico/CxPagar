<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            if (!Schema::hasColumn('payments', 'forma_pago')) {
                $table->string('forma_pago')->nullable()->after('id');
            }
            if (!Schema::hasColumn('payments', 'no_cuenta')) {
                $table->string('no_cuenta')->nullable()->after('forma_pago');
            }
            if (!Schema::hasColumn('payments', 'hora_recibido')) {
                $table->time('hora_recibido')->nullable()->after('no_cuenta');
            }
            if (!Schema::hasColumn('payments', 'condiciones')) {
                $table->text('condiciones')->nullable()->after('hora_recibido');
            }
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            if (Schema::hasColumn('payments', 'condiciones')) {
                $table->dropColumn('condiciones');
            }
            if (Schema::hasColumn('payments', 'hora_recibido')) {
                $table->dropColumn('hora_recibido');
            }
            if (Schema::hasColumn('payments', 'no_cuenta')) {
                $table->dropColumn('no_cuenta');
            }
            if (Schema::hasColumn('payments', 'forma_pago')) {
                $table->dropColumn('forma_pago');
            }
        });
    }
};
