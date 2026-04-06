<?php
session_start();
include "includes/validation.php";
include "includes/db_connect.php";

if (isset($_GET["end_session"]) && $_GET["end_session"] === "1") {
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();
    header("Location: contact.php");
    exit;
}

if (!isset($_SESSION["visit_count"])) {
    $_SESSION["visit_count"] = 1;
} else {
    $_SESSION["visit_count"]++;
}

$cookie_name_display = '';
$session_reason_display = '';

$values = [
    "name" => '',
    "age" => '',
    "email" => '',
    "reason" => '',
    "message" => ''
];

$errors = [
    "name" => '',
    "age" => '',
    "email" => '',
    "reason" => '',
    "message" => ''
];

$status_message = '';

$allowed_reasons = ["question", "consultation", "booking"];

if (isset($_COOKIE["visitor_name"]) && validate_text($_COOKIE["visitor_name"], 1, 50)) {
    $cookie_name_display = htmlspecialchars($_COOKIE["visitor_name"]);
}

if (isset($_SESSION["last_reason"]) && validate_option($_SESSION["last_reason"], $allowed_reasons)) {
    $session_reason_display = htmlspecialchars($_SESSION["last_reason"]);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $values["name"] = trim($_POST["name"] ?? '');
    $values["age"] = trim($_POST["age"] ?? '');
    $values["email"] = trim($_POST["email"] ?? '');
    $values["reason"] = $_POST["reason"] ?? '';
    $values["message"] = trim($_POST["message"] ?? '');

    if (!validate_text($values["name"], 2, 50)) {
        $errors["name"] = "Name must be between 2 and 50 characters.";
    }

    if (!validate_number($values["age"], 1, 120)) {
        $errors["age"] = "Age must be a number between 1 and 120.";
    }

    if (!validate_email_address($values["email"])) {
        $errors["email"] = "Please enter a valid email address.";
    }

    if (!validate_option($values["reason"], $allowed_reasons)) {
        $errors["reason"] = "Please choose a valid reason for reaching out.";
    }

    if (!validate_text($values["message"], 10, 500)) {
        $errors["message"] = "Message must be between 10 and 500 characters.";
    }

    if (implode('', $errors) === '') {
        try {
            $select_visitor = $pdo->prepare("SELECT visitor_id FROM visitors WHERE email = ?");
            $select_visitor->execute([$values["email"]]);
            $existing_visitor = $select_visitor->fetch();

            if ($existing_visitor) {
                $visitor_id = $existing_visitor["visitor_id"];

                $update_visitor = $pdo->prepare("
                    UPDATE visitors
                    SET name = ?, age = ?
                    WHERE visitor_id = ?
                ");
                $update_visitor->execute([
                    $values["name"],
                    (int)$values["age"],
                    $visitor_id
                ]);
            } else {
                $insert_visitor = $pdo->prepare("
                    INSERT INTO visitors (name, age, email)
                    VALUES (?, ?, ?)
                ");
                $insert_visitor->execute([
                    $values["name"],
                    (int)$values["age"],
                    $values["email"]
                ]);

                $visitor_id = $pdo->lastInsertId();
            }

            $insert_submission = $pdo->prepare("
                INSERT INTO contact_submissions (visitor_id, reason, message)
                VALUES (?, ?, ?)
            ");
            $insert_submission->execute([
                $visitor_id,
                $values["reason"],
                $values["message"]
            ]);

            $status_message = "Form submitted successfully!";

            setcookie("visitor_name", $values["name"], time() + (86400 * 7), "/");
            $_SESSION["last_reason"] = $values["reason"];
            $_SESSION["last_name"] = $values["name"];

            $cookie_name_display = htmlspecialchars($values["name"]);
            $session_reason_display = htmlspecialchars($values["reason"]);

            $values = [
                "name" => '',
                "age" => '',
                "email" => '',
                "reason" => '',
                "message" => ''
            ];
        } catch (PDOException $e) {
            $status_message = "A database error occurred. Please try again later.";
        }
    } else {
        $status_message = "Please correct the errors below and resubmit the form.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katherine Sullivan LCSW - Contact Form</title>
    <link rel="stylesheet" href="css/contact.css">
</head>
<body>

    <?php include "partials/nav.php"; ?>

    <div class="contactBox">
        <h1 class="contactText">Ready to talk?</h1>

        <div class="contactButtonWrap">
            <button id="toEmailForm" class="contactButtons" type="button">I have a question</button>
            <button id="toCalendlyBooker" class="contactButtons" type="button">I want to book a session</button>
        </div>
    </div>

    <hr />

    <section class="contact" aria-labelledby="visitorInfoTitle">
        <h2 id="visitorInfoTitle" class="emailFormHeader">Visitor Info</h2>

        <?php if ($cookie_name_display !== ''): ?>
            <p>Welcome back, <?= $cookie_name_display; ?>!</p>
        <?php else: ?>
            <p>No visitor name cookie has been stored yet.</p>
        <?php endif; ?>

        <p>You have visited this page <?= htmlspecialchars((string)$_SESSION["visit_count"]); ?> times during this session.</p>

        <?php if ($session_reason_display !== ''): ?>
            <p>Your last selected reason was: <?= $session_reason_display; ?></p>
        <?php else: ?>
            <p>No session form preference has been stored yet.</p>
        <?php endif; ?>

        <p><a href="contact.php?end_session=1">End current session</a></p>
    </section>

    <hr />

    <section id="bookingSection">
        <div class="bookSessionWrapper" id="bookSessionSection">
            <h2 class="bookSessionHeader">Book a session with Katherine!</h2>
            <div class="calendly-inline-widget" data-url="https://calendly.com/patrick-sullivan-uri/30min"></div>
        </div>
    </section>

    <hr />

    <section id="contactSection" class="contact" aria-labelledby="contactTitle">
        <h2 id="contactTitle" class="emailFormHeader">Send Katherine an email!</h2>

        <?php if ($status_message !== ''): ?>
            <div class="<?= implode('', $errors) === '' ? 'successBox' : 'errorBox'; ?>">
                <p><?= htmlspecialchars($status_message); ?></p>
            </div>
        <?php endif; ?>

        <form class="contactForm" method="POST" action="">
            <label class="field">
                <span>Name</span>
                <input type="text" name="name" value="<?= htmlspecialchars($values["name"]); ?>" required>
                <?php if ($errors["name"] !== ''): ?>
                    <p class="fieldError"><?= htmlspecialchars($errors["name"]); ?></p>
                <?php endif; ?>
            </label>

            <label class="field">
                <span>Age</span>
                <input type="number" name="age" min="1" max="120" value="<?= htmlspecialchars($values["age"]); ?>" required>
                <?php if ($errors["age"] !== ''): ?>
                    <p class="fieldError"><?= htmlspecialchars($errors["age"]); ?></p>
                <?php endif; ?>
            </label>

            <label class="field">
                <span>Email</span>
                <input type="email" name="email" value="<?= htmlspecialchars($values["email"]); ?>" required>
                <?php if ($errors["email"] !== ''): ?>
                    <p class="fieldError"><?= htmlspecialchars($errors["email"]); ?></p>
                <?php endif; ?>
            </label>

            <label class="field">
                <span>Reason for reaching out</span>
                <select name="reason" required>
                    <option value="">Select one</option>
                    <option value="question" <?= $values["reason"] === "question" ? "selected" : ""; ?>>General Question</option>
                    <option value="consultation" <?= $values["reason"] === "consultation" ? "selected" : ""; ?>>Consultation</option>
                    <option value="booking" <?= $values["reason"] === "booking" ? "selected" : ""; ?>>Booking</option>
                </select>
                <?php if ($errors["reason"] !== ''): ?>
                    <p class="fieldError"><?= htmlspecialchars($errors["reason"]); ?></p>
                <?php endif; ?>
            </label>

            <label class="field">
                <span>Message</span>
                <textarea name="message" rows="5" required><?= htmlspecialchars($values["message"]); ?></textarea>
                <?php if ($errors["message"] !== ''): ?>
                    <p class="fieldError"><?= htmlspecialchars($errors["message"]); ?></p>
                <?php endif; ?>
            </label>

            <button type="submit" class="buttonPrimary">Submit</button>
        </form>
    </section>

    <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
    <script src="js/contact_page_logic.js"></script>
</body>
</html>