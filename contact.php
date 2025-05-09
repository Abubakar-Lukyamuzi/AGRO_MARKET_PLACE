<!DOCTYPE html>
<html lang="en"> <!-- Define the language of the document as English -->
<head>
    <title>Contacts</title> <!-- Title of the webpage -->
    <meta charset="utf-8"> <!-- Set character encoding to UTF-8 -->
    <link rel="stylesheet" href="contact.css"> <!-- Link to external CSS file for styling -->
</head>
<body>

<?php
 include_once 'nav.php'; // Include the navigation menu from 'nav.php'
?> 

<div class="bg"> <!-- Background container -->
<section id="content"> <!-- Main content section -->
    <div class="container_12"> <!-- Grid container for layout -->
        <article class="grid_6"> <!-- First article in a grid layout -->
            <div class="inner-block"> <!-- Inner block for content -->
                <h2 class="main_h2 p10">our address</h2> <!-- Main heading for address section -->
                
                <div class="clear"></div> <!-- Clearfix to handle floats -->
                <dl class="dl1"> <!-- Definition list for address details -->
                    <dt>Agro Market Place Inc. 8901 Bushenyi Road, Kihumuro, Mbarara.</dt> <!-- Company address -->
                    <dd><span>Freephone:</span>   +256 800 559 6580</dd> <!-- Freephone number -->
                    <dd><span>Telephone:</span>   +256 700 603 6035</dd> <!-- Telephone number -->
                    <dd><span>FAX:</span>   +256 800 889 9898</dd> <!-- Fax number -->
                    <dd>E-mail: <a href="mailto:lahuslcamz@gmail.com">email us</a></dd> <!-- Email link -->
                    <iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> <!-- Google Maps embed for location -->
                </dl>
            </div>
        </article>

        <article class="grid_6"> <!-- Second article in a grid layout -->
            <div class="inner-block"> <!-- Inner block for content -->
                <h2 class="main_h2 p10">send message</h2> <!-- Main heading for message section -->
                <form id="form1"> <!-- Start of contact form -->
                    <div class="success"><div class="success_txt">Contact form submitted!<br /><strong> We will be in touch soon.</strong></div></div> <!-- Success message after form submission -->
                    <fieldset> <!-- Group related elements in a form -->
                        <label class="name"> <!-- Label for name input -->
                            <input type="text" value="Name:"> <!-- Input field for name -->
                            <span class="error">*This is not a valid name.</span> <span class="empty">*This field is required.</span> <!-- Error messages -->
                        </label>                                        
                        <label class="email"> <!-- Label for email input -->
                            <input type="text" value="E-mail:"> <!-- Input field for email -->
                            <span class="error">*This is not a valid email address.</span> <span class="empty">*This field is required.</span> <!-- Error messages -->
                        </label> 
                        <label class="phone"> <!-- Label for phone input -->
                            <input type="tel" value="Telephone:"> <!-- Input field for telephone -->
                            <span class="error">*This is not a valid phone number.</span> <span class="empty">*This field is required.</span> <!-- Error messages -->
                        </label>                                                                    
                        <label class="message"> <!-- Label for message textarea -->
                            <textarea>Message</textarea> <!-- Textarea for user message -->
                            <span class="error">*The message is too short.</span> <span class="empty">*This field is required.</span> <!-- Error messages -->
                        </label>
                        <div class="clear"></div> <!-- Clearfix to handle floats -->
                        <div class="link-form"> <!-- Container for form buttons -->
                            <a class="button2 p27" href="#" data-type="reset">clear</a> <!-- Clear button -->
                            <a class="button2" href="#" data-type="submit">send</a> <!-- Send button -->
                        </div>                      
                    </fieldset>           
                </form>
            </div>
        </article>
        <div class="clear"></div> <!-- Clearfix to handle floats -->
    </div>
</section>


<footer>
    <div class="container_12"> 
        <article class="