<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SESSION["critiqued"] == 1)
    {
        $user_images = query("SELECT id, url, title FROM images WHERE user_id = ? ORDER BY RAND()", $_SESSION["id"]);
        $background_url = query("SELECT url FROM images WHERE user_id = ? ORDER BY RAND() LIMIT 1", $_SESSION["id"])[0]["url"];
        $user_info = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"])[0];
        $user_info["splitname"] = explode(" ", $user_info["fullname"]);
        if (empty($user_images))
        {
            $background_url = query("SELECT url FROM images ORDER BY RAND() LIMIT 1")[0]["url"];
            render("gallery_form.php", ["title" => "Welcome", "user_images" => [], "user_info" => $user_info, "background_url" => $background_url]);
            exit;
        }
        else
        {
            render("gallery_form.php", ["title" => "Welcome", "user_images" => $user_images, "user_info" => $user_info, "background_url" => $background_url]);
            exit;
        }
    }
    else
    {
        // I'm able to get an array of three randomly selected urls that are not from the current user's id. I passed it
        // through but now I'm having trouble accessing it as a string to plug into the URL on welcome_form.php. You
        // can confirm this query works on phpMyAdmin. 

        $randomimgurl = query("SELECT id, url FROM images WHERE user_id != ? ORDER BY RAND() LIMIT 3", $_SESSION["id"]);
        // else render form
        render("welcome_form.php", ["title" => "Welcome", "id" => $_SESSION["id"], "randomimgurl" => $randomimgurl]);
    }

?>
