<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Sheet;
use Revolution\Google\Sheets\Facades\Sheets;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class SheetCronjob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sheet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load data from google sheet';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $value = Sheets::spreadsheet('1jgYSL7jophAqS_TJltFHQEMn8-B66ejiJ8q1QOtPAxI')->sheet('Demo')->all();
        // dd($value);
        unset($value[0]);
        $value = array_values($value);
        // dd($value);
        foreach($value as $key => $sheet) {
            // dd($sheet);
            if (!empty($sheet)) {

                if($this->find($sheet[1], $sheet[3]) != null){
                    $this->updateSheet($sheet[1], $sheet[3], $sheet[2]);
                } else {
                    $result = new Sheet();
                    $result->email = $sheet[1];
                    $result->code = $sheet[3];
                    $result->score = $sheet[2];
                    $result->save();
                }
            }
        }
    }

    public function find($email, $code)
    {
        $result = DB::table('sheet')->where('email', $email)->Where('code', $code)->first();
        return $result;
    }

    public function updateSheet($email, $code, $score)
    {
        DB::table('sheet')->where('email', $email)->Where('code', $code)->update(['score' => $score]);
    }
}
