<?php
include "views/fixed/head.php";
if (!isset($_GET["page"]) || stripos($_GET["page"], "admin") == "") {
    include "views/fixed/nav.php";
    include "views/fixed/cart.php";
}

if (!isset($_GET["page"])) {
    include "views/fixed/showcase.php";
    include "views/pages/events/events.php";
} else {
    switch ($_GET["page"]) {
        case "login":
            include "views/pages/login.php";
            break;
        case "register":
            include "views/pages/register.php";
            break;
        case "events":
            include "views/fixed/showcase.php";
            include "views/pages/events/events.php";
            break;
        case "eventDetails":
            include "views/pages/events/eventDetails.php";
            break;
        case "profile":
            include "views/fixed/showcase.php";
            include "views/pages/profile.php";
            break;
        case "author":
            include "views/pages/author.php";
            break;
        case "admin":
            include "views/fixed/admin/sidebar.php";
            include "views/pages/admin/admin.php";
            break;
        case "admin-insert":
            include "views/fixed/admin/sidebar.php";
            include "views/pages/admin/admin-insert.php";
            break;
        case "admin-select":
            include "views/fixed/admin/sidebar.php";
            include "views/pages/admin/admin-select.php";
            break;
        case "admin-edit":
            include "views/fixed/admin/sidebar.php";
            include "views/pages/admin/admin-edit.php";
            break;
        case "admin-users":
            include "views/fixed/admin/sidebar.php";
            include "views/pages/admin/admin-users.php";
            break;
        default:
            include "views/fixed/showcase.php";
            include "views/pages/events/events.php";
    }
}
if (!isset($_GET["page"]) || stripos($_GET["page"], "admin") == "") {
    include "views/fixed/footer.php";
}
include "views/fixed/script.php";
