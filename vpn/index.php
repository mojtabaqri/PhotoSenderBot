<!DOCTYPE html>
<html>
<head>
  <title>Copy to Clipboard</title>
  <style>
    body {
      background-color: #fff;
      color: #000;
      font-family: Arial, sans-serif;
      text-align: center;
    }
    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
    }
    .text-input {
      width: 100%;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .copy-button {
      padding: 10px 20px;
      background-color: #dc3545;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
    }
    .text-input-label {
      font-weight: bold;
      color: #000;
      text-align: left;
    }
    .text-input-container {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <?php
      // بارگیری فایل JSON
      $jsonString = file_get_contents('v.json');
      $data = json_decode($jsonString, true);
      // بررسی وجود داده‌ها
      if ($data) {
        // تکمیل مقادیر تکست باکس و ایجاد دکمه‌ها
        foreach ($data as $key => $value) {
          echo '<div class="text-input-container">';
          echo '<label for="text-input' . $key . '" class="text-input-label">' . $value['server'] . ':</label>';
          echo '<input type="text" id="text-input' . $key . '" class="text-input" placeholder="متن را وارد کنید" value="' . $value['link'] . '">';
          echo '<button id="copy-button' . $key . '" class="copy-button" onclick="copyToClipboard(\'text-input' . $key . '\')">کپی به کلیپبورد</button>';
          echo '</div>';
        }
      }
    ?>

  </div>

  <script>
    function copyToClipboard(inputId) {
      var textInput = document.getElementById(inputId);
      textInput.select();
      textInput.setSelectionRange(0, 99999);
      document.execCommand("copy");
      alert("متن با موفقیت کپی شد: " + textInput.value);
    }
  </script>
</body>
</html>