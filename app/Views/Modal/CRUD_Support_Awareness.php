<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/dist/css/bootstrap-icons.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/dist/css/bootstrap-icons.css">

  <style>
    .custom-file {
      margin-bottom: 10px;
    }

    .file-names-container {
      overflow: hidden;
    }

    .file-name {
      width: 370px;
      border: 1px solid #007bff;
      /* color: #007bff; */
      padding: 8px;
      border-radius: 5px;
      background-color: #fff;
      display: inline-block;
      margin-right: 10px;
      margin-bottom: 10px;
      white-space: nowrap;
    }

    .file-info {
      display: flex;
      align-items: center;
    }

    .filename {
      max-width: '200px';
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      margin-right: 5px;
      color: #495057;
    }

    .file-icon {
      margin-right: 3px;
      color: #007bff;

    }

    .file-icon-bin {
      margin-left: auto;
      color: #007bff;
    }

    .tooltip-inner {
      background-color: #F8F9FA;
      border: 1px solid #CED4DA;
      color: black;
    }
  </style>


  <head>
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- <div class="overlay">
      <i class="fas fa-2x fa-sync fa-spin"></i>
    </div> -->
        <div class="modal-header bg-primary">
          <h4 class="modal-title" id="title_modal" name="title_modal">Awareness</h4>
        </div>
        <div class="modal-body">
          <!-- <div class="progress mb-3" style="display: none;">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0"
          aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
      </div> -->
          <form class="mb-3" id="form_crud" action="javascript:void(0)" method="post" enctype="multipart/form-data">
            <div>
              <h6>Description</h6>
            </div>
            <div>
              <h6 class="gray-text" name="description_detail" id="description_detail">
                รอใส่คำอธิบายเพิ่มเติม
              </h6>
            </div>
            <div>
              <h6 class="gray-text" name="description" id="description"></h6>
            </div>
            <div class="form-group mt-2">
              <h6>Course</h6>
              <input class="form-control gray-text" type="text" placeholder="Text..." name="course" id="course"></input>
            </div>
            <div class="form-group mt-2">
              <h6>Detail</h6>
              <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="detail" id="detail"></textarea>
            </div>
            <div class="form-group mt-2">
              <h6>Date</h6>
              <input class="form-control gray-text" type="date" name="date" id="date"></input>
            </div>
            <div class="form-group">
              <div class="d-flex align-items-center">
                <h6 class="mt-2">Attach Files&nbsp;</h6>
                <i class="far fa-question-circle text-primary" data-toggle="tooltip" title="Attached files include media, list of names, pre-test and post-test scores."></i>
              </div>
              
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="exampleInputFiles" accept=".docx, .pdf, .xlsx, .doc" data-max-size="20971520" name="files[]" multiple>
                <label class="custom-file-label" for="exampleInputFiles">Choose files</label>
              </div>
              <h6 class="gray-text">.doc, .xls, .pdf (20 MB per file)</h6>
              <div id="fileNamesContainer" class="file-names-container"></div>
            </div>
            <input type="text" id="url_route" name="url_route" hidden>
            <input type="text" id="check_type" name="check_type" hidden>
            <input type="text" id="id_" name="id_" hidden>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" name="submit" value="Submit">Save</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
            </div>
          </form>
        </div>
      </div>
    </div>



    <script>
      $(document).ready(function() {
        $(".overlay").hide();
      });

      $("#form_crud").on('submit', function(e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_crud');
      });
    </script>
    <script>
      $(document).ready(function() {
        $(".overlay").hide();
      });

      $("#form_crud").on('submit', function(e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_crud');
      });

    </script>
    <script>
      document.getElementById('exampleInputFiles').addEventListener('change', function() {
        const fileInput = this;
        const fileNamesContainer = document.getElementById('fileNamesContainer');
        const files = fileInput.files;

        // Clear previous content
        fileNamesContainer.innerHTML = '';

        if (files.length > 0) {
          for (let i = 0; i < files.length; i++) {
            const fileNameContainer = document.createElement('div');
            fileNameContainer.classList.add('file-name');

            const fileIcon = document.createElement('span');
            fileIcon.innerHTML = '<i class="far fa-file-alt"></i>';
            fileIcon.classList.add('file-icon');

            const fileInfo = document.createElement('span');
            fileInfo.classList.add('file-info');
            fileInfo.style.fontSize = '10pt';

            const fileName = document.createElement('span');
            fileName.textContent = files[i].name;
            fileName.className = 'filename';

            const fileSize = document.createElement('span');
            fileSize.classList.add('file-icon');
            fileSize.textContent = `(${formatFileSize(files[i].size)})`;
            fileSize.style.color = '#495057'

            const fileIcons = document.createElement('span');
            fileIcons.innerHTML = '<i class="fas fa-trash-alt"></i>';
            fileIcons.classList.add('file-icon-bin');
            fileIcons.addEventListener('click', function() {
              deleteFile(files[i]);
            });

            fileInfo.appendChild(fileIcon);
            fileInfo.appendChild(fileName);
            fileInfo.appendChild(fileSize);
            fileInfo.appendChild(fileIcons);
            console.log('File Name:', files[i].name, 'Size:', files[i].size);

            fileNameContainer.appendChild(fileInfo);
            fileNamesContainer.appendChild(fileNameContainer);
          }
        }
      });

      function formatFileSize(size) {
        const kb = size / 1024;
        if (kb < 1024) {
          return kb.toFixed(2) + ' KB';
        } else {
          const mb = kb / 1024;
          return mb.toFixed(2) + ' MB';
        }
      }

      function deleteFile(file) {
        console.log('Delete file:', file.name);
      }
    </script>
    <script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
  });
</script>