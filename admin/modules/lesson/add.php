                      <?php 
                    if(!isset($_SESSION['USERID'])){
  redirect(web_root."admin/index.php");
}

                      // $autonum = New Autonumber();
                      // $res = $autonum->single_autonumber(2);

                       ?> 
 <form class="form-horizontal span6" action="controller.php?action=add" method="POST" enctype="multipart/form-data">

           <div class="row">
         <div class="col-lg-12">
            <h1 class="page-header">Upload New Lesson</h1>
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
                            "Title" type="text" value="">
                      </div>
                    </div>
                  </div>

                  <br>

            <div class="form-group">
                    <div class="col-md-11">
                      <label class="col-md-2 control-label" for=
                      "LessonChapter">Grade level:</label>

                      <div class="col-md-10">
                        <input name="deptid" type="hidden" value="">
                         <select class="form-control input-sm" id="LessonChapter" name="LessonChapter">
                            <Option>11</Option>
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
                            <option>Docs</option>
                         </select>
                      </div>
                    </div>
                  </div>
                  

                   <div class="form-group">
                    <div class="col-md-11">
                      <label class="col-md-2" align = "left"for=
                      "file"></label>

                      <div class="col-md-10">
                      <input type="file" name="file"/>
                      </div>
                    </div>
                  </div>
 
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