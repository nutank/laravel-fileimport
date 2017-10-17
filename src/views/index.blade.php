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


      <div id='response_msg_container'></div>

      <script>

        var form = document.querySelector('#aj_frm_uploadfile');
        var request = new XMLHttpRequest();


        form.addEventListener('submit',function(e){
          e.preventDefault();
          var formdata = new FormData(form);






          request.onreadystatechange = function () {
            // Code inside here is executed each time the progress of the HTTP request advances.
            // The current state can be retrieved via `this.readyState`, which returns a value ranging
            // from 0 to 4 (inclusive).

            if (this.readyState == 4) { // If the HTTP request has completed 
              if (this.status == 200) { // If the HTTP response code is 200 (e.g. successful)
                var response = JSON.parse(this.responseText); // Retrieve the response text  
                

                console.log(response);

                var errors = response['errors'];
                var errors_count = errors.length;
                var logs = response['logs'];
                var logs_count = logs.length;
                var msg = response['msg'];

                var i=0;
                var j=0;

                var response_msg_container_message = "";
                if(errors_count>0){
                  for(i=0;i<errors_count;i++)  {
                   response_msg_container_message+= errors[i]
                  }
                }
                

                if(logs_count>0){
                  for(i=0;i<logs_count;i++)  {
                    response_msg_container_message+=logs[i]
                  }
                }

                document.getElementById('response_msg_container').innerHTML = response_msg_container_message;





              };
            };
          };




          request.open('post','startajimport');
          request.send(formdata);

        });
        
      </script>

   </body>
</html
