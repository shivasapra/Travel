<?php
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('to_id');
            $table->boolean('admin');
            $table->text('message');
            $table->time('time');
            $table->date('date');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
    public function run()
    {
        $chat = App\Chat::create([
            'admin' => Auth::user()->admin,
            'time' => Carbon::now()->timezone('Europe/London')->toTimeString(),
            'date' => Carbon::now()->timezone('Europe/London')->toDateString()
        ]);
    }

}
