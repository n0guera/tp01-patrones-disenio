<?php
//Alumno: Noguera, Bruno Santiago
//Comision: 2.2
//Principio SOLID sorteado: Dependency Inversion Principle (DIP)

//Abstracción
interface Notifier {
    public function send(string $message): void;
}

//Implementación concreta
class EmailNotifier implements Notifier {
    public function send(string $message): void {
        echo "📧 Enviando email: $message\n";
    }
}

class SMSNotifier implements Notifier {
    public function send(string $message): void {
        echo "📱 Enviando SMS: $message\n";
    }
}

//Clase de alto nivel (depende de la abstracción)
class OrderService {
    private Notifier $notifier;

    // Inyección de dependencias
    public function __construct(Notifier $notifier) {
        $this->notifier = $notifier;
    }

    public function createOrder(string $product): void {
        echo "🛒 Orden creada para: $product\n";
        $this->notifier->send("Tu orden de $product fue creada exitosamente.");
    }
}

// ====== Uso ======
$orderServiceEmail = new OrderService(new EmailNotifier());
$orderServiceEmail->createOrder("Laptop");

$orderServiceSMS = new OrderService(new SMSNotifier());
$orderServiceSMS->createOrder("Smartphone");