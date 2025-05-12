<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // POST ile geldiğini kontrol et
    if (isset($_POST['email'], $_POST['password'])) { // İki alanın da mevcut olduğunu kontrol et
        $adi = htmlspecialchars($_POST['email']); // Kullanıcıdan gelen e-posta
        $sifre = htmlspecialchars($_POST['password']); // Kullanıcıdan gelen şifre
        
        // E-posta doğrulama ve başlangıç kontrolü
        $regex_email = '/^[bg][0-9]+@sakarya.edu.tr$/'; // E-posta formatını kontrol eder
        if (filter_var($adi, FILTER_VALIDATE_EMAIL) && preg_match($regex_email, $adi)) {
            // E-postadan öğrenci numarası kısmını çıkarır
            $email_parts = explode('@', $adi); // E-posta alanını parçalar
            $student_number = $email_parts[0]; // Öğrenci numarası kısmı

            // Şifrenin öğrenci numarasıyla aynı olup olmadığını kontrol eder
            if ($sifre === $student_number) { // Şifre kontrolü
                echo '<html>';
                echo '<head>';
                echo '<meta charset="UTF-8">';
                echo '<title>Giriş Başarılı</title>';
                echo '</head>';
                echo '<body>';
                echo '<h1>Bilgiler doğru. Hoş geldiniz ' . htmlspecialchars($adi) . '!</h1>';
                echo '</body>';
                echo '</html>';
            } else {
                echo "Şifre hatalı. Şifre, e-posta adresinizdeki öğrenci numarası olmalıdır.";
            }
        } else {
            echo "Lütfen 'b' veya 'g' ile başlayan ve @sakarya.edu.tr domainli bir e-posta adresi girin.";
        }
    } else {
        echo "Bilgilerinizi kontrol edin. Eksik bilgi girdiniz."; // Alanlar eksikse
    }
} else {
    echo "Bu sayfaya doğrudan erişilemez."; // POST yöntemi değilse
}
?>
