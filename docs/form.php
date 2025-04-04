<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $subjectInput = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $messageInput = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($subjectInput)) {
        $errors[] = "Subject is required.";
    }

    if (empty($messageInput)) {
        $errors[] = "Message is required.";
    }

    if (empty($errors)) {
        $to = "caesarazar@gmail.com";
        $subject = "New Message: $subjectInput";

        $body = "You've received a message from your website contact form:\n\n";
        $body .= "Name: $name\n";
        $body .= "Subject: $subjectInput\n\n";
        $body .= "Message:\n$messageInput\n";

        $headers = "From: no-reply@yourdomain.com\r\n";
        $headers .= "Reply-To: no-reply@yourdomain.com\r\n";

        if (mail($to, $subject, $body, $headers)) {
            echo "<p style='color:green;'>Message sent successfully!</p>";
        } else {
            echo "<p style='color:red;'>Failed to send message. Please try again later.</p>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Caesar</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <nav>
		<ul>
			<li><a href="index.html">Home</a></li>
			<li><a href="about.html">About</a></li>
			<li><a href="projects.html">Projects</a></li>
			<li><a href="work.html">Work</a></li>
			<li><a href="contact.html">Contact</a></li>
			<li><a target="_blank" rel="noopener noreferrer" href="img/redacted-resume-caesar-azar.pdf">Resume</a></li>
		</ul>
        <div class="social-icons">
            <a href="https://www.linkedin.com" target="_blank"><img src="img/linkedin-logo.png" alt="LinkedIn"></a>
            <a href="https://github.com" target="_blank"><img src="img/github-mark-logo.png" alt="GitHub"></a>
        </div>
    </nav>
	
	<main style="margin-top: 70px; padding: 20px;">
        
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($success)): ?>
            <div class="success">
                <p><?php echo htmlspecialchars($success); ?></p>
            </div>
        <?php endif; ?>
        
        <div class="contact-container">
            <div class="contact-info">
                <h2>Direct Contact</h2>

                <table class="contact-table">
                    <tr>
                        <th>Email</th>
                        <td><a href="mailto:caesarazar@gmail.com">caesarazar@gmail.com</a></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><a href="tel:+1234567890">+1 (234) 567-890</a></td>
                    </tr>
                </table>
            </div>
            
            <div class="contact-form">
                <h2>Send a Message</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="name">Name *</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($name ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <input type="text" id="subject" name="subject" class="form-control" value="<?php echo htmlspecialchars($subject ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="body">Message *</label>
                        <textarea id="body" name="body" class="form-control" required><?php echo htmlspecialchars($body ?? ''); ?></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Send Message</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
	
