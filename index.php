<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>File Upload</title>
  <style>
    /* Reset some default styles */
    body, h2, form {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    /* Center the content */
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #f4f4f9;
    }

    /* Container for the form */
    .container {
      background-color: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      width: 300px;
      text-align: center;
    }

    /* Form title */
    h2 {
      color: #333;
      margin-bottom: 20px;
    }

    /* Style file input */
    input[type="file"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      background-color: #fafafa;
    }

    /* Style the submit button */
    button {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }

    /* Style the response message */
    #response {
      margin-top: 20px;
      padding: 10px;
      font-size: 14px;
      color: #333;
      border-radius: 4px;
      background-color: #f9f9f9;
    }

    /* Success response */
    .success {
      color: green;
    }

    /* Error response */
    .error {
      color: red;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Upload File</h2>
    <form id="uploadForm" enctype="multipart/form-data">
      <input type="file" name="file" id="fileInput" required>
      <button type="submit">Upload</button>
    </form>

    <div id="response"></div>
  </div>

  <script>
    document.getElementById('uploadForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = new FormData();
      formData.append('file', document.getElementById('fileInput').files[0]);

      fetch('upload.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        const responseElement = document.getElementById('response');
        if (data.success) {
          responseElement.innerHTML = `File uploaded successfully!<br>AI Percentage: ${data.ai_percentage}%<br>File Path: ${data.file_path}`;
          responseElement.className = 'success';
        } else {
          responseElement.innerHTML = `Error: ${data.message}`;
          responseElement.className = 'error';
        }
      })
      .catch(error => {
        document.getElementById('response').innerHTML = 'Error uploading file!';
        document.getElementById('response').className = 'error';
      });
    });
  </script>
</body>
</html>
