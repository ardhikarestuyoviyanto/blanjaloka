# ![blanjaloka](https://user-images.githubusercontent.com/61740978/136319435-ace8163d-8fbd-4dc8-9b4f-b9ec2bd170ca.png)

# Instalasi
1. git clone https://github.com/ardhikarestuyoviyanto/blanjaloka.git
2. composer update
3. php artisan migrate (generate database)
4. php artisan serve
5. lalu akses http://127.0.0.1:8000/ di browser

# Aturan Kontribusi
## Membuat views => di folder resources/views
1. Anda harus membuat views di lokasi resources/views (Tidak boleh generate views sendiiri atau buat modul sendiri)
2. Semua views yang anda buat merupakan <b>VIEWS DINAMIS</b> yang selalu di extend kan dengan master.blade.php, pada masing - masing views
   
![Capture](https://user-images.githubusercontent.com/61740978/136487918-b7f9d868-a1c8-40ef-b7fd-da144aa44ca4.PNG)

3. Penulisan file js diletakkan di paling bawah file views dinamis
