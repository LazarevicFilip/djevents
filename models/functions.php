<?php
function insertUser($fname, $lname, $email, $pass, $status, $role)
{
    global $conn;
    $query = "INSERT INTO korisnici (ime,prezime,email,lozinka,status,uloga) VALUES(?,?,?,?,?,?)";
    $insert = $conn->prepare($query);
    $result = $insert->execute([$fname, $lname, $email, $pass, $status, $role]);
    return $result;
}
// function insertCity($city)
// {
//     global $conn;
//     $query = "INSERT INTO grad (naziv) VALUES(:grad)";
//     $insert = $conn->prepare($query);
//     $insert->bindParam(":grad", $city);
//     $result = $insert->execute();
//     return $result;
// }
function getAll($table)
{
    global $conn;
    $query = "SELECT * FROM $table";
    $select = $conn->query($query);
    $result = $select->fetchAll();
    return $result;
}
// function findCity($city)
// {
//     global $conn;
//     $query = "SELECT * FROM grad WHERE naziv = :grad";
//     $select = $conn->prepare($query);
//     $select->bindParam(":grad", $city);
//     $select->execute();
//     $result = $select->fetch();
//     return $result;
// }
function validData($data, $regex, $err)
{
    if (isset($data)) {
        if (!preg_match($regex, $data)) {
            $err++;
        }
    }
    return $err;
}
function insertArtist($art)
{
    global $conn;
    $query = "INSERT INTO izvodjaci (naziv) VALUES (:izvodjac)";
    $insert = $conn->prepare($query);
    $insert->bindParam(":izvodjac", $art);
    $result = $insert->execute();
    return $result;
}
function insertEvent($name, $adress, $cityID, $date, $time, $desc, $status, $img, $price)
{
    global $conn;
    $query = "INSERT INTO events (naziv,adresa,datum,vreme,opis,id_grad,status,putanja,id_cena) VALUES (?,?,?,?,?,?,?,?,?)";
    $insert = $conn->prepare($query);
    $result = $insert->execute([$name, $adress, $date, $time, $desc, $cityID, $status, $img, $price]);
    return $result;
}
function insertEventArtist($eventID, $artistID)
{
    global $conn;
    $query = "INSERT INTO event_izvodjac (id_izvodjac,id_event) VALUES (?,?)";
    $insert = $conn->prepare($query);
    $result = $insert->execute([$artistID, $eventID]);
    return $result;
}
function insertPrice($price)
{
    global $conn;
    $query = "INSERT INTO cena(cena) VALUES(?)";
    $insert = $conn->prepare($query);
    $result = $insert->execute([$price]);
    return $result;
}
function selectPrice($price)
{
    global $conn;
    $query = "SELECT * FROM cena WHERE cena = :price";
    $select = $conn->prepare($query);
    $select->bindParam(":price", $price);
    $select->execute();
    $result = $select->fetchAll();
    return $result;
}
function logUser($email)
{
    global $conn;
    $query = "SELECT * FROM korisnici k INNER JOIN uloge u ON k.uloga = u.id_uloge WHERE k.email=:email";
    $select = $conn->prepare($query);
    $select->bindParam(":email", $email);
    $select->execute();
    $result = $select->fetchAll(); //fetchAll,da bi mogao da pitam dal je samo 1 red vracen,jer rowCount ne radi za select
    return $result;
}
function getUser($email, $pass)
{
    global $conn;
    $query = "SELECT * FROM korisnici WHERE email = ? and lozinka = ?";
    $select = $conn->prepare($query);
    $select->execute([$email, $pass]);
    $result = $select->fetch();
    return $result;
}
function updatePass($email, $newPass)
{
    global $conn;
    $query = "UPDATE korisnici SET lozinka = ?  WHERE email = ?";
    $select = $conn->prepare($query);
    $result = $select->execute([$newPass, $email]);
    return $result;
}
function getUpComingEvents($limit = 0)
{
    global $conn;
    $query = "SELECT *,e.naziv AS ime FROM events e INNER JOIN grad g ON e.id_grad = g.id_grad ORDER BY e.datum,e.vreme LIMIT :limit,:offset";
    $select = $conn->prepare($query);
    $limit = (int)OFFSET * (int)$limit;
    $select->bindParam(":limit", $limit, PDO::PARAM_INT);
    $offset = (int)OFFSET;
    $select->bindParam(":offset", $offset, PDO::PARAM_INT);
    $select->execute();

    $result = $select->fetchAll();
    return $result;
}
function countEvents()
{
    global $conn;
    $query = "SELECT COUNT(*) AS numEvents FROM events e INNER JOIN grad g ON e.id_grad = g.id_grad ORDER BY e.datum,e.vreme";
    $select = $conn->query($query);
    $result = $select->fetch();
    return $result;
}
function getUsers($limit = 0)
{
    global $conn;
    $query = "SELECT * FROM korisnici LIMIT :limit,:offset";
    $select = $conn->prepare($query);
    $limit = (int)OFFSET * (int)$limit;
    $select->bindParam(":limit", $limit, PDO::PARAM_INT);
    $offset = (int)OFFSET;
    $select->bindParam(":offset", $offset, PDO::PARAM_INT);
    $select->execute();

    $result = $select->fetchAll();
    return $result;
}
function countUsers()
{
    global $conn;
    $query = "SELECT COUNT(*) AS numEvents FROM korisnici";
    $select = $conn->query($query);
    $result = $select->fetch();
    return $result;
}
function countPages($fja)
{
    $pagesObj = $fja();
    $pages = ceil($pagesObj->numEvents / OFFSET);
    return $pages;
}
function getSingleEvent($id)
{
    global $conn;
    $query = "SELECT *,e.naziv AS ime,c.cena AS cena FROM events e INNER JOIN grad g ON e.id_grad = g.id_grad INNER JOIN cena c ON e.id_cena = c.id_cena WHERE e.id_event= :id";
    $select = $conn->prepare($query);
    $select->bindParam(":id", $id);
    $select->execute();
    $result = $select->fetch();
    return $result;
}
function filterEvents($str, $limit = 0)
{
    global $conn;
    $query = "SELECT *,e.naziv AS ime FROM events e INNER JOIN grad g ON e.id_grad = g.id_grad WHERE e.naziv LIKE :val OR g.naziv LIKE :val LIMIT :limit,:offset";
    $select = $conn->prepare($query);
    $limit = (int)OFFSET * (int)$limit;
    $select->bindParam(":limit", $limit, PDO::PARAM_INT);
    $offset = (int)OFFSET;
    $select->bindParam(":offset", $offset, PDO::PARAM_INT);
    $select->bindParam(":val", $str);
    $select->execute();
    $result = $select->fetchAll();
    return $result;
}
function filterEventsCount($str)
{
    global $conn;
    $query = "SELECT COUNT(*) AS num FROM events e INNER JOIN grad g ON e.id_grad = g.id_grad WHERE e.naziv LIKE :val OR g.naziv LIKE :val";
    $select = $conn->prepare($query);
    $select->bindParam(":val", $str);
    $select->execute();
    $result = $select->fetch();
    return $result;
}
function getEventsByDate($date, $limit = 0)
{
    global $conn;
    $query = "SELECT *,e.naziv AS ime FROM events e INNER JOIN grad g ON e.id_grad = g.id_grad WHERE e.datum = ?";
    $select = $conn->prepare($query);
    $limit = (int)OFFSET * (int)$limit;
    $select->bindParam(":limit", $limit, PDO::PARAM_INT);
    $offset = (int)OFFSET;
    $select->bindParam(":offset", $offset, PDO::PARAM_INT);
    $select->execute([$date]);
    $result = $select->fetchAll();
    return $result;
}
function getEventsByDateCount($date)
{
    global $conn;
    $query = "SELECT COUNT(*) AS num,e.naziv AS ime FROM events e INNER JOIN grad g ON e.id_grad = g.id_grad WHERE e.datum = ?";
    $select = $conn->prepare($query);
    $select->execute([$date]);
    $result = $select->fetch();
    return $result;
}
function getPreformers($id)
{
    global $conn;
    $query = "SELECT * FROM event_izvodjac AS ei INNER JOIN izvodjaci i ON ei.id_izvodjac = i.id_izvodjac WHERE ei.id_event=:id";
    $select = $conn->prepare($query);
    $select->bindParam(":id", $id);
    $select->execute();
    $result = $select->fetchAll();
    return $result;
}
function delete($id, $table, $col)
{
    global $conn;
    $query = "DELETE FROM $table WHERE $col = :id";
    $delete = $conn->prepare($query);
    $delete->bindParam(":id", $id);
    $result = $delete->execute();
    return $result;
}
function selectArt($art)
{
    global $conn;
    $query = "SELECT * FROM izvodjaci WHERE naziv=:art";
    $select = $conn->prepare($query);
    $select->bindParam(":art", $art);
    $select->execute();
    $result = $select->fetchAll();
    return $result;
}
function getRecoverKey($id)
{
    global $conn;
    $query = "SELECT recovery_key,email FROM korisnici WHERE id_korisnik = ?";
    $select = $conn->prepare($query);
    $select->execute([$id]);
    $result = $select->fetch();
    return $result;
}
function imgResize($fileName, $tmpFIle)
{
    // change image name
    $newFileName = time() . "-" . $fileName;
    // define path
    $path = "../../assets/uploaded_img/" . $newFileName;
    $result = move_uploaded_file($tmpFIle, $path);
    if ($result) {
        $cords = getimagesize($path);
        // resize
        $newWidth = 140;
        $newHeight = $cords[1] * $newWidth / $cords[0];
        // get extension of file
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        if ($extension == "png") {
            // empty object with new dimensions 
            $objImg = imagecreatetruecolor($newWidth, $newHeight);
            //resorce of image
            $resorce = imagecreatefrompng($path);
            imagecopyresampled($objImg, $resorce, 0, 0, 0, 0, $newWidth, $newHeight, $cords[0], $cords[1]);
            //new image
            imagepng($objImg, "../../assets/img-small/$newFileName");
        } else {
            // empty object with new dimensions 
            $objImg = imagecreatetruecolor($newWidth, $newHeight);
            //resorce of img
            $resorce = imagecreatefromjpeg($path);
            imagecopyresampled($objImg, $resorce, 0, 0, 0, 0, $newWidth, $newHeight, $cords[0], $cords[1]);
            //new image
            imagejpeg($objImg, "../../assets/img-small/$newFileName");
        }
    }
    return $newFileName;
}
function countAttemps($user)
{
    $time = time();
    // get email of user
    $userEmail = $user[0]->email;
    // if user try to login with wrong password for the frist time
    if (!isset($_SESSION["lock_acc"])) {
        $_SESSION["lock_acc"] = [$userEmail => [$time]];
    } else {
        if (isset($_SESSION["lock_acc"][$userEmail])) {
            // add to arr failed attemps
            $_SESSION["lock_acc"][$userEmail][] = $time;
            // slice last 3 attemps
            $attempts = array_slice($_SESSION["lock_acc"][$userEmail], -3);
            if (count($attempts) >= 3) {
                $counter = 0;
                foreach ($attempts as $attempt) {
                    // check if is in a range of 5min
                    if ($attempt > (time() - 300000) && $attempt <= time()) {
                        $counter++;
                    }
                }
                if ($counter == 3) {
                    // if all 3 attemps are in range lock acc...
                    return lock_account($user);
                }
            }
        } else {
            //if session is set but different email
            $_SESSION["lock_acc"][$userEmail] =  [$time];
        }
    }
    return false;
}
function lock_account($user)
{
    global $conn;
    // generete key
    $recovery_key =  md5(rand());
    try {
        // update column for recovory_key
        $query = "UPDATE korisnici SET recovery_key = ? WHERE id_korisnik = ?";
        $update = $conn->prepare($query);
        $result = $update->execute([$recovery_key, $user[0]->id_korisnik]);

        if ($result) {
            $email = $user[0]->email;
            $name = $user[0]->ime;
            $id = $user[0]->id_korisnik;
            $subject = "Vas nalog je zakljucan";
            $link_href = BASE_URL . "/models/user/unlockAccount.php?id=$id&recovery_key=$recovery_key";
            $html = "
            <h2>Postovani $name,</h2>
            <h3>Vas nalog je zakljucan iz sigurnosnih razloga usled vise pokusaja logovanja u kratkom vremesnkom periodu.</h3>
           <p>Kopirajte ovaj link <b>$link_href</b> u adress bar da otkljucate nalog.</p>";
            // send email   
            $response = send_mail($email, $subject, $html);
            // if email is not send
            if (!$response[0]) {
                logAction(LOG_ERR_FAJL, "Mailer Error: " . $response[1]->ErrorInfo);
            }
            return true;
        }
    } catch (PDOException $exception) {
        return false;
        logAction(LOG_ERR_FAJL, $exception->getMessage());
    }
}
function send_mail($email, $subject, $html, $reply_info = false)
{

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";   //env("PHPMAILER_SMTP");

    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Port = "587";
    $mail->Username = "djeventsapp@gmail.com"; //env("PHPMAILER_MAIL");
    $mail->Password = "djevents123!";

    $mail->Subject = $subject;
    $mail->setFrom("djeventsapp@gmail.com");
    $mail->isHTML(true);
    $mail->Body = $html;
    $mail->addAddress($email);
    // if ($reply_info) {
    //     $mail->AddReplyTo($reply_info["email"], "Reply to " . $reply_info["name"]);
    // }
    $result = $mail->send();
    $mail->smtpClose();
    return [$result, $mail];
}
