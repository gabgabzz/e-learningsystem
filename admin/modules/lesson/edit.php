<?php  
    if(!isset($_SESSION['USERID'])){
  redirect(web_root."admin/index.php");
}

  @$id = $_GET['id'];
    if($id==''){
  redirect("index.php");
}
  $lesson = New Lesson();
  $res = $lesson->single_lesson($id);

?> 
 
 <form class="form-horizontal span6" action="controller.php?action=edit" method="POST" enctype="multipart/form-data">

           <div class="row">
         <div class="col-lg-12">
            <h1 class="page-header">Update Lesson</h1>
          </div>
          <!-- /.col-lg-12 -->
       </div> 


                   <div class="form-group">
                    <div class="col-md-11">
                      <label class="col-md-2 control-label" for=
                      "LessonTitle">Title:</label>

                      <div class="col-md-10">
                        <input name="deptid" type="hidden" value="">
                         <input class="form-control input-sm" id="LessonTitle" name="LessonTitle" placeholder=
                            "Title" type="text" value="<?php echo $res->LessonTitle; ?>">
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <div class="col-md-11">
                      <label class="col-md-2 control-label" for=
                      "LessonChapter">Grade level:</label>

                      <div class="col-md-10">
                        <input name="LessonID" type="hidden" value="<?php echo $res->LessonID; ?>">
                         <select class="form-control input-sm" id="LessonChapter" name="LessonChapter">
                          <option>11</option>
                          <option>12</option>
                         </select>
                      </div>
                    </div>
                  </div>
                  <br>


                  <div class="form-group">
                    <div class="col-md-11">
                      <label class="col-md-2 control-label" for=
                      "strand">Strand:</label>

                      <div class="col-md-10">
                        <input name="deptid" type="hidden" value="">
                         <select class="form-control input-sm" id="strand" name="strand">
                            <Option>ICT</Option>
                            <option>ABM</option>
                            <option>STEM</option>
                         </select>
                      </div>
                    </div>
                  </div>
                  <br>                      
                  


                  <div class="form-group">
                    <div class="col-md-11">
                      <label class="col-md-2 control-label" for=
                      "Category">Select File Type:</label>

                      <div class="col-md-10">
                        <input name="deptid" type="hidden" value="">
                         <select class="form-control input-sm" id="Category" name="Category" >
                            <option <?php echo ($res->Category == "Docs") ? "Selected" : ""?>>Docs</option>
                         </select>
                      </div>
                    </div>
                  </div>

      <!--              <div class="form-group">
                    <div class="col-md-11">
                      <label class="col-md-2" align = "right"for=
                      "file">Upload File:</label>

                      <div class="col-md-10">
                      <input type="file" name="file" value="<?php echo $res->FileLocation; ?>" />
                      </div>
                    </div>
                  </div> -->
 
             <div class="form-group">
                    <div class="col-md-11">
                      <label class="col-md-2 control-label" for=
                      "idno"></label>

                      <div class="col-md-10">
                       <button class="btn btn-primary btn-sm" name="save" type="submit" ><span class="fa fa-save fw-fa"></span>  Save</button> 
                         </div>
                    </div>
                  </div> 
        </form> 