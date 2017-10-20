<html>
   <body>


      <form action="/startajimport" method="post" enctype="multipart/form-data" id="aj_frm_uploadfile">
          {{ csrf_field() }}

          <br />
          Please Select file to import data
          <br />
          <input type="file" name="ajfile" />
          <br /><br />
          <input type="submit" value="Upload" id="btn_ajupload" />
      </form>

      <div id='response_msg_container1'></div>
      <div id='response_msg_container'></div>

      <script>
        var loader_gif =   "{{asset('ajimport_assets/images/loader.gif')}}";
      </script>
      <script type="text/javascript" src="{{asset('ajimport_assets/js/ajimport.js')}}">
      </script>



   </body>
</html
