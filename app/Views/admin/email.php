<?= $this->extend('template/email') ?>
<?= $this->section('content') ?>

<?php $db = \Config\Database::connect();

//Import the PHPMailer class into the global namespace
require 'mail/src/Exception.php';
require 'mail/src/PHPMailer.php';
require 'mail/src/SMTP.php';


date_default_timezone_set('Etc/UTC');

$mail = new PHPMailer();
$mail->isSMTP();
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->Host = 'keperawatan.devinc.website';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'daftar@perawat.devinc.website';
$mail->Password = 'kprwt2023';
$mail->setFrom('daftar@perawat.devinc.website', 'Daftar Latihan Soal Keperawatan');
$mail->addReplyTo('daftar@perawatadevinc.website', 'Daftar Latihan Soal Keperawatan');

$mail->addAddress($email, $nama);
$mail->Subject = 'Daftar Latihan Soal Keperawatan';

$queryClass = $db->table('jurusan')->getWhere(['id' => $jurusan]);
foreach ($queryClass->getResult('array') as $j) :
    $jurusan = $j['jname'];
endforeach;

$message=
    '<p>Selamat,</p>'.
    '<p>Anda telah mendaftar ke <b>Latihan Soal Keperawatan </b> dengan detail sebagai berikut :</p>'.
    '<div class=="mt-2">Nama         :'.$nama.'</div>'.
    '<div>Sekolah      :'.$asal.'</div>'.
    '<div>Jurusan       :'.$jurusan.'</div>'.
    '<div>Handphone      :'.$hp.'</div>'.
    '<div>Username       :'.$username.'</div>'.
    '<div>Password       :'.$password.'</div>';
$mail->msgHTML($message);

$mail->AltBody = 'This is a plain-text message body';
$mail->addAttachment('logo/logo.png');
$mail->addBCC('ysrent@gmail.com');
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="mt-3">
        <hr>
    </div>
    <!-- Page Heading -->
    <div class="align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">Pendaftaran Berhasil</h1>
        <h6 class="h6 mb-0 text-gray my-2">Anda telah mendaftar Latihan Soal Keperawatan</h6>        
    </div>
    <div>email telah dikirim ke <?= $email ?></div>
    <a class="btn btn-primary mt-3 mb-4" href="../login/fp">Done</a>
    
    <div class="mt-3">
        <hr>
    </div>
</div>
<!-- /.container-fluid -->
<?php }?>




<?= $this->endSection() ?>