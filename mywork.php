@section('footer_script')
  <script type="text/javascript">
      $(document).ready(function() {
        $('.department_id').select2();//javascrip 
        $('.designation').select2();//javascript
          $('#department_id').change(function() {
              var department_id = $(this).val();
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  type: 'POST',
                  url: '/getdesignationlist',
                  data: {
                      department_id: department_id
                  },
                  success: function(data) {
                      $( "#designation_id" ).html(data);

                  }
              });

          });
      });
  </script>
  
      public function getdesignationlist(Request $request)
    {
      //  echo $request->department_id;
      $stringToSend="";
    $designations =Designation::where('department_id',$request->department_id)->get();
    foreach ($designations as $designation) {
    $stringToSend .="<option value='$designation->id'>$designation->designation_name</option>" ;
    }
    echo $stringToSend;
    }
	
	------------------------
	    <div class="form-group">
                    <label>Designation:</label>
                    <select class="form-control designation" name="designation_id" id="designation_id">
                    </select>
                </div>
	-----------------------
	          <div class="form-group">
                    <label>Department:</label>
                    <select class="form-control department_id" name="department_id" id="department_id">
                        <option value="">-Selecet One-</option>
                        @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                        @endforeach
                    </select>
                </div>
				------