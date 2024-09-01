from deepface import DeepFace
import os
from PIL import Image
from io import BytesIO
from flask import Flask, request, redirect, jsonify, render_template_string
from werkzeug.utils import secure_filename
import base64
from flask_cors import CORS
import numpy as np
import requests

IMAGES_FOLDER = "images"
UPLOAD_FOLDER = "uploads"
ALLOWED_EXTENSIONS = {"txt", "pdf", "png", "jpg", "jpeg", "gif"}
MAX_FILES = 6

app = Flask(__name__)
app.config["UPLOAD_FOLDER"] = UPLOAD_FOLDER
CORS(app, withCredentials=True)


def allowed_file(filename):
    return "." in filename and filename.rsplit(".", 1)[1].lower() in ALLOWED_EXTENSIONS


@app.route("/test", methods=["GET", "POST"])
def upload_file2():
    data = ""
    if request.method == "POST":
        print(request.form)
        data = ""
    else:
        with open("camera.html", "r") as file:
            data = file.read()
    return data


@app.route("/", methods=["GET", "POST"])
def upload_file():
    if request.method == "POST":
        base64_data = request.form["image"]
        if base64_data.startswith("data:image"):
            img = Image.open(
                BytesIO(base64.b64decode(bytes(base64_data.split(",")[1], "utf-8")))
            )
            img.save("uploads/output_image.png", quality=100, subsampling=0)
        try:
            dfs = DeepFace.find(
                img_path="uploads/output_image.png",
                db_path="images/",
                model_name="Facenet512",
            )
            if dfs:
                result_path = str(dfs[0].identity[0])
                relative_path = os.path.relpath(result_path, IMAGES_FOLDER)
                folder_name = os.path.dirname(relative_path).split(os.path.sep)[-1]
                return jsonify({"status": "success", "name": folder_name})
            else:
                return jsonify({"status": "error", "message": "No matches found"})
        except Exception as e:
            return jsonify({"status": "error", "message": str(e)})
    return """
    <!doctype html>
    <title>Upload new File</title>
    <h1>Upload new File</h1>
    <form method=post enctype=multipart/form-data>
      <input type=file name=file>
      <input type=submit value=Upload>
    </form>
    """


if __name__ == "__main__":
    app.run(debug=True)


@app.route("/upload", methods=["GET", "POST"])
def upload_file3():
    html_form = """
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload Files with Folder Name</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ url_for('static', filename='css/style.css') }}" rel="stylesheet">
    </head>
    <body>
        
        <div class="container">
            <a href="http://localhost:8000/datakaryawan"><button type="button" class="btn btn-light me-2 d-inline"><i
                        class="bi bi-arrow-left h-4"></i></button></a>
            <h1 class="text-center">Upload Files with Folder Name</h1>
            <form method="post" enctype="multipart/form-data" id="uploadForm">
                <div class="form-group">
                    <label for="folder_name">Folder Name:</label>
                    <input type="text" name="folder_name" id="folder_name" class="form-control" readonly required>
                </div>
                <div class="form-group">
                    <label for="files">Select Files:</label>
                    <input type="file" name="files" class="form-control-file" multiple>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Upload</button>
            </form>
            <div id="alertSuccess" class="alert alert-success" role="alert" style="display:none;">
                Files uploaded successfully! Redirecting...
            </div>
            <div class="loading" id="loading">Loading&#8230;</div>
            {% if results %}
            <div class="results">
                <h2>Results:</h2>
                <ul class="list-group">
                    {% for result in results %}
                        <li class="list-group-item">{{ result }}</li>
                    {% endfor %}
                </ul>
            </div>
            {% endif %}
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            document.getElementById('uploadForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent form submission
                var loadingElement = document.getElementById('loading');
                loadingElement.style.display = 'block'; // Show loading indicator
                var formData = new FormData(this);
                fetch('/upload', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(html => {
                    document.documentElement.innerHTML = html;
                    var alertSuccess = document.getElementById('alertSuccess');
                    if (alertSuccess) {
                        alertSuccess.style.display = 'block';
                        setTimeout(() => {
                            window.location.href = "http://localhost:8000/datakaryawan";
                        }, 2000);
                    }
                })
                .catch(error => console.error('Error:', error))
                .finally(() => {
                    loadingElement.style.display = 'none'; // Hide loading indicator
                });
            });
            
            
            $(document).ready(function() {
                // Show loading spinner on form submit
                $('#uploadForm').on('submit', function() {
                    $('#loading').show();
                });

                // Get the fullName parameter from the URL
                const urlParams = new URLSearchParams(window.location.search);
                const fullName = urlParams.get('fullName');
                if (fullName) {
                    $('#folder_name').val(fullName);
                }
            });
        </script>
    </body>
    </html>
    """
    if request.method == "POST":
        if "files" not in request.files:
            return "No file part", 400

        folder_name = request.form["folder_name"]
        if not folder_name:
            return "Folder name is required", 400

        files = request.files.getlist("files")
        if len(files) > MAX_FILES:
            return f"Only a maximum of {MAX_FILES} files can be uploaded.", 400

        new_folder_path = os.path.join(IMAGES_FOLDER, folder_name)
        os.makedirs(new_folder_path, exist_ok=True)

        results = []
        for file in files:
            if file and allowed_file(file.filename):
                filename = secure_filename(file.filename)
                saved_image_path = os.path.join(new_folder_path, filename)
                file.save(saved_image_path)

                try:
                    dfs = DeepFace.find(
                        img_path=saved_image_path,
                        db_path=IMAGES_FOLDER,
                        model_name="Facenet512",
                    )
                    if dfs:
                        result = str(dfs[0].identity[0]).partition("s/")[2]
                    else:
                        result = "No matches found"
                    results.append(f"{filename}: {result}")
                except Exception as e:
                    results.append(f"{filename}: Data not found ({str(e)})")

        return render_template_string(html_form, results=results)

    return render_template_string(html_form, results=None)

if __name__ == "__main__":
    app.run(debug=True)