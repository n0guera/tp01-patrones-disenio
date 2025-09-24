<?php
//Alumno: Noguera, Bruno Santiago
//Comision: 2.2
//Patrón sorteado: Repository

//Entidad
class User {
    public function __construct(
        public int $id,
        public string $name
    ) {}
}

//Interfaz del repositorio
interface UserRepository {
    public function findById(int $id): ?User;
    public function save(User $user): void;
}

//Implementación con "base de datos" en memoria
class InMemoryUserRepository implements UserRepository {
    private array $users = [];

    public function findById(int $id): ?User {
        return $this->users[$id] ?? null;
    }

    public function save(User $user): void {
        $this->users[$user->id] = $user;
    }
}

//Uso en la aplicación
$repo = new InMemoryUserRepository();
$repo->save(new User(1, "Alice"));
$repo->save(new User(2, "Bob"));

$user = $repo->findById(1);
echo $user ? "Usuario encontrado: {$user->name}" : "No encontrado";