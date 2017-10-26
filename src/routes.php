<?php


Route::get('/ajimportfile', 'AjFileImportController@showUploadFile')->name('showfileupload');

Route::get('/ajviewdataforimport', 'AjFileImportController@downloadTemptableDataCsv')->name('downloadtemptablecsv');

 

/*Test routes */

// test ajax function

Route::post('/startajimport', 'AjFileImportController@uploadFile');

/*Route::post('submit', function () {
    var_dump(Request::all());
});
*/