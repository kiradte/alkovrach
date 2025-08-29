<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once dirname(__DIR__) . '/public/config.php';
require_once __DIR__ . '/Db.php';

function json_response(array $data, int $code = 200): void {
    http_response_code($code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    json_response(['ok' => false, 'error' => 'method_not_allowed'], 405);
}

$raw  = file_get_contents('php://input');
$data = json_decode($raw, true);
if (!is_array($data)) {
    $data = $_POST;
}

$name   = trim((string)($data['name'] ?? ''));
$email  = trim((string)($data['email'] ?? ''));
$phone  = trim((string)($data['phone'] ?? ''));
$source = trim((string)($data['source'] ?? 'web'));

$emailNorm = mb_strtolower($email);

$digits = preg_replace('/\D+/', '', $phone);
if (preg_match('/^(7|8)(\d{10})$/', $digits, $m)) {
    $phoneNorm = '+7' . $m[2];
} else {
    $phoneNorm = '+' . ltrim($digits, '+');
}
$digitsOnly = preg_replace('/\D+/', '', $phoneNorm);

$errors = [];

if (mb_strlen($name) < 2) {
    $errors['name'] = 'Введите имя (мин. 2 символа)';
}
if (!filter_var($emailNorm, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Некорректный email';
}
if (strlen($digitsOnly) < 10 || strlen($digitsOnly) > 15) {
    $errors['phone'] = 'Некорректный телефон';
}

if ($errors) {
    json_response(['ok' => false, 'errors' => $errors, 'message' => 'Проверьте поля формы'], 422);
}

try {
    $pdo = Db::pdo();

    $chk = $pdo->prepare(
        "SELECT id
           FROM leads
          WHERE created_at >= (NOW() - INTERVAL 5 MINUTE)
            AND (email = :email OR phone = :phone)
          LIMIT 1"
    );
    $chk->execute([
        ':email' => $emailNorm,
        ':phone' => $phoneNorm,
    ]);

    if ($chk->fetch()) {
        json_response([
            'ok'      => false,
            'error'   => 'duplicate',
            'message' => 'Заявка с этим телефоном или email уже отправлялась менее 5 минут назад.'
        ], 409);
    }

    $ipRaw = $_SERVER['REMOTE_ADDR'] ?? '';
    $ipBin = @inet_pton($ipRaw) ?: null;

    $ins = $pdo->prepare(
        "INSERT INTO leads (name, email, phone, source, ip, user_agent, created_at)
         VALUES (:name, :email, :phone, :source, :ip, :ua, NOW())"
    );
    $ins->execute([
        ':name'   => $name,
        ':email'  => $emailNorm,
        ':phone'  => $phoneNorm,
        ':source' => $source,
        ':ip'     => $ipBin,
        ':ua'     => mb_substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255),
    ]);

    json_response(['ok' => true, 'message' => 'Спасибо! Заявка отправлена.']);
} catch (Throwable $e) {
    error_log(__FILE__ . ' :: ' . $e->getMessage());
    json_response([
        'ok'      => false,
        'error'   => 'server_error',
        'message' => 'Ошибка сервера. Попробуйте позже.'
    ], 500);
}
