<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSendEmailToEventInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_invitations', function (Blueprint $table) {
            $table->boolean('send_email')
                ->default(true)
                ->after('allowed_guests')
                ->comment('Determines if the invitation email should be sent');        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_invitations', function (Blueprint $table) {
            $table->dropColumn("send_email");
        });
    }
}
