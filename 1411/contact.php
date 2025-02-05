<?php include 'includes/header.php'; ?>

<main>
    <h1>Contact Me</h1>
    <p>If you'd like to get in touch, please fill out the form below:</p>

    <form id="contact-form" action="contact-submit.php" method="POST">
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>
        <br><br>
        <label for="message">Your Message:</label>
        <textarea id="message" name="message" required></textarea>
        <br><br>
        <button type="submit">Send Message</button>
    </form>
</main>

<?php include 'includes/footer.php'; ?>

<script src="js/script2.js"></script>
