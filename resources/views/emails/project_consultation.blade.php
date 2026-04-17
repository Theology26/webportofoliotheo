<!DOCTYPE html>
<html>
<head>
    <title>New Project Request</title>
</head>
<body>
    <h2>Anda Mendapatkan Permintaan Diskusi Projek Baru!</h2>
    <p><strong>Nama:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['sender_email'] }}</p>
    
    <h3>Daftar Projek / Aplikasi yang Ingin Dibuat:</h3>
    <p style="white-space: pre-wrap;">{{ $data['project_list'] }}</p>

    <hr>
    <p>Mohon segera di-follow up dengan membalas ke email pengirim ({{ $data['sender_email'] }}).</p>
</body>
</html>
