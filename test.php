<?php
    include("");
    $errors=0;
    $error="U heeft één of meerdere velden niet naar behoren ingevuld:<ul>";
    pt_register('POST','contact');
    pt_register('POST','titel');
    pt_register('POST','voorletters');
    pt_register('POST','naam');
    pt_register('POST','adres');
    pt_register('POST','postcode');
    pt_register('POST','plaats');
    pt_register('POST','telefoon');
    pt_register('POST','email');
    pt_register('POST','fax');
    pt_register('POST','vraag');
    $vraag=preg_replace("/(\015\012)|(\015)|(\012)/","&nbsp;<br />", $vraag);
    
    if(!eregi("^[A-Z. ]+$",$voorletters)){
        $errors=1;
        $error.="<li>Voorletters";
    }
    if($naam==""){
        $errors=1;
        $error.="<li>Naam";
    }
    if($adres==""){
        $errors=1;
        $error.="<li>Adres";
    }
    if(!eregi("^[1-9]{1}[0-9]{3}[A-Z]{2}$",$postcode)){
        $errors=1;
        $error.="<li>Postcode";
    }
    if($plaats==""){
        $errors=1;
        $error.="<li>Plaats";
    }
    if(!eregi("^[0-9]{10}$",$telefoon)){
        $errors=1;
        $error.="<li>Telefoon";
    }
    if(!eregi("^([a-z0-9üöä]+([\._%-]?[a-z0-9üöä]+)*@[a-z0-9üöä]+([\._%-]?[a-z0-9üöä]+)*\.[a-z]{2,6})?$",$email)){
        $errors=1;
        $error.="<li>Email";
    }
    if(!eregi("^([0-9]{10})?$",$fax)){
        $errors=1;
        $error.="<li>Fax";
    }
    if($vraag==""){
        $errors=1;
        $error.="<li>Vraag";
    }
    if($errors==1) echo $error;
    else{
        $where_form_is="http".($HTTP_SERVER_VARS["HTTPS"]=="on"?"s":"")."://".$SERVER_NAME.strrev(strstr(strrev($PHP_SELF),"/"));
        $message="contact: ".$contact."
    titel: ".$titel."
    voorletters: ".$voorletters."
    naam: ".$naam."
    adres: ".$adres."
    postcode: ".$postcode."
    plaats: ".$plaats."
    telefoon: ".$telefoon."
    email: ".$email."
    fax: ".$fax."
    vraag: ".$vraag."
        ";
        $message = stripslashes($message);
        mail("mail@domain.nl","Contactformulier",$message,"From: mail@domain.nl");
        
        header("Refresh: 0;url=http://localhost/test/phpform/use/contact/bedankt.html");
    ?>
