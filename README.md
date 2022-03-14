# task

Aşıdaki satırları sırayla komut satırında çalıştırın.

    git clone https://github.com/byldrm/task.git
    
    cd task
    
    docker compose up -d --build
    
    docker exec -it app-shared-php-8 bash
    
    cd test1
    
    composer update
    
    php artisan migrate
    
    php artisan db:seed --class=UserSeeder

http://localhost/ üzerinden projeyi görebilirsiniz
    
    demo kullanıcı bilgileri
    email : demo@mail.com
    şifre : 12demo34