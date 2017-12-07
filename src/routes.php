<?php


Route::get('/aj/importfile', 'AjFileImportController@showUploadFile')->name('showfileupload');

Route::get('/aj/viewdataforimport', 'AjFileImportController@downloadTemptableDataCsv')->name('downloadtemptablecsv');



/*Test routes */

// test ajax function
Route::get('/testschedule', 'AjFileImportController@testSchedule');

Route::post('/aj/startajimport', 'AjFileImportController@uploadFile');

/*Route::post('submit', function () {
    var_dump(Request::all());
});
*/