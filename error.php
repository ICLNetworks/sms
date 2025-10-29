<?php
session_start();

// get dynamic error details (from session or URL)
$code = $_SESSION['error_code'] ?? ($_GET['code'] ?? '404');
$msg  = $_SESSION['error_msg'] ?? ($_GET['msg'] ?? 'Page Not Found');
$error_message = $_GET['error'] ?? "Unexpected error occurred.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Error - Something went wrong</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f7f9;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      padding: 0 20px;
    }

    .blue-box {
      border: 1px solid #ddd;
      border-radius: 5px;
      background: white;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .blue-box-header {
      background-color: #2f80d0;
      color: white;
      padding: 10px 15px;
      font-weight: bold;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    .blue-box-body {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
      padding: 20px;
      background: #fff;
    }

    .error-info {
      flex: 1 1 380px;
      padding-right: 20px;
    }

    .error-info h1 {
      font-size: 22px;
      color: #333;
      margin-bottom: 10px;
    }

    .error-info p {
      color: #555;
      margin-bottom: 16px;
    }

    .gif-area {
      flex: 1 1 300px;
      text-align: center;
    }

    .gif-area img {
      width: 100%;
      max-width: 300px;
      height: auto;
    }

    .support-form {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .support-form input,
    .support-form textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
    }

    .support-form button {
      border: none;
      background: #2f80d0;
      color: white;
      font-weight: bold;
      padding: 10px;
      border-radius: 5px;
      cursor: pointer;
    }

    .support-form button:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }

    .msg-inline {
      margin-left: 10px;
      font-weight: bold;
      font-size: 14px;
    }

    .success {
      color: #4caf50;
    }

    .error {
      color: #f44336;
    }

    @media (max-width: 768px) {
      .blue-box-body {
        flex-direction: column;
        text-align: center;
      }
      .error-info {
        padding-right: 0;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="blue-box">
      <div class="blue-box-header">
        ⚠️ Error <?php echo htmlspecialchars($code); ?> — <?php echo htmlspecialchars($msg); ?>
        <span id="msgStatus" class="msg-inline"></span>
      </div>

      <div class="blue-box-body">
        <div class="error-info">
          <h1>Oops! Something went wrong.</h1>
          <p><?php echo htmlspecialchars($error_message); ?></p>

          <form id="supportForm" class="support-form">
            <input type="text" id="title" name="title" placeholder="Error Title" required />
            <textarea id="description" name="description" rows="3" placeholder="Describe what happened..." required></textarea>
            <input type="email" id="email" name="email" placeholder="Your Email" required />
            <button type="submit">Contact Support</button>
          </form>
        </div>

        <div class="gif-area">
          <img src="https://i.gifer.com/UFrK.gif" alt="Error mail sending animation" />
        </div>
      </div>
    </div>
  </div>

  <script>
    const form = document.getElementById('supportForm');
    const msg = document.getElementById('msgStatus');

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      msg.textContent = "Sending...";
      msg.className = "msg-inline";

      const formData = new FormData(form);
      form.querySelector('button').disabled = true;

      try {
        const response = await fetch('send_error_mail.php', { method: 'POST', body: formData });
        const result = await response.text();

        if (result.includes("Success")) {
          let seconds = 10;
          msg.innerHTML = `<span class="success">Message sent successfully! Redirecting in <span id="count">${seconds}</span>s...</span>`;
          const countdown = setInterval(() => {
            seconds--;
            document.getElementById('count').textContent = seconds;
            if (seconds <= 0) {
              clearInterval(countdown);
              window.location.href = 'home.php';
            }
          }, 1000);
        } else {
          msg.innerHTML = `<span class="error">Failed to send message!</span>`;
        }
      } catch {
        msg.innerHTML = `<span class="error">Error sending message!</span>`;
      } finally {
        form.querySelector('button').disabled = false;
      }
    });
  </script>
</body>
</html>
