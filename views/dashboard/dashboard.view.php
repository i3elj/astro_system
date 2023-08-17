<!DOCTYPE html>
<html>

<?= create_head_tag(
    title: "Astro System - Dashboard",
    styles: ["views/dashboard/dashboard.style.css"]
) ?>

<body>
    <?php if ($auth_token) : ?>
        <h1>Hey, you're logged in! Neat</h1>
        <button onclick="logout()">Log out</button>
    <?php else : ?>
        <h1>Sorry, You're not allowed to be here :(</h1>
    <?php endif; ?>

</body>

<script type="module" src="views/dashboard/dashboard.js"></script>

</html>
