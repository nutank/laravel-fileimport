<?php /**
 * Ajency Laravel CSV Import Package Additional Library
 */
namespace Ajency\Ajfileimport\Helpers;

use Ajency\Ajfileimport\Mail\AjSendMail;
use Illuminate\Support\Facades\File;
use \Mail;

/**
 * Class for aj importlibs.
 */
class AjImportlibs
{

    public function custom_mysql_real_escape($inp)
    {

        if (is_array($inp)) {
            return array_map(__METHOD__, $inp);
        }

        if (!empty($inp) && is_string($inp)) {
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
        }

        return $inp;

    }

    public function createDirectoryIfDontExists($filepath)
    {

        if (!$this->is_directory_exists($filepath)) {
            File::makeDirectory($filepath, 0775, true, true);
        }

    }

    public function is_directory_exists($filepath)
    {
        if (File::exists($filepath)) {
            if (File::isDirectory($filepath)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    /**
     * { function_description }
     *
     * @param      string  $prefix  The prefix
     * @param      string  $folder  The folder
     *
     * @return     string  ( description_of_the_return_value )
     */
    public function generateUniqueOutfileName($prefix, $folder)
    {

        $rand_string = $this->getRandomString(4);
        $file_path   = $folder . $prefix . "_" . $rand_string . "_" . date('d_m_Y_H_i_s') . ".csv";
        if (file_exists($file_path)) {
            $this->generateUniqueOutfileName($prefix, $folder);
        } else {
            return $file_path;
        }

    }

    /**
     * function to generate random strings
     * @param       int     $length     number of characters in the generated string
     * @return      string  a new string is created with random characters of the desired length
     */
    public function getRandomString($length = 4)
    {
        $randstr = "";
        // srand((double) microtime(TRUE) * 1000000);
        //our array add all letters and numbers if you wish
        $chars = array(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'p',
            'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '1', '2', '3', '4', '5',
            '6', '7', '8', '9');

        for ($rand = 0; $rand <= $length; $rand++) {
            $random = rand(0, count($chars) - 1);
            $randstr .= $chars[$random];
        }
        return $randstr;
    }

    /**
     * { function_description }
     *
     * @param      <type>  $logs    The logs
     * @param      array   $params  The parameters
     * ex : array('is_success'=>true,'pre_message'=>'here is list of ...','post_message'=>'logs ends here ')
     */
    public function printLogs($logs, $params = array())
    {

        $total_logs = count($logs);

        if (isset($params['pre_message'])) {
            echo $params['pre_message'];
        }

        for ($cnt = 0; $cnt < $total_logs; $cnt++) {
            echo "<br/>" . ($cnt + 1) . ".  " . $logs[$cnt];
        }

        if (isset($params['post_message'])) {
            echo $params['post_message'];
        }

    }

    public function sendMail($params)
    {

        Mail::to($params['recipient'])->send(new AjSendMail($params));

        //
        /*Mail::raw('sendDailyProjectMailsToProfile-'.env('APP_ENV'), function ($message) {

    $message->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
    $message->to('paragredkar@ajency.in','paragredkar')->subject('daily project mail');
    });*/

    }

}
