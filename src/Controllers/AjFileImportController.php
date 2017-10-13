<?php
/**
 * Ajency Laravel CSV Import Package
 */

namespace Ajency\Ajfileimport\Controllers;

use Ajency\Ajfileimport\Helpers\AjCsvFileImport;
use Ajency\Ajfileimport\Helpers\AjImportlibs;
use Ajency\Ajfileimport\Helpers\AjTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; //test
use Log;

class AjFileImportController extends Controller
{

    /**
     * Shows the upload file.
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function showUploadFile()
    {

        return view('ajfileimport::index');

    }

    /**
     * Uploads a file.
     *
     * @param      \Illuminate\Http\Request  $request  The request
     */
    public function uploadFile(Request $request)
    {
        $aj_file_import = new AjCsvFileImport();

        $aj_file_import->init($request);

    }

    /**
     * Gets the error logs.
     */
    public function getErrorLogs()
    {
        $aj_file_import = new AjCsvFileImport();

        $result = $aj_file_import->sendErrorLogFile();
    }

    public function downloadTemptableDataCsv()
    {

        $temp_tablename = config('ajimportdata.temptablename');

        $aj_table = new AjTable($temp_tablename);

        $res = $aj_table->downloadTableDataAsCsv();
        return $res;

    }

    /**
    ##########################################Test Functions############################################
     */

    public function testSchedule()
    {
        $aj_file_import = new AjCsvFileImport();

        $result = $aj_file_import->testSchedule();
    }

    /**
     * { item_description }
     * Type : Test
     */
    public function isDirExists()
    {

        $allfiles = Storage::allFiles('app/Ajency/Ajfileimport/Files/');

        print_r($allfiles);

        $exists = Storage::disk('local')->has('asd');

        $result = Storage::disk('local')->exists('asd');

        echo "<pre> is dir exists";
        print_r($result);
        print_r($exists);

        echo storage_path();

        $import_dir = storage_path('app/Ajency/');
        echo $import_dir;
        $directories = Storage::allDirectories('app');

        print_r($directories);
    }

    public function testTableStructure()
    {
        $table = new AjTable('testuser');
        $table->setTableSchema();
        echo "<pre>";
        print_r($table->getTableSchema());

    }

    public function testConfigTableExists()
    {
        $aj_file_import = new AjCsvFileImport();

        echo "<br/> Checking if tables from configuration file exists in database....";
        $result = $aj_file_import->checkIfAllConfigTablesExists();

        if ($result == true) {
            echo " Passed ";
        } else {
            echo " Failed. <br/> Please correct the table names mentioned in config file.";

            exit();
        }

    }

    public function testSendmail()
    {
        $import_libs = new AjImportlibs();

        $import_libs->sendMail();
    }

}
